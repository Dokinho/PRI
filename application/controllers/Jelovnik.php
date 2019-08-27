<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jelovnik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('proizvod');
    }
    
    //Učitava sve proizvode i prikazuje ih na stranici
    public function index()
    {
        $data['title'] = 'NetPizza - Jelovnik';
        $data['page'] = 'jelovnik';

        $this->load->view('static/header', $data);
        $this->load->view('jelovnik');

        $proizvodi = $this->proizvod->ucitaj();
        foreach ($proizvodi as $proizvod) {
            $data = array(
                'id' => $proizvod->id,
                'naziv' => $proizvod->naziv,
                'opis' => $proizvod->opis,
                'slika' => $proizvod->slika,
                'cijena_m' => $proizvod->cijena_m,
                'cijena_s' => $proizvod->cijena_s,
                'cijena_j' => $proizvod->cijena_j
            );
            $this->load->view('jelovnik_item', $data);
        };
        $this->load->view('jelovnik_kraj');
        $this->load->view('static/footer');
    }

    //Dodaje proizvod u košaricu
    public function dodaj($id, $velicina)
    {
        $proizvod = $this->proizvod->ucitajPoID($id);

        if ($velicina == 'mala') {
            $cijena = $proizvod->cijena_m;
        } elseif ($velicina == 'srednja') {
            $cijena = $proizvod->cijena_s;
        } elseif ($velicina == 'jumbo') {
            $cijena = $proizvod->cijena_j;
        } else {
            redirect('jelovnik');
        }

        $_SESSION['kosarica'][$_SESSION['kos_broj']] = array('id'=>$id, 'slika'=>$proizvod->slika,'naziv'=>$proizvod->naziv,
            'opis'=>$proizvod->opis, 'velicina'=>$velicina, 'cijena'=>$cijena, 'kolicina'=>1);
        $_SESSION['kos_broj']++;

        redirect('jelovnik');
    }

    public function ukloni($broj, $stranica)
    {
        array_splice($_SESSION['kosarica'], $broj, 1);
        $_SESSION['kos_broj']--;

        redirect($stranica);
    }
}
