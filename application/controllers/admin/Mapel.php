<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('level')){
			$this->session->set_flashdata('pesan', 'Anda harus masuk terlebih dahulu!');
			redirect('home');
		} elseif($this->session->userdata('level') != 'Administrator') {
            $this->session->set_flashdata('pesan', 'Anda bukan administrator!');
			redirect('home');
        }
	}

	public function index()
	{
        $data['title']  = 'Data Mata Pelajaran';
        $data['mapel']  = $this->m_model->get_desc('tb_mapel');
        $data['kelas']  = $this->m_model->get_desc('tb_kelas');
        $this->db->where('level', 'Guru');
        $data['guru']   = $this->m_model->get_desc('tb_user');
        $data['daftarmapel']      = $this->m_model->get_desc('tb_daftarmapel');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/mapel');
		$this->load->view('admin/templates/footer');
    }

    public function daftar()
    {
        $data['title']      = 'Daftar Mata Pelajaran';
        $data['subtitle']   = 'Daftar mata pelajaran akan ditampilkan disini';

        $data['mapel']      = $this->m_model->get_desc('tb_daftarmapel');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/daftarmapel');
		$this->load->view('admin/templates/footer');
    }
    
    public function insert()
    {
        $idMapel    = $_POST['idMapel'];
        $idGuru     = $_POST['idGuru'];
        $idKelas    = $_POST['idKelas'];
        $link       = $_POST['link'];
        $status     = $_POST['status'];
        $hari            = $_POST['hari'];
        $jam_mulai       = $_POST['jam_mulai'];
        $jam_selesai     = $_POST['jam_selesai'];

        $this->db->where('id', $idMapel);
        foreach ($this->db->get('tb_daftarmapel')->result() as $dMpl) {
            
        }

        $data = array(
            'kode'      => $dMpl->kode,
            'mapel'     => $dMpl->mapel,
            'idGuru'    => $idGuru,
            'idKelas'   => $idKelas,
            'link'      => $link,
            'status'    => $status,
            'hari'          => $hari,
            'jam_mulai'     => $jam_mulai,
            'jam_selesai'   => $jam_selesai,
        );

        $this->m_model->insert($data, 'tb_mapel');
        $this->session->set_flashdata('pesan', 'Data mata pelajaran berhasil ditambahkan!');
        redirect('admin/mapel');
    }

    public function insertmapel()
    {
        $kode   = $_POST['kode'];
        $mapel  = $_POST['mapel'];

        $data = array(
            'kode'  => $kode,
            'mapel' => $mapel,
        );

        $this->m_model->insert($data, 'tb_daftarmapel');
        $this->session->set_flashdata('pesan', 'Mata Pelajaran berhasil ditambahkan!');
        redirect('admin/mapel/daftar');
    }

    public function updatemapel($id)
    {
        $kode   = $_POST['kode'];
        $mapel  = $_POST['mapel'];

        $where = array('id' => $id);

        $data = array(
            'kode'  => $kode,
            'mapel' => $mapel,
        );

        $this->m_model->update($where, $data, 'tb_daftarmapel');
        $this->session->set_flashdata('pesan', 'Mata Pelajaran berhasil diupdate!');
        redirect('admin/mapel/daftar');
    }

    public function deletedaftar($id)
    {
        $where = array('id' => $id);

        $this->m_model->delete($where, 'tb_daftarmapel');
        $this->session->set_flashdata('pesan', 'Mata pelajaran berhasil dihapus!');
        redirect('admin/mapel/daftar');
    }

    public function delete($id)
    {
        $where = array('id' => $id);

        $this->m_model->delete($where, 'tb_mapel');
        $this->session->set_flashdata('pesan', 'Data mata pelajaran berhasil dihapus!');
        redirect('admin/mapel');
    }

    public function update($id)
    {
        $link   = $_POST['link'];
        $status = $_POST['status'];

        $where = array('id' => $id);

        $data = array(
            'link'      => $link,
            'status'    => $status
        );

        $this->m_model->update($where, $data, 'tb_mapel');
        $this->session->set_flashdata('pesan', 'Status mata pelajaran berhasil diupdate!');
        redirect('admin/mapel');
    }

    public function detail($idMapel)
    {
        $data['title']      = 'Detail Mata Pelajaran';
        $data['idMapel']    = $idMapel;
        $where = array ('id' => $idMapel);
        $data['mapel']      = $this->m_model->get_where($where, 'tb_mapel');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/detailmapel');
		$this->load->view('admin/templates/footer');
    }
}