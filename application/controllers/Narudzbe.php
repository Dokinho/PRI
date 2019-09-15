<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Narudzbe extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'NetPizza - Narudžbe';
        $data['page'] = 'narudzbe';

        $this->load->model('racun');

        $this->load->view('static/header', $data);
        $this->load->view('narudzbe/narudzbe');

        $racuni = $this->racun->ucitajR();
        if (isset($racuni[0])) {
            //Korisnik ima narudžbe u bazi - prikaži ih
            foreach ($racuni as $i=>$racun) {
                $data = array(
                    'racun_broj'=>$i,
                    'racun_id'=>$racun->id,
                    'datum'=>$racun->datum,
                    'stavke'=>$this->racun->ucitajS($racun->id),
                );
                $this->load->view('narudzbe/narudzbe_item', $data);
            }
        } else {
            //Korisnik nema spremljenih narudžbi u bazi - obavijesti ga
            $this->load->view('narudzbe/narudzbe_empty');
        }

        $this->load->view('narudzbe/narudzbe_kraj');
        $this->load->view('static/footer');
    }
}