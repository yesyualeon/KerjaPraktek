<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function register($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function cek_login($username)
    {
        $hasil = $this->db->where('username', $username)->limit(1)->get('user');
        if ($hasil->num_rows() > 0) {
            return $hasil->row();
        } else {
            return array();
        }
    }

    public function cek_bidang($user)
    {
        $this->db->select('*');
		$this->db->from('level');
        $this->db->join('user', 'user.id_level = level.id_level');
		$this->db->join('bidang', 'bidang.id_bidang = level.id_bidang');
        $this->db->where('user.username', $user);
        return $this->db->get()->result_array()[0]['id_bidang'];
    }
    
    
    public function checkKey($activation_key){
        $this->db->select('*');
		$this->db->from('user');
        $this->db->where('activation_key', $activation_key);
        return $this->db->get()->result_array();
    }
    
    public function updateActiveUser($data){
//        return $this->db->where('user.activation_key',$data['activation_key'])->update('user.is_active', $data['is_active']);
        $this->db->select('*');
        $this->db->from('user');

        $new = array(
            'is_active' => $data['is_active']
        );
        $this->db->where('activation_key', $data['activation_key'])->update('user', $new);
    }
}
