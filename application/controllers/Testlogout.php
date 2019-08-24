<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Testlogout extends CI_Controller
{
    public function index()
    {
        session_destroy();
        redirect('home');
    }
}
