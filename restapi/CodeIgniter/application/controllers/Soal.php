<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';
class Soal extends API_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Soal_model", "SoalModel");
    }

    public function getSoal(){
        $id = $_GET;
        $result = $this->SoalModel->get($id);
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

    public function insertSoal(){
        $pos = $this->input->raw_input_stream;
        $data = $this->SoalModel->insert(json_decode($pos));
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

    public function updatesoal(){
        $put =json_decode($this->input->raw_input_stream);
        $data = $this->SoalModel->update($put);
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

    public function delete(){
        $id = $_GET;
        $result = $this->SoalModel->delete($id);
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