<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('korisnik');
        $this->load->model('proizvod');
        $this->load->model('racun');

        if (!$_SESSION['tip_korisnika'] == 1) {
            redirect('home');
        }
    }

    function index()
    {
        $data['title'] = 'NetPizza - Administracija';
        $data['page'] = 'admin';

        $this->load->view('static/header', $data);        
        $this->load->view('admin/admin');
        $this->load->view('static/footer');
    }

    function korisnici()
    {
        $data['title'] = 'NetPizza - Administracija - Korisnici';
        $data['page'] = 'korisnici';
        $data['korisnici'] = $this->korisnik->ucitajSve();

        $this->load->view('static/header', $data);
        $this->load->view('admin/korisnici', $data);
        $this->load->view('static/footer');
    }

    function promjeniKorisnika($id, $tip)
    {
        $this->korisnik->promjeniTip($id, $tip);
        redirect('admin/korisnici');
    }

    function pizze()
    {
        $data['title'] = 'NetPizza - Administracija - Pizze';
        $data['page'] = 'pizze';
        $data['pizze'] = $this->proizvod->ucitaj();

        $this->load->view('static/header', $data);
        $this->load->view('admin/pizze', $data);
        $this->load->view('static/footer');
    }

    function dodajPizzu()
    {

    }

    function narudzbe()
    {
        $data['title'] = 'NetPizza - Administracija - Narudžbe';
        $data['page'] = 'narudzbe_admin';

        $this->load->view('static/header', $data);
        $this->load->view('admin/narudzbe', $data);

        $racuni = $this->racun->ucitajSveR();
        foreach ($racuni as $racun) {
            $data = array(
                'racun_id'=>$racun->id,
                'datum'=>$racun->datum,
                'stavke'=>$this->racun->ucitajSAdmin($racun->id),
            );
            $this->load->view('admin/narudzbe_item', $data);
        }
        $this->load->view('admin/narudzbe_kraj');
        $this->load->view('static/footer');
    }
}