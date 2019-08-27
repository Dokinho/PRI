<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kosarica extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'NetPizza - Košarica';
        $data['page'] = 'kosarica';

        $this->load->view('static/header', $data);
        $this->load->view('kosarica');
        $this->load->view('static/footer');
    }

    public function ukloni($broj)
    {
        array_splice($_SESSION['kosarica'], $broj, 1);
        $_SESSION['kos_broj']--;
        
        redirect('kosarica');
    }
}