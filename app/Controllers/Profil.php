<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Profil extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->korisnik = model('Korisnik');
        $this->adresa = model('Adresa');

        $validation = \Config\Services::validation();
        // $validation->set_error_delimiters('<p class="form-error">', '</p>');
    }

    public function index($tab = 'podaci', $adr = -1, $id = 0)
    {
        $data['title'] = 'NetPizza - Profil';
        $data['page'] = 'profil';
        $data['mail_change'] = false;
        $data['pass_change'] = false;
        $data['dodajeli'] = false;

        echo view('static/header', $data);
        echo view('profil');

        //Provjeri na kojem je tabu korisnik
        if ($tab == 'podaci') {
            //Otvoren tab Podaci
            //Pravila za valjanost forme za osobne podatke
            if ($this->input->post('mail-change')) {
                $validation->setRule(
                    'email',
                    'Email',
                    'trim|required|max_length[40]|valid_email|is_unique[korisnik.email]',
                    array('required'=>'Unesite email adresu.', 'max_length'=>'Email ne može sadržavati više od 40 znakova.', 'valid_email'=>'Unesena email adresa nije ispravna.',
                    'is_unique'=>'Korisnički račun sa unesenom email adresom već postoji.')
                );
                $validation->setRule(
                    'mailconf',
                    'Potvrda emaila',
                    'required|matches[email]',
                    array('required'=>'Potvrdite email.','matches'=>'Email adrese se ne podudaraju.')
                );
            }
            if ($this->input->post('pass-change')) {
                $validation->setRule(
                    'oldlozinka',
                    'Stara lozinka',
                    'required',
                    array('required'=>'Unesite staru lozinku.')
                );
                $validation->setRule(
                    'lozinka',
                    'Lozinka',
                    'required',
                    array('required'=>'Unesite novu lozinku.')
                );
                $validation->setRule(
                    'passconf',
                    'Potvrda lozinke',
                    'required|matches[lozinka]',
                    array('required'=>'Potvrdite novu lozinku.', 'matches'=>'Lozinke se ne podudaraju.')
                );
            }
            if ($validation->run() == false) {
                //Neispravan (ili nepostojan) unos

                //Provjera varijable koja služi za automatsko postavljanje e-mail polja u izmjenjivo stanje pri ponovnom učitavanju stranice
                if ($this->input->post('mail-change')) {
                    $data['mail_change'] = true;
                } else {
                    $data['mail_change'] = false;
                }
    
                //Provjera varijable koja služi za automatsko postavljanje polja lozinke u izmjenjivo stanje pri ponovnom učitavanju stranice
                if ($this->input->post('pass-change')) {
                    $data['pass_change'] = true;
                } else {
                    $data['pass_change'] = false;
                }
    
                echo view('podaci/podaci', $data);
                echo view('podaci/podaci_failure', $data);
                echo view('static/footer');
            } else {
                //Ispravan unos
                $data['mail_change'] = false;
                $data['pass_change'] = false;
    
                $novo = $this->korisnik->izmjeni();
                if (isset($novo['email'])) {
                    $_SESSION['email'] = $novo['email'];
                }
    
                echo view('podaci/podaci', $data);
                echo view('podaci/podaci_success', $data);
                echo view('static/footer');
            }
        } else {
            //Otvoren tab Adrese
            echo view('adrese/adrese', $data);

            //Pravila za valjanost forme za adrese
            $validation->setRule(
                'ime'.$adr,
                'Ime',
                'required',
                array('required'=>'Treba')
            );
            $validation->setRule(
                'prezime'.$adr,
                'Prezime',
                'required',
                array('required'=>'Treba')
            );
            $validation->setRule(
                'telefon'.$adr,
                'Telefon',
                'required',
                array('required'=>'Treba')
            );
            $validation->setRule(
                'ulica'.$adr,
                'Ulica',
                'required',
                array('required'=>'Treba')
            );
            $validation->setRule(
                'kucni_broj'.$adr,
                'Kućni broj',
                'required',
                array('required'=>'Treba')
            );

            if ($validation->run() == false) {
                //Neispravan (ili nepostojan) unos
                //Učitaj adrese korisnika iz baze
                $adrese = $this->adresa->ucitaj();

                //Ispiši adrese
                $maxindeks = 1;
                foreach ($adrese as $indeks=>$adresa) {
                    $data = array(
                        'i'=>$indeks,
                        'id'=>$adresa->id,
                        'kratica'=>$adresa->naslov,
                        'ime'=>$adresa->ime,
                        'prezime'=>$adresa->prezime,
                        'telefon'=>$adresa->telefon,
                        'ulica'=>$adresa->ulica,
                        'kucni_broj'=>$adresa->kucni_broj
                    );
                    echo view('adrese/adrese_item', $data);
                    $maxindeks++;
                }
                $data['max_index'] = $maxindeks;
                $data['adr_change'] = $adr;

                echo view('adrese/adrese_failure', $data);
                echo view('static/footer');
            } else {
                //Ispravan unos
                $data['adr_change'] = -1;
                //Spremi izmjenjenu adresu u bazu
                $this->adresa->izmjeni($adr, $id);

                //Učitaj adrese korisnika iz baze
                $adrese = $this->adresa->ucitaj();

                //Ispiši adrese
                $maxindeks = 1;
                foreach ($adrese as $indeks=>$adresa) {
                    $data = array(
                        'i'=>$indeks,
                        'id'=>$adresa->id,
                        'kratica'=>$adresa->naslov,
                        'ime'=>$adresa->ime,
                        'prezime'=>$adresa->prezime,
                        'telefon'=>$adresa->telefon,
                        'ulica'=>$adresa->ulica,
                        'kucni_broj'=>$adresa->kucni_broj
                    );
                    echo view('adrese/adrese_item', $data);
                    $maxindeks++;
                }
                $data['max_index'] = $maxindeks;

                echo view('adrese/adrese_success', $data);
                echo view('static/footer');
            }
        }
    }

    public function ukloniAdr($id)
    {
        $this->adresa->ukloni($id);
        redirect('profil/index/adrese');
    }

    public function dodajAdr($i)
    {
        $data['title'] = 'NetPizza - Profil';
        $data['page'] = 'profil';
        $data['dodajeli'] = true;
        $data['adr_change'] = -1;

        //Pravila za valjanost forme za adrese
        $validation->setRule(
            'newime',
            'Ime',
            'required',
            array('required'=>'Treba')
        );
        $validation->setRule(
            'newprezime',
            'Prezime',
            'required',
            array('required'=>'Treba')
        );
        $validation->setRule(
            'newtelefon',
            'Telefon',
            'required',
            array('required'=>'Treba')
        );
        $validation->setRule(
            'newulica',
            'Ulica',
            'required',
            array('required'=>'Treba')
        );
        $validation->setRule(
            'newkucni_broj',
            'Kućni broj',
            'required',
            array('required'=>'Treba')
        );

        if ($validation->run() == false) {
            echo view('static/header', $data);
            echo view('profil');
            echo view('adrese/adrese', $data);


            $adrese = $this->adresa->ucitaj();
            $maxindeks = 1;
            foreach ($adrese as $indeks=>$adresa) {
                $data = array(
                    'i'=>$indeks,
                    'id'=>$adresa->id,
                    'kratica'=>$adresa->naslov,
                    'ime'=>$adresa->ime,
                    'prezime'=>$adresa->prezime,
                    'telefon'=>$adresa->telefon,
                    'ulica'=>$adresa->ulica,
                    'kucni_broj'=>$adresa->kucni_broj
                );
                echo view('adrese/adrese_item', $data);
                $maxindeks++;
            }
            $data['max_index'] = $maxindeks;

            echo view('adrese/adrese_failure', $data);
            echo view('static/footer');
        }
        else {
            $this->adresa->dodaj($i);
        redirect('profil/index/adrese');
        }
    }

    public function ukloniRacun ()
    {
        if ($this->input->post('protecc')) {
            $this->korisnik->ukloni();
            redirect('home');
        } else {
            redirect('profil');
        }
    }   
}
