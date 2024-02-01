<?php
namespace App\Models;
use CodeIgniter\Model;

class Adresa extends Model
{
    //Učitava sve adrese korisnika
    public function ucitaj()
    {
        $builder = $this->db->table('adresa');
        $sql = $builder->getWhere('adresa', array('id_korisnik'=>$_SESSION['id']));
        return $sql->result();
    }

    //Mijenja podatke za određenu adresu korisnika
    public function izmjeni ($i, $id)
    {
        $builder = $this->db->table('adresa');

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
        

        $builder->where('id', $id);
        $builder->update('adresa', $data);
    }

    //Uklanja određenu adresu korisnika
    public function ukloni($id)
    {
        $builder = $this->db->table('adresa');
        $builder->where('id', $id);
        $data['id_korisnik'] = 0;
        $builder->update('adresa', $data);
    }

    public function dodaj($i)
    {
        $builder = $this->db->table('adresa');
        
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

        $builder->insert('adresa', $data);
    }
}
