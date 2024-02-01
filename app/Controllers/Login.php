<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Login extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->proizvod = model('Korisnik');
    }
    
    public function index()
    {
        $data['title'] = 'NetPizza - Prijava';
        $data['page'] = 'login';
        echo view('static/header', $data);

        //Preusmjeri prijavljene korisnike na početnu stranicu
        switch ($_SESSION['tip_korisnika']) {
            case 0: //Gost
            break;
            case 1: //Administrator
            case 2: //Korisnik
                redirect('home');
            break;
            default:
        }

        $validation = \Config\Services::validation();
        // $validation->set_error_delimiters('<p class="form-error">', '</p>');

        //Postavljanje pravila za provjeru valjanosti forme i error poruka
        $validation->setRules(
            'email',
            'Email',
            'required|valid_email',
            array('required'=>'Unesite email adresu.', 'valid_email'=>'Unesena email adresa nije ispravna')
        );
        $validation->setRules(
            'lozinka',
            'Lozinka',
            'required',
            array('required'=>'Unesite lozinku.')
        );

        //Prvi dio provjere valjanosti unosa (provjera prije slanja upita bazi)
        if ($validation->run() == false) {
            echo view('login1');
            echo view('login2');
            echo view('static/footer');
        } else {
            //Drugi dio provjere valjanosti unosa (provjera nakon slanja upita bazi)
            $rezultat = $this->korisnik->ucitaj();
            switch ($rezultat['kod']) {
                case 0: //Uspješna prijava

                    /* Postavljanje session varijabli, string "tip_korisnika" iz baze se pretvara u broj:
                    0 - Gost. Ne može se postaviti ovdje, postavlja se u header.php ako korisnik nije prijavljen
                    1 - Administrator
                    2- Korisnik */
                    if ($rezultat['result']->tip_korisnika == 'administrator') {
                        $_SESSION['tip_korisnika'] = 1;
                    } else {
                        $_SESSION['tip_korisnika'] = 2;
                    }
                    $_SESSION['id'] = $rezultat['result']->id;
                    $_SESSION['ime'] = $rezultat['result']->ime;
                    $_SESSION['prezime'] = $rezultat['result']->prezime;
                    $_SESSION['telefon'] = $rezultat['result']->telefon;
                    $_SESSION['email'] = $rezultat['result']->email;
                    $_SESSION['logged_in'] = true;
                    $_SESSION['kosarica'] = array();
                    $_SESSION['kos_broj'] = 0;

                    //Preusmjeravanje na početnu stranicu
                    redirect('home');
                break;
                case 1: //Netočna lozinka
                    echo view('login1');
                    echo view('login_errors/lozinka');
                    echo view('login2');
                    echo view('static/footer');
                break;
                case 2: //Ne postoji korisnik
                    echo view('login1');
                    echo view('login_errors/korisnik');
                    echo view('login2');
                    echo view('static/footer');
                break;
            }
        }
    }
}
