<?php

class Role_Model extends CI_Model
{
    public function get($id){
        if($id != null){
            $this->db->where('id_Petugas', $id['id_Petugas']);
            $result = $this->db->get('Petugas');
            return $result->result_array();
        }
        else {
            $result = $this->db->get('Petugas');
            return $result->result_array();
        }
    }
    public function insert($data){
        $result = $this->db->insert('Petugas', $data);
        return $result;
    }
    public function update($data){
        $this->db->where("id_Petugas", $data->id_Petugas);
        $result =  $this->db->update("Petugas", $data);
        return $result;
    }
    public function delete($id){
        $this->db->where('id_Petugas', $id['id_Petugas']);
        $result = $this->db->delete('Petugas');
        return $result;
    }
    
}
