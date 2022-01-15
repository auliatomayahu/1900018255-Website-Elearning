<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

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
        $data['title']  = 'Data Pengumuman';
        $data['pengumuman']   = $this->m_model->get_desc('tb_pengumuman');
        
        $this->load->view('siswa/templates/header', $data);
        $this->load->view('siswa/templates/sidebar');
        $this->load->view('siswa/pengumuman');
        $this->load->view('siswa/templates/footer');
    }
    
}