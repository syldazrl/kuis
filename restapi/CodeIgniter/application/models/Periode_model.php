<?php

class Periode_Model extends CI_Model{

    public function get($id){
        if($id != null){
            $this->db->where('id_periode', $id['id_Periode']);
            $result = $this->db->get('periode');
            return $result->result_array();
        }
        else {
            $result = $this->db->get('periode');
            return $result->result_array();
        }
    }
    public function insert($data){
        $result = $this->db->insert('periode', $data);
        return $result;
    }
    public function update($data){
        $this->db->where("id_periode", $data->id_Periode);
        $result =  $this->db->update("periode", $data);
        return $result;
    }
    public function delete($id){
        $result = $this->db->where('id_Periode', $id['id_Periode']);
        $result = $this->db->delete('periode');
        return $result;
    }
}
