<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('level')){
			$this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
			redirect('home');
		} elseif($this->session->userdata('level') != 'Guru') {
            $this->session->set_flashdata('pesan', 'Anda bukan guru!');
			redirect('home');
        }
	}

	public function index()
	{
        $data['title']  = 'Data Siswa';
        $this->db->where('level', 'Siswa');
        $data['siswa']  = $this->m_model->get_desc('tb_user');
        $data['kelas']  = $this->m_model->get_desc('tb_kelas');
		
		$this->load->view('guru/templates/header', $data);
		$this->load->view('guru/templates/sidebar');
		$this->load->view('guru/siswa');
		$this->load->view('guru/templates/footer');
    }
}