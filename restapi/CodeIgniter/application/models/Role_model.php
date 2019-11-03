<?php

class Role_Model extends CI_Model
{
    public function get($id){
        if($id != null){
            $this->db->where('id_Rule', $id['id_Rule']);
            $result = $this->db->get('Rule');
            return $result->result_array();
        }
        else {
            $result = $this->db->get('Rule');
            return $result->result_array();
        }
    }
    public function insert($data){
        $result = $this->db->insert('Rule', $data);
        return $result;
    }
    public function update($data){
        $this->db->where("id_Rule", $data->id_Rule);
        $result =  $this->db->update("Rule", $data);
        return $result;
    }
    public function delete($id){
        $this->db->where('id_Rule', $id['id_Rule']);
        $result = $this->db->delete('Rule');
        return $result;
    }
    
}
