<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/API_Controller.php';
class Periode extends API_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model("Periode_model", "PeriodeModel");
    }

    public function getPeriode(){
        $id = $_GET;
        $result = $this->PeriodeModel->get($id);
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

    public function insertPeriode(){
        $pos = $this->input->raw_input_stream;
        $data = $this->PeriodeModel->insert(json_decode($pos));
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

    public function updatePeriode(){
        $pos =json_decode($this->input->raw_input_stream);
        $data = $this->PeriodeModel->update($pos);
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

    public function deletePeriode(){
        $id = $_GET;
        $result = $this->PeriodeModel->delete($id);
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