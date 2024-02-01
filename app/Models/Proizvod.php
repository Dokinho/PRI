<?php
namespace App\Models;
use CodeIgniter\Model;

class Proizvod extends Model
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
        $db->insert('proizvod', $data);
    }*/

    public function ucitaj() {
        $builder = $this->db->table('proizvod');
        $builder->where('uponudi', 1);
        $sql = $builder->get();
        return $sql->getResult();
    }

    public function ucitajPoID($id) {
        $builder = $this->db->table('proizvod');
        $sql = $builder->getWhere(array('id'=>$id));
        return $sql->getRow();
    }

    public function izmjeni()
    {
        $builder = $this->db->table('proizvod');

        if (isset($_POST['pizza-edit'])) {
            foreach ($_POST['pizza-edit'] as $pizzaID) {
                $data = array(
                    'naziv'=>$_POST['naziv'][$pizzaID],
                    'opis'=>$_POST['opis'][$pizzaID],
                    'cijena_m'=>$_POST['cijena_m'][$pizzaID],
                    'cijena_s'=>$_POST['cijena_s'][$pizzaID],
                    'cijena_j'=>$_POST['cijena_j'][$pizzaID]
                );
                $builder->where('id', $pizzaID);
                $builder->update('proizvod', $data);
            }
        }
    }

    public function ukloni($id)
    {
        $builder = $this->db->table('proizvod');
        $builder->where('id', $id);
        $data['uponudi'] = 0;
        $builder->update('proizvod', $data);
    }
}