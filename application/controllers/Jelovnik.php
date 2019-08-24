<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jelovnik extends CI_Controller
{
    public function index()
    {
        $this->load->view('static/header');
        $this->load->view('jelovnik');
        $this->load->view('static/footer');
    }
}