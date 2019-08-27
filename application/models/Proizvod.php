<?php
class Proizvod extends CI_Model
{
    //Služi za dodavanje novih pizza u bazu (alat za administratora)
    /*
    public function dodaj()
    {
        //Upload se sastoji od dva dijela: upload slike u neki folder i upload podataka u bazu

        $data = array(
            'naziv'=>$this->input->post('naziv'),
            'cijena_m'=>$this->input->post('cijena_m'),
            'cijena_s'=>$this->input->post('cijena_s'),
            'cijena_j'=>$this->input->post('cijena_j'),
            'slika'=>$this->input->post('slika')
        );

        //Ubacuje podatke u bazu
        $this->db->insert('proizvod', $data);
    }*/

    //
    public function ucitaj() {
        $sql = $this->db->get('proizvod');
        return $sql->result();
    }

    public function ucitajPoID($id) {
        $sql = $this->db->get_where('proizvod', array('id'=>$id));
        return $sql->row();
    }
}