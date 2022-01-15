<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$data['title'] = 'Dashboard';

		$data['pengumuman']   = $this->m_model->get_desc('tb_pengumuman');
		
		$this->load->view('guru/templates/header', $data);
		$this->load->view('guru/templates/sidebar');
		$this->load->view('guru/dashboard');
		$this->load->view('guru/templates/footer');
	}
}