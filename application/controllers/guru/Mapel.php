<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {

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
        $data['title']  = 'Data Mata Pelajaran';
        $this->db->where('idGuru', $this->session->userdata('id'));
        $this->db->where('status', 'Aktif');
        $data['mapel']  = $this->m_model->get_desc('tb_mapel');
		
		$this->load->view('guru/templates/header', $data);
		$this->load->view('guru/templates/sidebar');
		$this->load->view('guru/mapel');
		$this->load->view('guru/templates/footer');
    }
    
    public function detail($idMapel)
    {
        $data['title']      = 'Detail Mata Pelajaran';
        $data['idMapel']    = $idMapel;
        $where = array ('id' => $idMapel);
        $data['mapel']      = $this->m_model->get_where($where, 'tb_mapel');
		
		$this->load->view('guru/templates/header', $data);
		$this->load->view('guru/templates/sidebar');
		$this->load->view('guru/detailmapel');
		$this->load->view('guru/templates/footer');
    }

    public function insert($idMapel)
    {
        date_default_timezone_set('Asia/Jakarta');

        $judul          = $_POST['judul'];
        $keterangan     = $_POST['keterangan'];
        $youtube        = $_POST['youtube'];
        $file           = $_FILES['file'];

        if($file != ''){
            $config['upload_path'] = './assets/materi/';
            $config['allowed_types'] = '*';
            $config['file_name'] = 'Materi-' . time();

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('file')){
                $file = '';
            } else {
                $file = $this->upload->data('file_name');
            }
        }

        if($file != '') {
            $data = array(
                'idMapel'       => $idMapel,
                'judul'         => $judul,
                'keterangan'    => $keterangan,
                'youtube'       => $youtube,
                'terdaftar'     => date('Y-m-d H:i:s'),
                'file'          => $file
            );
        } else {
            $data = array(
                'idMapel'       => $idMapel,
                'judul'         => $judul,
                'keterangan'    => $keterangan,
                'youtube'       => $youtube,
                'terdaftar'     => date('Y-m-d H:i:s')
            );
        }

        $this->m_model->insert($data, 'tb_materi');
        $this->session->set_flashdata('pesan', 'Materi berhasil ditambahkan!');
        redirect("guru/mapel/detail/$idMapel");
    }

    public function delete($idMateri, $idMapel)
    {
        $where = array('id' => $idMateri);

        $this->m_model->delete($where, 'tb_materi');
        $this->session->set_flashdata('pesan', 'Materi berhasil dihapus!');
        redirect("guru/mapel/detail/$idMapel");
    }
}