<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {

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
        $data['title']  = 'Data Mata Pelajaran';
        $this->db->where('idkelas', $this->session->userdata('idKelas'));
        $this->db->where('status', 'Aktif');
        $data['mapel']  = $this->m_model->get_desc('tb_mapel');
		
		$this->load->view('siswa/templates/header', $data);
		$this->load->view('siswa/templates/sidebar');
		$this->load->view('siswa/mapel');
		$this->load->view('siswa/templates/footer');
    }
    
    public function detail($idMapel)
    {
        $data['title']      = 'Detail Mata Pelajaran';
        $data['idMapel']    = $idMapel;
        $where = array ('id' => $idMapel);
        $data['mapel']      = $this->m_model->get_where($where, 'tb_mapel');
		
		$this->load->view('siswa/templates/header', $data);
		$this->load->view('siswa/templates/sidebar');
		$this->load->view('siswa/detailmapel');
		$this->load->view('siswa/templates/footer');
    }
}