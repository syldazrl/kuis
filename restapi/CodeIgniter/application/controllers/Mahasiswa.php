<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';
class Periode extends API_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Mahasiswa_model", "MahasiswaModel");
    }

    public function getMahasiswa(){
        $id = $_GET;
        $result = $this->MahasiswaModel->get($id);
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

    public function insertMahasiswa(){
        $pos = $this->input->raw_input_stream;
        $data = $this->MahasiswaModel->insert(json_decode($pos));
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
        $data = $this->MahasiswaModel->update($pos);
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
        $result = $this->MahasiswaModel->delete($id);
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