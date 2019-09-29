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

    function korisnici($filter = "", $pocemu = "ime")
    {
        $data['title'] = 'NetPizza - Administracija - Korisnici';
        $data['page'] = 'korisnici';

        if ($pocemu == "ime") {
            $data['korisnici'] = $this->korisnik->traziPoImenu($filter);
        } else {
            $data['korisnici'] = $this->korisnik->traziPoMailu($filter);
        }

        $this->load->view('static/header', $data);
        $this->load->view('admin/korisnici', $data);
        $this->load->view('static/footer');
    }

    /*Nekorišteno
    function administratori()
    {
        $data['title'] = 'NetPizza - Administracija - Administratori';
        $data['page'] = 'administratori';
        $data['administratori'] = $this->korisnik->ucitajAdmine();

        $this->load->view('static/header', $data);
        $this->load->view('admin/admini', $data);
        $this->load->view('static/footer');
    }
    */

    function promjeniKorisnika($id, $tip)
    {
        $this->korisnik->promjeniTip($id, $tip);
        redirect('admin/korisnici');
    }

    function traziKorisnika()
    {
        $filter = $this->input->post('filter');
        $pocemu = $this->input->post('pocemu');
        redirect ('admin/korisnici/'.$filter.'/'.$pocemu);
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

    function promjeniPizze()
    {
        $this->proizvod->izmjeni();
        redirect('admin/pizze'); 
    }

    function ukloniPizzu($id = 0)
    {
        $this->proizvod->ukloni($id);
        redirect('admin/pizze');
    }

    function dodajPizzu()
    {
        $data['title'] = 'NetPizza - Administracija - Dodaj Pizzu';
        $data['page'] = 'dodajpizzu';

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<p class="form-error">', '</p>');

        $this->load->view('static/header', $data);
        $this->load->view('admin/dodajpizzu', $data);
        $this->load->view('static/footer');
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