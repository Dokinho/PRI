<?php
namespace App\Controllers;

class Narudzbe extends BaseController
{
    public function index()
    {
        $data['title'] = 'NetPizza - Narudžbe';
        $data['page'] = 'narudzbe';

        $this->racun = model('Racun');

        echo view('static/header', $data);
        echo view('narudzbe/narudzbe');

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
                echo view('narudzbe/narudzbe_item', $data);
            }
        } else {
            //Korisnik nema spremljenih narudžbi u bazi - obavijesti ga
            echo view('narudzbe/narudzbe_empty');
        }

        echo view('narudzbe/narudzbe_kraj');
        echo view('static/footer');
    }
}