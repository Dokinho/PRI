<?php
class Racun extends CI_Model
{
    public function stvori($adr_id = 0)
    {
        //Zabilježi trenutno lokalno vrijeme i datum u određenom formatu
        $date = date('Y-m-d H:i:s');

        //Stvori narudžbu i spremi ju u bazu
        $data = array(
            'datum'=>$date,
            'id_korisnik'=>$_SESSION['id'],
            'id_adresa'=>$adr_id
        );
        $this->db->insert('racun', $data);

        //Dobavi tu istu narudžbu (zbog ID-ja)
        $this->db->where('id_korisnik', $_SESSION['id']);
        $this->db->where('datum', $date);
        $sql = $this->db->get('racun');
        $racun = $sql->row();

        //Popuni narudžbu (iliti račun) stavkama, odnosno popuni tablicu "stavka" sa detaljima i odgovarajućim ID-jem računa
        foreach ($_SESSION['kosarica'] as $stavka) {
            $data = array(
                'kolicina'=>$stavka['kolicina'],
                'velicina'=>$stavka['velicina'],
                'cijena'=>$stavka['cijena'],
                'id_proizvod'=>$stavka['id'],
                'id_racun'=>$racun->id
            );
            $this->db->insert('stavka', $data);
        }

        //Isprazni košaricu
        $_SESSION['kosarica'] = array();
        $_SESSION['kos_broj'] = 0;
    }

    //Prikazuje zadnjih 10 narudžbi
    public function ucitajR()
    {
        $this->db->where('id_korisnik', $_SESSION['id']);
        $this->db->order_by('datum', 'DESC');
        $sql = $this->db->get('racun', 10, 0);
        return $sql->result();
    }

    public function ucitajS($rID)
    {
        $sql = $this->db->query(
            'SELECT p.naziv, s.velicina, s.cijena, s.kolicina '.
            'FROM proizvod p, stavka s, racun r '.
            'WHERE r.id = '.$rID.' AND p.id = s.id_proizvod AND r.id = s.id_racun AND r.id_korisnik = '.$_SESSION['id'].';'
        );
        return $sql->result();
    }

    //Zasad učitava zadnjih 10 računa
    public function ucitajSveR()
    {
        $this->db->order_by('datum', 'DESC');
        $sql = $this->db->get('racun', 10, 0);
        return $sql->result();
    }

    public function ucitajSAdmin($rID)
    {
        $sql = $this->db->query(
            'SELECT k.ime, k.prezime, p.naziv, s.velicina, s.cijena, s.kolicina '.
            'FROM korisnik k, proizvod p, stavka s, racun r '.
            'WHERE r.id = '.$rID.' AND p.id = s.id_proizvod AND r.id = s.id_racun AND r.id_korisnik = k.id;'
        );
        return $sql->result();
    }
}