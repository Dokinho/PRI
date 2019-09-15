<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('korisnik');
        $this->load->model('adresa');

         //Učitavanje biblioteke za provjeru valjanosti forme i tako
         $this->load->library('form_validation');
         $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
    }

    public function index($tab = 'podaci', $adr = -1, $id = 0)
    {
        $data['title'] = 'NetPizza - Profil';
        $data['page'] = 'profil';
        $data['mail_change'] = false;
        $data['pass_change'] = false;
        $data['dodajeli'] = false;

        $this->load->view('static/header', $data);
        $this->load->view('profil');

        //Provjeri na kojem je tabu korisnik
        if ($tab == 'podaci') {
            //Otvoren tab Podaci
            //Pravila za valjanost forme za osobne podatke
            if ($this->input->post('mail-change')) {
                $this->form_validation->set_rules(
                    'email',
                    'Email',
                    'trim|required|max_length[40]|valid_email|is_unique[korisnik.email]',
                    array('required'=>'Unesite email adresu.', 'max_length'=>'Email ne može sadržavati više od 40 znakova.', 'valid_email'=>'Unesena email adresa nije ispravna.',
                    'is_unique'=>'Korisnički račun sa unesenom email adresom već postoji.')
                );
                $this->form_validation->set_rules(
                    'mailconf',
                    'Potvrda emaila',
                    'required|matches[email]',
                    array('required'=>'Potvrdite email.','matches'=>'Email adrese se ne podudaraju.')
                );
            }
            if ($this->input->post('pass-change')) {
                $this->form_validation->set_rules(
                    'oldlozinka',
                    'Stara lozinka',
                    'required',
                    array('required'=>'Unesite staru lozinku.')
                );
                $this->form_validation->set_rules(
                    'lozinka',
                    'Lozinka',
                    'required',
                    array('required'=>'Unesite novu lozinku.')
                );
                $this->form_validation->set_rules(
                    'passconf',
                    'Potvrda lozinke',
                    'required|matches[lozinka]',
                    array('required'=>'Potvrdite novu lozinku.', 'matches'=>'Lozinke se ne podudaraju.')
                );
            }
            if ($this->form_validation->run() == false) {
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
    
                $this->load->view('podaci/podaci', $data);
                $this->load->view('podaci/podaci_failure', $data);
                $this->load->view('static/footer');
            } else {
                //Ispravan unos
                $data['mail_change'] = false;
                $data['pass_change'] = false;
    
                $novo = $this->korisnik->izmjeni();
                if (isset($novo['email'])) {
                    $_SESSION['email'] = $novo['email'];
                }
    
                $this->load->view('podaci/podaci', $data);
                $this->load->view('podaci/podaci_success', $data);
                $this->load->view('static/footer');
            }
        } else {
            //Otvoren tab Adrese
            $this->load->view('adrese/adrese', $data);

            //Pravila za valjanost forme za adrese
            $this->form_validation->set_rules(
                'ime'.$adr,
                'Ime',
                'required',
                array('required'=>'Treba')
            );
            $this->form_validation->set_rules(
                'prezime'.$adr,
                'Prezime',
                'required',
                array('required'=>'Treba')
            );
            $this->form_validation->set_rules(
                'telefon'.$adr,
                'Telefon',
                'required',
                array('required'=>'Treba')
            );
            $this->form_validation->set_rules(
                'ulica'.$adr,
                'Ulica',
                'required',
                array('required'=>'Treba')
            );
            $this->form_validation->set_rules(
                'kucni_broj'.$adr,
                'Kućni broj',
                'required',
                array('required'=>'Treba')
            );

            if ($this->form_validation->run() == false) {
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
                    $this->load->view('adrese/adrese_item', $data);
                    $maxindeks++;
                }
                $data['max_index'] = $maxindeks;
                $data['adr_change'] = $adr;

                $this->load->view('adrese/adrese_failure', $data);
                $this->load->view('static/footer');
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
                    $this->load->view('adrese/adrese_item', $data);
                    $maxindeks++;
                }
                $data['max_index'] = $maxindeks;

                $this->load->view('adrese/adrese_success', $data);
                $this->load->view('static/footer');
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
        $this->form_validation->set_rules(
            'newime',
            'Ime',
            'required',
            array('required'=>'Treba')
        );
        $this->form_validation->set_rules(
            'newprezime',
            'Prezime',
            'required',
            array('required'=>'Treba')
        );
        $this->form_validation->set_rules(
            'newtelefon',
            'Telefon',
            'required',
            array('required'=>'Treba')
        );
        $this->form_validation->set_rules(
            'newulica',
            'Ulica',
            'required',
            array('required'=>'Treba')
        );
        $this->form_validation->set_rules(
            'newkucni_broj',
            'Kućni broj',
            'required',
            array('required'=>'Treba')
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('static/header', $data);
            $this->load->view('profil');
            $this->load->view('adrese/adrese', $data);


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
                $this->load->view('adrese/adrese_item', $data);
                $maxindeks++;
            }
            $data['max_index'] = $maxindeks;

            $this->load->view('adrese/adrese_failure', $data);
            $this->load->view('static/footer');
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
