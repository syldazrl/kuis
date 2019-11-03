<?php

class Soal_Model extends CI_Model
{
    public function get($id){
        if($id != null){
            $this->db->where('id_soal', $id['id_soal']);
            $result = $this->db->get('soal');
            return $result->result_array();
        }
        else {
            $result = $this->db->get('soal');
            return $result->result_array();
        }
    }
    public function insert($data){
        $result = $this->db->insert('soal', $data);
        return $result;
    }
    public function update($data){
        $this->db->where("id_soal", $data['id_soal']);
        $result =  $this->db->update("soal", $data);
        return $result;
    }
    public function delete($id){
        $this->db->where('id_soal', $id['id_soal']);
        $result = $this->db->delete('soal');
        return $result;
    }
}
