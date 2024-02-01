<?php
namespace App\Models;
use CodeIgniter\Model;

class Korisnik extends Model
{
    //Služi za dodavanje korisnika u bazu
    public function dodaj()
    {
        $builder = $this->db->table('korisnik');

        //Učitava POST varijable u varijable modela, a na lozinku posebno primjenjuje hash funkciju
        $data = array(
            'tip_korisnika'=>2, //admin = 1, korisnik = 2
            'ime'=>$this->input->post('ime'),
            'prezime'=>$this->input->post('prezime'),
            'telefon'=>$this->input->post('telefon'),
            'email'=>$this->input->post('email'),
            'lozinka'=>password_hash($this->input->post('lozinka'), PASSWORD_BCRYPT)
        );

        //Ubacuje podatke u bazu
        $builder->insert('korisnik', $data);

        //Vraća unesene podatke kako bi se mogla izvršiti automatska prijava na sustav nakon uspješne registracije
        return $data;
    }

    //Funkcija za login
    public function ucitaj()
    {
        $builder = $this->db->table('korisnik');

        //Učitava predane POST varijable iz login forme
        $data = array(
            'email'=>$this->input->post('email'),
            'lozinka'=>$this->input->post('lozinka'),
        );

        //Pravi upit i sprema rezultat upita u varijablu
        $sql = $builder->getWhere('korisnik', array('email'=>$data['email']));
        $result = $sql->getRow();

        /* Ovisno o tome postoji li korisnik i je li ispravna lozinka, uz rezultat upita vraća i određeni kontrolni broj Login kontroleru:
        0 - Ispravna lozinka (i postoji korisnik)
        1 - Neispravna lozinka (i postoji korisnik)
        2 - Ne postoji korisnik (nema provjere ispravnosti lozinke)

        Postoji li korisnik (email)? */
        if (isset($result)){
            //Provjera lozinke
            if(password_verify($data['lozinka'], $result->lozinka)) {
                return array('result'=>$result, 'kod'=>0);
            }else {
                return array('result'=>$result, 'kod'=>1);
            }
        } else {
            //Nema korisnika
            return array('result'=>$result, 'kod'=>2);
        }
    }

    public function ucitajPoMailu()
    {
        $builder = $this->db->table('korisnik');
        $sql = $builder->getWhere('korisnik', array('email'=>$_SESSION['email']));
        return $sql->getRow();
    }

    public function izmjeni()
    {
        $builder = $this->db->table('korisnik');

        $mail = $this->input->post('email');
        $lozinka = $this->input->post('lozinka');
        
        if (isset($mail)){
            $data['email'] = $this->input->post('email');
        }
        if (isset($lozinka)) {
            $data['lozinka'] = password_hash($this->input->post('lozinka'), PASSWORD_BCRYPT);
        }

        $builder->where('email', $_SESSION['email']);
        $builder->update('korisnik', $data);

        return $data;
    }

    public function ukloni()
    {
        $builder = $this->db->table('korisnik');

        $id = $_SESSION['id'];

        //"Brisanje" korisnikovih adresa i računa
        $data['id_korisnik'] = 0;

        $builder->where('id_korisnik', $id);
        $builder->update('adresa', $data);

        $builder->where('id_korisnik', $id);
        $builder->update('racun', $data);

        //Brisanje korisnika
        $builder->where('id', $id);
        $builder->delete('korisnik');

        //Odjava
        session_destroy();
    }

    /* Nekorišteno
    public function ucitajSve()
    {
        $sql = $db->get('korisnik');
        return $sql->result();
    }
    */

    public function promjeniTip($id, $tip)
    {
        $builder = $this->db->table('korisnik');
        $builder->where('id', $id);
        $data['tip_korisnika'] = $tip;
        $builder->update('korisnik', $data);
    }

    public function traziPoImenu($string = "")
    {
        $builder = $this->db->table('korisnik');
        $sql = $builder->query('SELECT * FROM korisnik k WHERE (LOCATE("'.$string.'", k.ime) > 0) OR (LOCATE("'.$string.'", k.prezime) > 0);');
        return $sql->result();
    }

    public function traziPoMailu($string = "")
    {
        $builder = $this->db->table('korisnik');
        $sql = $builder->query('SELECT * FROM korisnik k WHERE (LOCATE("'.$string.'", k.email) > 0);');
        return $sql->result();
    }

    /* Nekorišteno
    public function ucitajAdmine()
    {
        $db->where('tip_korisnika', 'administrator');
        $sql = $db->get('korisnik');
        return $sql->result();
    }
    */
}
