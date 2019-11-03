<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';
class Periode extends API_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Petugas_model", "PetugasModel");
    }

    public function getPetugas(){
        $id = $_GET;
        $result = $this->PetugasModel->get($id);
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

    public function insertPetugas(){
        $pos = $this->input->raw_input_stream;
        $data = $this->PetugasModel->insert(json_decode($pos));
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

    public function updatePetugas(){
        $pos =json_decode($this->input->raw_input_stream);
        $data = $this->PetugasModel->update($pos);
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

    public function deletePetugas(){
        $id = $_GET;
        $result = $this->PetugasModel->delete($id);
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