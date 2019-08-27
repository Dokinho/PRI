<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('korisnik');
    }
    
    public function index()
    {
        $data['title'] = 'NetPizza - Registracija';
        $this->load->view('static/header', $data);

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

        //Postavljanje pravila za provjeru valjanosti forme i error poruka
        $this->form_validation->set_rules(
            'ime',
            'Ime',
            'trim|required|max_length[20]',
            array('required'=>'Unesite ime', 'max_length'=>'Ime ne može sadržavati više od 20 znakova.')
        );
        $this->form_validation->set_rules(
            'prezime',
            'Prezime',
            'trim|required|max_length[20]',
            array('required'=>'Unesite prezime', 'max_length'=>'Prezime ne može sadržavati više od 20 znakova.')
        );
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
        $this->form_validation->set_rules(
            'lozinka',
            'Lozinka',
            'required',
            array('required'=>'Unesite lozinku.')
        );
        $this->form_validation->set_rules(
            'passconf',
            'Potvrda lozinke',
            'required|matches[lozinka]',
            array('required'=>'Potvrdite lozinku.', 'matches'=>'Lozinke se ne podudaraju.')
        );

        if ($this->form_validation->run() == false) {
            $this->load->view('register');
            $this->load->view('static/footer');
        } else {
            $this->load->view('register_success');
            $this->load->view('static/footer');
            $this->korisnik->dodaj();
        }
    }
}
