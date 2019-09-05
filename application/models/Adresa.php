<?php
class Adresa extends CI_Model
{
    //Učitava sve adrese korisnika
    public function ucitaj()
    {
        $sql = $this->db->get_where('adresa', array('id_korisnik'=>$_SESSION['id']));
        return $sql->result();
    }

    //Mijenja podatke za određenu adresu korisnika
    public function izmjeni ($i, $id)
    {
        if ($this->input->post('kratica'.$i)) {
            $kratica = $this->input->post('kratica'.$i);
        } else {
            $kratica = 'Adresa '.$i + 1;
        }

        $data = array(
            'naslov'=>$this->input->post('kratica'.$i),
            'ime'=>$this->input->post('ime'.$i),
            'prezime'=>$this->input->post('prezime'.$i),
            'telefon'=>$this->input->post('telefon'.$i),
            'ulica'=>$this->input->post('ulica'.$i),
            'kucni_broj'=>$this->input->post('kucni_broj'.$i)
        );
        

        $this->db->where('id', $id);
        $this->db->update('adresa', $data);
    }

    //Uklanja određenu adresu korisnika
    public function ukloni($id)
    {
        $this->db->where('id', $id);
        $data['id_korisnik'] = 0;
        $this->db->update('adresa', $data);
    }

    public function dodaj($i)
    {
        if ($this->input->post('newkratica')) {
            $kratica = $this->input->post('newkratica');
        } else {
            $kratica = 'Adresa '.$i;
        }

        $data = array(
            'naslov'=>$kratica,
            'ime'=>$this->input->post('newime'),
            'prezime'=>$this->input->post('newprezime'),
            'telefon'=>$this->input->post('newtelefon'),
            'ulica'=>$this->input->post('newulica'),
            'kucni_broj'=>$this->input->post('newkucni_broj'),
            'id_korisnik'=>$_SESSION['id']
        );

        $this->db->insert('adresa', $data);
    }
}
