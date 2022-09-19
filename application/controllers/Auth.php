<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // call once use anywhere
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    // go to login pages 
    public function login()
    {
        
        $data = [
            'title' => 'Login'
        ];
        $this->load->view('template/auth/header.php', $data);
        $this->load->view('login');
        $this->load->view('template/auth/footer.php');
    }

    // go to register pages
    public function register()
    {
        
        $data = [
            'title' => 'Register'
        ];
        $this->load->view('template/auth/header.php', $data);
        $this->load->view('register.php');
        $this->load->view('template/auth/footer.php');
    }

    // check register user
    public function check_register()
    {
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[15]|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
            
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('input', $this->input->post());
            redirect('auth/register');
        } else {
            // data untuk tabel akun
            $username = $this->input->post('username');
            $email_user = $this->input->post('email_user');
//            $level = '1';
            $password = $this->input->post('password');
            $repassword = $this->input->post('repassword');
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $nama_depan = $this->input->post('nama_depan');
            $nama_belakang = $this->input->post('nama_belakang');
            $is_active = 0;
            $activation_key = $activation_key = bin2hex(random_bytes(32));
            
            $data = [
                'email_user' => $email_user,
                'username' => $username,
//                'id_level' => $level,
                'password' => $pass,
                'nama_depan' => $nama_depan,
                'nama_belakang' => $nama_belakang,
                'is_active' => $is_active,
                'activation_key' => $activation_key,
            ];
            
            //cek retype password apakah sama dengan password
            if ($password == $repassword) {
                $insert = $this->auth_model->register("user", $data);
                $this->_sendEmail($email_user,$activation_key);
                if ($insert) {
                    echo '<script>alert("Sukses! Anda berhasil melakukan register. Silahkan verifikasi email Anda.");window.location.href="' . base_url('index.php/auth/login') . '";</script>';
                }
            } else {
                $this->session->set_flashdata('errors', 'Retype password salah');
                redirect('auth/register');
            }
            
        }
    }

    // check login
    public function check_login()
    {
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_flashdata('input', $this->input->post());
            redirect('/auth/login'); // LOGIN

        } else {
            $username = htmlspecialchars($this->input->post('username'));
            $pass = htmlspecialchars($this->input->post('password'));
            $repass = htmlspecialchars($this->input->post('repassword'));

            // CEK KE DATABASE BERDASARKAN EMAIL
            $cek_login = $this->auth_model->cek_login($username);

                if ($cek_login == FALSE) {
                    echo '<script>alert("Username yang Anda masukan salah.");window.location.href="' . base_url('/auth/login') . '";</script>';
                } else {

                    if (password_verify($pass, $cek_login->password)) {
                        if ($cek_login->is_active == 1) {
                            // if the username and password is a match
                            $this->session->set_userdata('id_user', $cek_login->id_user);
                            $this->session->set_userdata('username', $cek_login->username);
                            $this->session->set_userdata('nama_depan', $cek_login->nama_depan);
                            $this->session->set_userdata('nama_belakang', $cek_login->nama_belakang);
        //                    $this->session->set_userdata('level', $cek_login->id_level);
        //                    $this->session->set_userdata('id_bidang', $this->auth_model->cek_bidang($this->session->userdata('username')));

        //                    if ($this->session->userdata('level') == '1') {
        //                        redirect('/pelanggan');
        //                    } else if ($this->session->userdata('level') == '2') {
        //                        redirect('/operator');
        //                    } else if ($this->session->userdata('level') == '3') {
        //                        redirect('/direktur');
        //                    } else if ($this->session->userdata('level') >= '4') {
        //                        redirect('/bidang');
        //                    }
                            redirect('/home');
                        } else {
                            echo '<script>alert("Email belum aktif, silahkan cek email dan lakukan verifikasi");window.location.href="' . base_url('auth/login') . '";</script>';
                        }

                    } else {
                        echo '<script>alert("Username atau Password yang Anda masukan salah.");window.location.href="' . base_url('auth/login') . '";</script>';
                    }
                }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }

    private function _sendEmail($email_user,$activation_key){
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'kerjapraktek103@gmail.com',
            'smtp_pass' => 'kptelkomsel',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];
        
        $this->load->library('email', $config);
        
        $this->email->from('kerjapraktek103@gmail.com','Kerja Praktek Telkomsel Regional Jawa Timur');
        $this->email->to($email_user);
        $this->email->subject('Verifikasi Email');
        
        $data = 'Please, click this site to verify your email <br><br><a href="'.site_url() . 'auth/checkKey/' . $activation_key.'">Activate</a>';
        
        $this->email->message($data);
        
        $this->email->send();
        
    }
    
    public function checkKey($activation_key) {
      $key = $this->auth_model->checkKey($activation_key);
     
        if ($key){
            //ganti status is active tadi jadi 1
            $data = [
                'is_active' => 1,
                'activation_key' => $activation_key
            ];
            $this->auth_model->updateActiveUser($data);
            redirect('auth/login');
        }
        
    }
}
