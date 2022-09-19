<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
class Home extends CI_Controller {

    // call once use anywhere
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
			redirect('auth/login');
		}
        $this->load->model('data_model');
    }

	public function index()
	{        
        // var_dump($data['data'][0]);
		$this->load->view('template/header');
        $this->load->view('home');
        $this->load->view('template/footer');
	}


    public function getData(){
        $data = $this->data_model->get_data();
        echo json_encode($data);
    }

    public function getKategori($kategori){
        $data = $this->data_model->get_kategori($kategori);
        // var_dump($data);
        echo json_encode($data);
    }

    public function getKelurahan(){
        $data = $this->data_model->get_kelurahan();
        echo json_encode($data);
    }

    public function getDetails($kategori, $detail){
        $detail = str_replace("-"," ",$detail);
        $data = $this->data_model->get_detail($kategori, $detail);
        // var_dump($data);
        echo json_encode($data);
    }
    
    public function getDetailsEfektivitas($kategori, $detail, $efektivitas){
        $detail = str_replace("-"," ",$detail);
        // jadikan ke bentuk array
        $arr = explode(' ',trim($detail));
        if(isset($arr[1])){
            if(end($arr) == 'kabupaten' || end($arr) == 'kecamatan'){
                // buang array terakhir
                array_pop($arr);
                // digabungin lagi jadi string
                $kabupaten = implode(" ",$arr);
                $data = $this->data_model->get_detailefektivitas($kategori, $kabupaten, $efektivitas);
                // foreach ($data as $data){
                //     echo $data;
                // }
            }
            else {
                $kelurahan = $arr[0];
                $kecamatan = $arr[1];
                // print_r ubah bentuk ke string
                $kelurahan = print_r($kelurahan, true);
                $kecamatan = print_r($kecamatan, true);
                $data = $this->data_model->get_detailEfektivitasKelurahan($kelurahan, $kecamatan, $efektivitas);
                // foreach ($data as $data){
                //     echo $data['kabupaten'];
                // }
            }
        } else {
            $data = $this->data_model->get_detailefektivitas($kategori, $detail, $efektivitas);
            // foreach ($data as $data){
            //     echo $data;
            // }
        }
        // var_dump($data);
        echo json_encode($data);
    }
    
    public function getDetailsAllEfektivitas($efektivitas){
        $data = $this->data_model->get_detailallefektivitas($efektivitas);
        echo json_encode($data);
    }

    public function getNamaKelurahan($kelurahan, $kecamatan)
    {
        $data = $this->data_model->getNamaKelurahan($kelurahan, $kecamatan);
        // $data = $kecamatan.' ';
        // var_dump($data);
        echo json_encode($data);
    }
}
