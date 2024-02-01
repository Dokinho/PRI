<?php
namespace App\Models;
use CodeIgniter\Model;

class Racun extends Model
{
    public function stvori($adr_id = 0)
    {
        $builder = $this->db->table('racun');

        //Zabilježi trenutno lokalno vrijeme i datum u određenom formatu
        $date = date('Y-m-d H:i:s');

        //Stvori narudžbu i spremi ju u bazu
        $data = array(
            'datum'=>$date,
            'id_korisnik'=>$_SESSION['id'],
            'id_adresa'=>$adr_id
        );
        $builder->insert('racun', $data);

        //Dobavi tu istu narudžbu (zbog ID-ja)
        $builder->where('id_korisnik', $_SESSION['id']);
        $builder->where('datum', $date);
        $sql = $builder->get('racun');
        $racun = $sql->getRow();

        //Popuni narudžbu (iliti račun) stavkama, odnosno popuni tablicu "stavka" sa detaljima i odgovarajućim ID-jem računa
        foreach ($_SESSION['kosarica'] as $stavka) {
            $data = array(
                'kolicina'=>$stavka['kolicina'],
                'velicina'=>$stavka['velicina'],
                'cijena'=>$stavka['cijena'],
                'id_proizvod'=>$stavka['id'],
                'id_racun'=>$racun->id
            );
            $builder->insert('stavka', $data);
        }

        //Isprazni košaricu
        $_SESSION['kosarica'] = array();
        $_SESSION['kos_broj'] = 0;
    }

    //Prikazuje zadnjih 10 narudžbi
    public function ucitajR()
    {
        $builder = $this->db->table('racun');
        $builder->where('id_korisnik', $_SESSION['id']);
        $builder->orderBy('datum', 'DESC');
        $sql = $builder->get('racun', 10, 0);
        return $sql->result();
    }

    public function ucitajS($rID)
    {
        $builder = $this->db->table('racun');
        $sql = $builder->query(
            'SELECT p.naziv, s.velicina, s.cijena, s.kolicina '.
            'FROM proizvod p, stavka s, racun r '.
            'WHERE r.id = '.$rID.' AND p.id = s.id_proizvod AND r.id = s.id_racun AND r.id_korisnik = '.$_SESSION['id'].';'
        );
        return $sql->result();
    }

    //Zasad učitava zadnjih 10 računa
    public function ucitajSveR()
    {
        $builder = $this->db->table('racun');
        $builder->orderBy('datum', 'DESC');
        $sql = $builder->get('racun', 10, 0);
        return $sql->result();
    }

    public function ucitajSAdmin($rID)
    {
        $builder = $this->db->table('racun');
        $sql = $builder->query(
            'SELECT k.ime, k.prezime, p.naziv, s.velicina, s.cijena, s.kolicina '.
            'FROM korisnik k, proizvod p, stavka s, racun r '.
            'WHERE r.id = '.$rID.' AND p.id = s.id_proizvod AND r.id = s.id_racun AND r.id_korisnik = k.id;'
        );
        return $sql->result();
    }
}