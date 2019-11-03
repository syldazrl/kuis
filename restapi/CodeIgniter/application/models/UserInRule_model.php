<?php

class User_Model extends CI_Model
{
    public function get($id){
        if($id != null){
            $this->db->where('id_UserInRule', $id['id_UserInRule']);
            $result = $this->db->get('UserInRule');
            return $result->result_array();
        }
        else {
            $result = $this->db->get('UserInRule');
            return $result->result_array();
        }
    }
    public function insert($data){
        $result = $this->db->insert('UserInRule', $data);
        return $result;
    }
    public function update($data){
        $this->db->where("id_UserInRule", $data->id_User);
        $result =  $this->db->update("UserInRule", $data);
        return $result;
    }
    public function delete($id){
        $this->db->where('id_UserInRule', $id['id_UserInRule']);
        $result = $this->db->delete('UserInRule');
        return $result;
    }
    
}
