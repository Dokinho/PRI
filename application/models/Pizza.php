<?php
class Pizza extends CI_Model
{
    //Služi za dodavanje novih pizza u bazu
    public function dodaj()
    {
        $data = array(
            'naziv'=>$this->input->post('naziv'),
            'cijena_m'=>$this->input->post('cijena_m'),
            'cijena_s'=>$this->input->post('cijena_s'),
            'cijena_j'=>$this->input->post('cijena_j'),
            'slika'=>$this->input->post('slika')
        );

        //Ubacuje podatke u bazu
        $this->db->insert('proizvod', $data);
    }
}