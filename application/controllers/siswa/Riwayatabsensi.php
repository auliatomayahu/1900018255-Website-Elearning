<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayatabsensi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('level')){
            $this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
            redirect('home');
        } elseif($this->session->userdata('level') != 'Siswa') {
            $this->session->set_flashdata('pesan', 'Anda bukan siswa!');
            redirect('home');
        }
    }

    public function index()
    {
        $data['title']  = 'Riwayat Absensi';

        $where = array('idSiswa' => $this->session->userdata('id'));
        $data['data_absensi']   = $this->m_model->get_where($where, 'tb_absensi')->result();
        
        $this->load->view('siswa/templates/header', $data);
        $this->load->view('siswa/templates/sidebar');
        $this->load->view('siswa/riwayatabsensi');
        $this->load->view('siswa/templates/footer');
    }
}