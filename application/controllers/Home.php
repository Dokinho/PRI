<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    //Početna stranica
    public function index()
    {
        $data['welcomeText'] = 'Pregledajte naš jelovnik, nećete požaliti!<br>Također, registrirajte se!';

        /*if (!file_exists(APPPATH.'views/'.$page.'.php')) {
            show_404();
        }*/
        $this->load->view('static/header');
        $this->load->view('home', $data);
        $this->load->view('static/footer');
    }
}