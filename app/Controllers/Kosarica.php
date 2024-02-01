<?php
namespace App\Controllers;

class Kosarica extends BaseController
{

    public function index()
    {
        $data['title'] = 'NetPizza - Košarica';
        $data['page'] = 'kosarica';

        echo view('static/header', $data);

        switch ($_SESSION['tip_korisnika']) {
            case 0: //Gost
                echo view('kosarica/kosarica_gost', $data);
            break;
            case 1: //Administrator
            case 2: //Korisnik
                $this->adresa = model('Adresa');
                $data['adrese'] = $this->adresa->ucitaj();
            
                echo view('kosarica/kosarica', $data);
            break;
            default: //Nešto ne valja
        }
        echo view('static/footer');
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
        $this->racun = model('Racun');
        //Provjeri ima li proizvoda u košarici (kako ne bi došlo do problema pri osvježavanju stranice)
        if ($_SESSION['kosarica']) {
            $adr_id = $this->input->post('adr-choose');
            $this->racun->stvori($adr_id);

            $data['title'] = 'NetPizza - Košarica';
            $data['page'] = 'kosarica';
    
            echo view('static/header', $data);
            echo view('kosarica/kosarica_success');      
            echo view('static/footer');
        }
        else {
            redirect('kosarica');
        }
    }   
}