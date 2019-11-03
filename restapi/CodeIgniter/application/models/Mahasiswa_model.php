<?php

class Role_Model extends CI_Model
{
    public function get($id){
        if($id != null){
            $this->db->where('id_Mahasiswa', $id['id_Mahasiswa']);
            $result = $this->db->get('Mahasiswa');
            return $result->result_array();
        }
        else {
            $result = $this->db->get('Mahasiswa');
            return $result->result_array();
        }
    }

    public function insert($data){
        $result = $this->db->insert('Mahasiswa', $data);
        return $result;
    }

    public function update($data){
        $this->db->where("id_Mahasiswa", $data->id_Mahasiswa);
        $result =  $this->db->update("Mahasiswa", $data);
        return $result;
    }

    public function delete($id){
        $this->db->where('id_Mahasiswa', $id['id_Mahasiswa']);
        $result = $this->db->delete('Mahasiswa');
        return $result;
    }
    
}
