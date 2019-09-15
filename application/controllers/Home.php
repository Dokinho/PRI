<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    //Početna stranica
    public function index()
    {
        $data['title'] = 'NetPizza';
        $data['page'] = 'home';
        $this->load->view('static/header', $data);

        //Postavi drugačiji tekst na početnoj stranici, ovisno o tipu korisnika
        switch ($_SESSION['tip_korisnika']) {
            case 0: //Gost
                $data['welcome_text'] = 'Nudimo brzu dostavu raznih vrsta ukusnih pizza.<br>Za početak možete pogledati naš <a href="'.
                site_url('jelovnik').'">jelovnik</a>.<br>Ako ste već registrirani korisnik, prijavite se <a href="'.site_url('login').'">ovdje</a>.';
            break;
            case 1: //Administrator
            case 2: //Korisnik
                $data['welcome_text'] = 'Nudimo brzu dostavu raznih vrsta ukusnih pizza.<br>Za početak možete pogledati naš <a href="'.
                site_url('jelovnik').'">jelovnik</a>.';
            break;
            default:
                $data['welcome_text'] = 'Došlo je do greške u sustavu';
        }
        
        $this->load->view('home', $data);
        $this->load->view('static/footer');
    }
}
