<?php
class Korisnik extends CI_Model
{
    //Služi za dodavanje korisnika u bazu
    public function dodaj()
    {
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
        $this->db->insert('korisnik', $data);

        //Vraća unesene podatke kako bi se mogla izvršiti automatska prijava na sustav nakon uspješne registracije
        return $data;
    }

    //Funkcija za login
    public function ucitaj()
    {
        //Učitava predane POST varijable iz login forme
        $data = array(
            'email'=>$this->input->post('email'),
            'lozinka'=>$this->input->post('lozinka'),
        );

        //Pravi upit i sprema rezultat upita u varijablu
        $sql = $this->db->get_where('korisnik', array('email'=>$data['email']));
        $result = $sql->row();

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
        $sql = $this->db->get_where('korisnik', array('email'=>$_SESSION['email']));
        return $sql->row();
    }

    public function izmjeni()
    {   $mail = $this->input->post('email');
        $lozinka = $this->input->post('lozinka');
        
        if (isset($mail)){
            $data['email'] = $this->input->post('email');
        }
        if (isset($lozinka)) {
            $data['lozinka'] = password_hash($this->input->post('lozinka'), PASSWORD_BCRYPT);
        }

        $this->db->where('email', $_SESSION['email']);
        $this->db->update('korisnik', $data);

        return $data;
    }

    public function ukloni()
    {
        $id = $_SESSION['id'];

        //"Brisanje" korisnikovih adresa i računa
        $data['id_korisnik'] = 0;

        $this->db->where('id_korisnik', $id);
        $this->db->update('adresa', $data);

        $this->db->where('id_korisnik', $id);
        $this->db->update('racun', $data);

        //Brisanje korisnika
        $this->db->where('id', $id);
        $this->db->delete('korisnik');

        //Odjava
        session_destroy();
    }

    public function ucitajSve()
    {
        $sql = $this->db->get('korisnik');
        return $sql->result();
    }

    public function promjeniTip($id, $tip)
    {
        $this->db->where('id', $id);
        $data['tip_korisnika'] = $tip;
        $this->db->update('korisnik', $data);
    }
}
