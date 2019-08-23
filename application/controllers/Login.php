<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        //Učitavanje biblioteke za provjeru valjanosti forme, te modela "Korisnik" koji komunicira sa bazom
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
            $this->load->view('static/header');
            $this->load->view('login1');
            $this->load->view('login2');
            $this->load->view('static/footer');
        } else {
            //Drugi dio provjere valjanosti unosa (provjera nakon slanja upita bazi)
            $rezultat = $this->korisnik->ucitaj();
            switch ($rezultat['kod']) {
                case 0: //Uspješna prijava
                    //Tu stavi kod za postavljanje session varijabli???
                    redirect('home');
                break;
                case 1: //Netočna lozinka
                    $this->load->view('static/header');
                    $this->load->view('login1');
                    $this->load->view('loginerrors/lozinka');
                    $this->load->view('login2');
                    $this->load->view('static/footer');
                break;
                case 2: //Ne postoji korisnik
                    $this->load->view('static/header');
                    $this->load->view('login1');
                    $this->load->view('loginerrors/korisnik');
                    $this->load->view('login2');
                    $this->load->view('static/footer');
                break;
            }
        }
    }
}
