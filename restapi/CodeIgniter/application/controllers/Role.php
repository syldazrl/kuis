<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';
class Role extends API_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Role_model", "RoleModel");
    }

    public function getRole(){
        $id = $_GET;
        $result = $this->RoleModel->get($id);
        if(!empty($result)){
            $this->api_return(
                [
                    "data" => $result
                ], 200
            );
        }else{
            $this->api_return(
                [
                    "data" => "Data Kosong"
                ], 400
            );
        }
    }

    public function insertRole(){
        $pos = $this->input->raw_input_stream;
        $data = $this->RoleModel->insert(json_decode($pos));
        if($data){
            $this->api_return(
                [
                    'status' => true
                ],
        200);
        }else{
            $this->api_return(
                [
                    'status' => false
                ],
        400);
        }
    }

    public function updateRole(){
        $put =json_decode($this->input->raw_input_stream);
        $data = $this->RoleModel->update($put);
        if($data){
            $this->api_return(
                [
                    'status' => true
                ],
        200);
        }else{
            $this->api_return(
                [
                    'status' => false
                ],
        400);
        }
    }

    public function deleteRole(){
        $id = $_GET;
        $result = $this->RoleModel->delete($id);
        if($result){
            $this->api_return(
                [
                    "data" => $result
                ], 200
            );
        }else{
            $this->api_return(
                [
                    "data" => $result
                ], 400
            );
        }
    }



}