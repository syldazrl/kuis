<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';
class Periode extends API_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Jawaban_model", "JawabanModel");
    }

    public function getJawaban(){
        $id = $_GET;
        $result = $this->JawabanModel->get($id);
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

    public function insertJawaban(){
        $pos = $this->input->raw_input_stream;
        $data = $this->JawabanModel->insert(json_decode($pos));
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

    public function updateMahasiswa(){
        $pos =json_decode($this->input->raw_input_stream);
        $data = $this->JawabanModel->update($pos);
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

    public function deleteMahasiswa(){
        $id = $_GET;
        $result = $this->JawabanModel->delete($id);
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