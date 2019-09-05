<?php
class Racun extends CI_Model
{
    public function stvori($adr_id = 0)
    {
        //Napravi jedinstveni ID računa koristeći trenutno vrijeme i ID korisnika
        $racun_id = time() + $_SESSION['id'];

        //Stvori račun i spremi ga u bazu
        $data = array(
            'id'=>$racun_id,
            'id_korisnik'=>$_SESSION['id'],
            'id_adresa'=>$adr_id
        );
        $this->db->insert('racun', $data);

        //Popuni račun stavkama, odnosno popuni tablicu "stavka" sa određenim ID-jem računa
        foreach ($_SESSION['kosarica'] as $stavka) {
            $data = array(
                'kolicina'=>$stavka['kolicina'],
                'velicina'=>$stavka['velicina'],
                'cijena'=>$stavka['cijena'],
                'id_proizvod'=>$stavka['id'],
                'id_racun'=>$racun_id
            );
            $this->db->insert('stavka', $data);
        }

        //Isprazni košaricu
        $_SESSION['kosarica'] = array();
        $_SESSION['kos_broj'] = 0;
    }
}