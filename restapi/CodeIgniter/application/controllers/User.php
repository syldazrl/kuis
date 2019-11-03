<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';
class User extends API_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("User_model", "UserModel");
    }

    public function getUser(){
        $id = $_GET;
        $result = $this->UserModel->get($id);
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

    public function insertUser(){
        $pos = $this->input->raw_input_stream;
        $data = $this->UserModel->insert(json_decode($pos));
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

    public function updateUser(){
        $put =json_decode($this->input->raw_input_stream);
        $data = $this->UserModel->update($put);
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

    public function deleteUser(){
        $id = $_GET;
        $result = $this->UserModel->delete($id);
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