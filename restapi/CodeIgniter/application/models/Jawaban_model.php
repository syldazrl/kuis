<?php

class Role_Model extends CI_Model
{
    public function get($id){
        if($id != null){
            $this->db->where('id_Jawaban', $id['id_Jawaban']);
            $result = $this->db->get('Jawaban');
            return $result->result_array();
        }
        else {
            $result = $this->db->get('Jawaban');
            return $result->result_array();
        }
    }

    public function insert($data){
        $result = $this->db->insert('Jawaban', $data);
        return $result;
    }

    public function update($data){
        $this->db->where("id_Jawaban", $data->id_Petugas);
        $result =  $this->db->update("Jawaban", $data);
        return $result;
    }
    
    public function delete($id){
        $this->db->where('id_Jawaban', $id['id_Jawaban']);
        $result = $this->db->delete('Jawaban');
        return $result;
    }
    
}
