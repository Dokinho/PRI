<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Jelovnik extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->proizvod = model('Proizvod');
    }
    
    //Učitava sve proizvode i prikazuje ih na stranici
    public function index()
    {
        if (!isset($_SESSION['kosarica'])) {
            $_SESSION['kosarica'] = array();
            $_SESSION['kos_broj'] = 0;
        }

        $data['title'] = 'NetPizza - Jelovnik';
        $data['page'] = 'jelovnik';

        echo view('static/header', $data);
        echo view('jelovnik/jelovnik');

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
            echo view('jelovnik/jelovnik_item', $data);
        };
        echo view('jelovnik/jelovnik_kraj');
        echo view('static/footer');
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

    public function ukloni($id, $stranica)
    {
        array_splice($_SESSION['kosarica'], $id, 1);
        $_SESSION['kos_broj']--;

        redirect($stranica);
    }

    public function kolplus($id, $stranica)
    {
        $_SESSION['kosarica'][$id]['kolicina']++;

        redirect($stranica);
    }

    public function kolminus($id, $stranica)
    {
        if ($_SESSION['kosarica'][$id]['kolicina'] > 1)
        $_SESSION['kosarica'][$id]['kolicina']--;

        redirect($stranica);
    }
}
