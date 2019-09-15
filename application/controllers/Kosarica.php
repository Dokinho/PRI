<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kosarica extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'NetPizza - Košarica';
        $data['page'] = 'kosarica';

        $this->load->view('static/header', $data);

        switch ($_SESSION['tip_korisnika']) {
            case 0: //Gost
                $this->load->view('kosarica/kosarica_gost', $data);
            break;
            case 1: //Administrator
            case 2: //Korisnik
                $this->load->model('adresa');
                $data['adrese'] = $this->adresa->ucitaj();
            
                $this->load->view('kosarica/kosarica', $data);
            break;
            default: //Nešto ne valja
        }
        $this->load->view('static/footer');
    }

    public function ukloni($id)
    {
        array_splice($_SESSION['kosarica'], $id, 1);
        $_SESSION['kos_broj']--;
        
        redirect('kosarica');
    }

    public function kolplus($id)
    {
        $_SESSION['kosarica'][$id]['kolicina']++;

        redirect('kosarica');
    }

    public function kolminus($id)
    {
        if ($_SESSION['kosarica'][$id]['kolicina'] > 1)
        $_SESSION['kosarica'][$id]['kolicina']--;

        redirect('kosarica');
    }

    public function naruci()
    {
        $this->load->model('racun');
        //Provjeri ima li proizvoda u košarici (kako ne bi došlo do problema pri osvježavanju stranice)
        if ($_SESSION['kosarica']) {
            $adr_id = $this->input->post('adr-choose');
            $this->racun->stvori($adr_id);

            $data['title'] = 'NetPizza - Košarica';
            $data['page'] = 'kosarica';
    
            $this->load->view('static/header', $data);
            $this->load->view('kosarica/kosarica_success');      
            $this->load->view('static/footer');
        }
        else {
            redirect('kosarica');
        }
    }   
}