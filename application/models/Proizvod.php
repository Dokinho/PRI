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

    public function ucitaj() {
        $this->db->where('uponudi', 1);
        $sql = $this->db->get('proizvod');
        return $sql->result();
    }

    public function ucitajPoID($id) {
        $sql = $this->db->get_where('proizvod', array('id'=>$id));
        return $sql->row();
    }

    public function izmjeni()
    {
        if (isset($_POST['pizza-edit'])) {
            foreach ($_POST['pizza-edit'] as $pizzaID) {
                $data = array(
                    'naziv'=>$_POST['naziv'][$pizzaID],
                    'opis'=>$_POST['opis'][$pizzaID],
                    'cijena_m'=>$_POST['cijena_m'][$pizzaID],
                    'cijena_s'=>$_POST['cijena_s'][$pizzaID],
                    'cijena_j'=>$_POST['cijena_j'][$pizzaID]
                );
                $this->db->where('id', $pizzaID);
                $this->db->update('proizvod', $data);
            }
        }
    }

    public function ukloni($id)
    {
        $this->db->where('id', $id);
        $data['uponudi'] = 0;
        $this->db->update('proizvod', $data);
    }
}