<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Admin extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->korisnik = model('Korisnik');
        $this->proizvod = model('Proizvod');
        $this->racun = model('Racun');

        if (!$_SESSION['tip_korisnika'] == 1) {
            redirect('home');
        }
    }

    function index()
    {
        $data['title'] = 'NetPizza - Administracija';
        $data['page'] = 'admin';

        echo view('static/header', $data);        
        echo view('admin/admin');
        echo view('static/footer');
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

        echo view('static/header', $data);
        echo view('admin/korisnici', $data);
        echo view('static/footer');
    }

    /*Nekorišteno
    function administratori()
    {
        $data['title'] = 'NetPizza - Administracija - Administratori';
        $data['page'] = 'administratori';
        $data['administratori'] = $this->korisnik->ucitajAdmine();

        echo view('static/header', $data);
        echo view('admin/admini', $data);
        echo view('static/footer');
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

        echo view('static/header', $data);
        echo view('admin/pizze', $data);
        echo view('static/footer');
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

        $validation = \Config\Services::validation();
        // $validation->set_error_delimiters('<p class="form-error">', '</p>');

        echo view('static/header', $data);
        echo view('admin/dodajpizzu', $data);
        echo view('static/footer');
    }

    function narudzbe()
    {
        $data['title'] = 'NetPizza - Administracija - Narudžbe';
        $data['page'] = 'narudzbe_admin';

        echo view('static/header', $data);
        echo view('admin/narudzbe', $data);

        $racuni = $this->racun->ucitajSveR();
        foreach ($racuni as $racun) {
            $data = array(
                'racun_id'=>$racun->id,
                'datum'=>$racun->datum,
                'stavke'=>$this->racun->ucitajSAdmin($racun->id),
            );
            echo view('admin/narudzbe_item', $data);
        }
        echo view('admin/narudzbe_kraj');
        echo view('static/footer');
    }
}