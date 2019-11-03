<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';
class Periode extends API_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("UserInRuleModel", "UserInRuleModel");
    }

    public function getUserInRule(){
        $id = $_GET;
        $result = $this->UserInRuleModel->get($id);
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

    public function insertUserInRule(){
        $pos = $this->input->raw_input_stream;
        $data = $this->UserInRuleModel->insert(json_decode($pos));
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

    public function updateUserInRule(){
        $pos =json_decode($this->input->raw_input_stream);
        $data = $this->UserInRuleModel->update($pos);
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

    public function deleteUserInRule(){
        $id = $_GET;
        $result = $this->UserInRuleModel->delete($id);
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