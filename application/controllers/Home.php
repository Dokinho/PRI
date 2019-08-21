<?php
class Home extends CI_Controller
{
    public function index($page = 'login')
    {
        if (!file_exists(APPPATH.'views/'.$page.'.php')) {
            show_404();
        }
        $this->load->view('static/header');
        $this->load->view($page);
        $this->load->view('static/footer');
    }
}