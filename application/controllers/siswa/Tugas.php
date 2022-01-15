<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {

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
        $data['title']  = 'Data Tugas';
        $this->db->where('idkelas', $this->session->userdata('idKelas'));
        $this->db->where('status', 'Aktif');
        $data['mapel']  = $this->m_model->get_desc('tb_mapel');
		
		$this->load->view('siswa/templates/header', $data);
		$this->load->view('siswa/templates/sidebar');
		$this->load->view('siswa/tugas');
		$this->load->view('siswa/templates/footer');
    }
    
    public function detail($idMapel)
    {
        $data['title']      = 'Detail Tugas';
        $data['idMapel']    = $idMapel;
        $where = array ('id' => $idMapel);
        $data['mapel']      = $this->m_model->get_where($where, 'tb_mapel');
		
		$this->load->view('siswa/templates/header', $data);
		$this->load->view('siswa/templates/sidebar');
		$this->load->view('siswa/detailtugas');
		$this->load->view('siswa/templates/footer');
    }

    public function upload_tugas($idTugas, $idMapel)
    {
        date_default_timezone_set('Asia/Jakarta');

        $file   = $_FILES['file'];

        if($file != ''){
            $config['upload_path'] = './assets/tugas/';
            $config['allowed_types'] = '*';
            $config['file_name'] = 'Tugas-' . time();

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('file')){
                $file = '';
            } else {
                $file = $this->upload->data('file_name');
            }
        }

        $data = array(
            'file'      => $file,
            'idMapel'   => $idMapel,
            'idTugas'   => $idTugas,
            'idSiswa'   => $this->session->userdata('id'),
            'tanggal'   => date('Y-m-d H:i:s')
        );

        $this->m_model->insert($data, 'tb_upload_tugas');
        $this->session->set_flashdata('pesan', 'Tugas berhasil diupload!');
        redirect("siswa/tugas/detail/$idMapel");
    }

    public function update_tugas($id, $idMapel)
    {
        date_default_timezone_set('Asia/Jakarta');

        $file   = $_FILES['file'];

        $where = array('id' => $id);

        if($file != ''){
            $config['upload_path'] = './assets/tugas/';
            $config['allowed_types'] = '*';
            $config['file_name'] = 'Tugas-' . time();

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('file')){
                $file = '';
            } else {
                $file = $this->upload->data('file_name');
            }
        }

        $data = array(
            'file'      => $file,
            'tanggal'   => date('Y-m-d H:i:s')
        );

        $this->m_model->update($where, $data, 'tb_upload_tugas');
        $this->session->set_flashdata('pesan', 'Tugas berhasil diupdate!');
        redirect("siswa/tugas/detail/$idMapel");
    }
}