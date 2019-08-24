<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    //Početna stranica
    public function index()
    {
        $this->load->view('static/header');

        //Postavi drugačiji tekst na početnoj stranici, ovisno o tipu korisnika
        switch ($_SESSION['tip_korisnika']) {
            case 0: //Gost
                $data['welcomeText'] = '<p>Nudimo brzu dostavu raznih vrsta ukusnih pizza.<br>Za početak možete pogledati naš <a href="'.
                site_url('jelovnik').'">jelovnik</a>.<br>Ako ste već registrirani korisnik, prijavite se <a href="'.site_url('login').'">ovdje</a>.</p>';
            break;
            case 1: //Administrator
            case 2: //Korisnik
                $data['welcomeText'] = '<p>Nudimo brzu dostavu raznih vrsta ukusnih pizza.<br>Za početak možete pogledati naš <a href="'.
                site_url('jelovnik').'">jelovnik</a>.';
            break;
            default:
                $data['welcomeText'] = '<p>Došlo je do greške u sustavu</p>';
        }
        
        $this->load->view('home', $data);
        $this->load->view('static/footer');
    }
}