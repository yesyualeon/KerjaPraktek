<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_model extends CI_Model{
    public function get_data(){
        $this->db->select('*');
        $this->db->from('mytable');
        $this->db->order_by("kelurahan", "asc");
        return $this->db->get()->result_array();
    }

    public function get_kategori($kategori){
        $data = $kategori." as data";   //ubah value jadi "data"
        $this->db->select($data);
        $this->db->from('mytable');
        $this->db->group_by($kategori);
        return $this->db->get()->result();
    }

    public function get_detail($kategori, $detail){
        $this->db->select('*');
        $this->db->from('mytable');
        $this->db->where($kategori, $detail);
        return $this->db->get()->result();
    }
    
    public function get_detailefektivitas($kategori, $detail, $efektivitas){
        $this->db->select('*');
        $this->db->from('mytable');
        // $where = "$kategori = '$detail' AND efektifitas = $efektivitas";
        $this->db->where($kategori, $detail);
        $this->db->where('efektivitas', $efektivitas);
        return $this->db->get()->result();
    }
    
    public function get_detailallefektivitas($efektivitas){
        $this->db->select('*');
        $this->db->from('mytable');
        $this->db->where('efektivitas', $efektivitas);
        return $this->db->get()->result();
    }

    public function get_kelurahan(){
        $this->db->select('*');
        $this->db->from('mytable');
        return $this->db->get()->result();
    }

    public function getNamaKelurahan($kelurahan, $kecamatan){
        $this->db->select('*');
        $this->db->from('mytable');
        $this->db->where('kecamatan', $kecamatan);
        $this->db->where('kelurahan', $kelurahan);
        $this->db->order_by("kelurahan", "asc");
        return $this->db->get()->result_array();
    }

    public function get_detailEfektivitasKelurahan($kelurahan, $kecamatan, $efektivitas){
        $this->db->select('*');
        $this->db->from('mytable');
        // $where = "$kategori = '$detail' AND efektifitas = $efektivitas";
        $this->db->where('kelurahan', $kelurahan);
        $this->db->where('kecamatan', $kecamatan);
        $this->db->where('efektivitas', $efektivitas);
        return $this->db->get()->result_array();
    }
}

