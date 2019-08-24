<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('static/header');

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

        //Učitavanje biblioteke za provjeru valjanosti forme
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');
        $this->load->model('korisnik', '', true);

        //Postavljanje pravila za provjeru valjanosti forme i error poruka
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email',
            array('required'=>'Unesite email adresu.', 'valid_email'=>'Unesena email adresa nije ispravna')
        );
        $this->form_validation->set_rules(
            'lozinka',
            'Lozinka',
            'required',
            array('required'=>'Unesite lozinku.')
        );

        //Prvi dio provjere valjanosti unosa (provjera prije slanja upita bazi)
        if ($this->form_validation->run() == false) {
            $this->load->view('login1');
            $this->load->view('login2');
            $this->load->view('static/footer');
        } else {
            //Drugi dio provjere valjanosti unosa (provjera nakon slanja upita bazi)
            $rezultat = $this->korisnik->ucitaj();
            switch ($rezultat['kod']) {
                case 0: //Uspješna prijava

                    /* Postavljanje session varijabli, string "tip_korisnika" iz baze se pretvara u broj:
                    0 - Gost. Ne može se postaviti ovdje, postavlja se u header.php ako korisnik nije prijavljen
                    1 - Administrator
                    2- Korisnik */
                    if ($rezultat['result']->tip_korisnika == 'administrator')
                        $_SESSION['tip_korisnika'] = 1;
                    else $_SESSION['tip_korisnika'] = 2;
                    $_SESSION['ime'] = $rezultat['result']->ime;
                    $_SESSION['prezime'] = $rezultat['result']->prezime;
                    $_SESSION['email'] = $rezultat['result']->email;
                    $_SESSION['logged_in'] = true;

                    //Preusmjeravanje na početnu stranicu
                    redirect('home');
                break;
                case 1: //Netočna lozinka
                    $this->load->view('login1');
                    $this->load->view('loginerrors/lozinka');
                    $this->load->view('login2');
                    $this->load->view('static/footer');
                break;
                case 2: //Ne postoji korisnik
                    $this->load->view('login1');
                    $this->load->view('loginerrors/korisnik');
                    $this->load->view('login2');
                    $this->load->view('static/footer');
                break;
            }
        }
    }
}
