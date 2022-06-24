<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Login_model');
        $this->load->model('User_model');
        $this->load->model('Penilaian_model');
        $this->load->model('Perhitungan_model');
        $this->load->model('Sub_Kriteria_model');
        $this->load->model('Pesan_model');
    }
    public function index()
    {
        if ($this->Login_model->logged_id()) {
            redirect('Login/home');
        } else {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $nilai = $this->input->post('nilai');

            $data = [
                'nama' => $nama,
                'email' => $email,
                'nilai' => $nilai,
                'kriteria' => $this->Penilaian_model->get_kriteria(),
                'alternatif' => $this->Penilaian_model->get_alternatif(),
            ];
            $this->load->view('home', $data);
        }
    }

    public function detail($id_alternatif)
    {
        $detail = $this->Perhitungan_model->get_detail($id_alternatif);
        $data = [
            'page' => "Hasil",
            'detail' => $detail,
            'hasil' => $this->Perhitungan_model->get_hasil(),
            'kriteria' => $this->Perhitungan_model->get_kriteria()
        ];

        $this->load->view('detail', $data);
    }

    public function login()
    {
        if ($this->Login_model->logged_id()) {
            redirect('Login/home');
        } else {
            $this->load->view('login');
        }
    }

    public function login_proses()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $passwordx = md5($password);
        $set = $this->Login_model->login($username, $passwordx);
        if ($set) {
            $log = [
                'id_user' => $set->id_user,
                'username' => $set->username,
                'id_user_level' => $set->id_user_level,
                'status' => 'Logged'
            ];
            $this->session->set_userdata($log);
            redirect('Login/home');
        } else {
            $this->session->set_flashdata('message', 'Username atau Password Salah');
            redirect('login/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function home()
    {
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $nilai = $this->input->post('nilai');

        $data = [
            'nama' => $nama,
            'email' => $email,
            'nilai' => $nilai,
            'page' => "Dashboard",
            'list' => $this->Penilaian_model->tampil(),
            'kriteria' => $this->Penilaian_model->get_kriteria(),
            'alternatif' => $this->Penilaian_model->get_alternatif(),
            'sub_kriteria' => $this->Penilaian_model->get_sub_kriteria(),
            'perhitungan' => $this->Penilaian_model->tampil()
        ];
        $this->load->view('admin/index', $data);
    }
}

/* End of file Login.php */
