<?php

class User_Model extends CI_Model
{
    public function get($id){
        if($id != null){
            $this->db->where('id_User', $id['id_User']);
            $result = $this->db->get('User');
            return $result->result_array();
        }
        else {
            $result = $this->db->get('User');
            return $result->result_array();
        }
    }
    public function insert($data){
        $result = $this->db->insert('User', $data);
        return $result;
    }
    public function update($data){
        $this->db->where("id_User", $data->id_User);
        $result =  $this->db->update("User", $data);
        return $result;
    }
    public function delete($id){
        $this->db->where('id_User', $id['id_User']);
        $result = $this->db->delete('User');
        return $result;
    }
    
}
