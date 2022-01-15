<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {

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
        $data['title']  = 'Data Tugas';
        $this->db->where('idGuru', $this->session->userdata('id'));
        $this->db->where('status', 'Aktif');
        $data['mapel']  = $this->m_model->get_desc('tb_mapel');
		
		$this->load->view('guru/templates/header', $data);
		$this->load->view('guru/templates/sidebar');
		$this->load->view('guru/tugas');
		$this->load->view('guru/templates/footer');
    }
    
    public function detail($idMapel)
    {
        $data['title']      = 'Detail Tugas';
        $data['idMapel']    = $idMapel;
        $where = array ('id' => $idMapel);
        $data['mapel']      = $this->m_model->get_where($where, 'tb_mapel');
		
		$this->load->view('guru/templates/header', $data);
		$this->load->view('guru/templates/sidebar');
		$this->load->view('guru/detailtugas');
		$this->load->view('guru/templates/footer');
    }

    public function insert($idMapel)
    {
        date_default_timezone_set('Asia/Jakarta');

        $judul          = $_POST['judul'];
        $keterangan     = $_POST['keterangan'];
        $youtube        = $_POST['youtube'];
        $waktu          = date('Y-m-d H:i:s', strtotime($_POST['tanggal'] . ' ' . $_POST['jam']));
        $file           = $_FILES['file'];

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

        if($file != '') {
            $data = array(
                'idMapel'       => $idMapel,
                'judul'         => $judul,
                'keterangan'    => $keterangan,
                'youtube'       => $youtube,
                'waktu'         => $waktu,
                'terdaftar'     => date('Y-m-d H:i:s'),
                'file'          => $file
            );
        } else {
            $data = array(
                'idMapel'       => $idMapel,
                'judul'         => $judul,
                'keterangan'    => $keterangan,
                'youtube'       => $youtube,
                'waktu'         => $waktu,
                'terdaftar'     => date('Y-m-d H:i:s')
            );
        }

        $this->m_model->insert($data, 'tb_tugas');
        $this->session->set_flashdata('pesan', 'Tugas berhasil ditambahkan!');
        redirect("guru/tugas/detail/$idMapel");
    }

    public function delete($idMateri, $idMapel)
    {
        $where = array('id' => $idMateri);

        $this->m_model->delete($where, 'tb_tugas');
        $this->session->set_flashdata('pesan', 'Tugas berhasil dihapus!');
        redirect("guru/tugas/detail/$idMapel");
    }

    public function penilaian($idTugas)
    {
        $data['title']      = 'Penilaian';
        $where = array('idTugas' => $idTugas);
        $data['siswa']      = $this->m_model->get_where($where, 'tb_upload_tugas');
		
		$this->load->view('guru/templates/header', $data);
		$this->load->view('guru/templates/sidebar');
		$this->load->view('guru/penilaian');
		$this->load->view('guru/templates/footer');
    }

    public function insert_penilaian($id, $idTugas)
    {
        $nilai      = $_POST['nilai'];
        $keterangan = $_POST['keterangan'];

        $where = array('id' => $id);

        $data = array('nilai' => $nilai, 'keterangan' => $keterangan);

        $this->m_model->update($where, $data, 'tb_upload_tugas');
        $this->session->set_flashdata('pesan', 'Berhasil dinilai!');
        redirect("guru/tugas/penilaian/$idTugas");
    }
}