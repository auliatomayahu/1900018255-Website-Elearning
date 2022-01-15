<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

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
		$data['title'] = 'Jadwal';
		$data['data_kelas'] = $this->m_model->get_desc("tb_kelas")->result();
		$data['data_jadwal'] = $this->m_model->get_desc("tb_jadwal")->result();
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/jadwal');
		$this->load->view('admin/templates/footer');
	}
    
    public function insert()
    {
        $idKelas         = $_POST['idKelas'];
        $hari            = $_POST['hari'];
        $jam_mulai       = $_POST['jam_mulai'];
        $jam_selesai     = $_POST['jam_selesai'];

        $data = array(
            'idKelas'       => $idKelas,
            'hari'          => $hari,
            'jam_mulai'     => $jam_mulai,
            'jam_selesai'   => $jam_selesai,
        );

        $this->m_model->insert($data, 'tb_jadwal');
        $this->session->set_flashdata('pesan', 'Data jadwal berhasil ditambahkan!');
        redirect('admin/jadwal');
    }

    public function update($id)
    {

        $where = array('id' => $id);

        $idKelas         = $_POST['idKelas'];
        $hari            = $_POST['hari'];
        $jam_mulai       = $_POST['jam_mulai'];
        $jam_selesai     = $_POST['jam_selesai'];

        $data = array(
            'idKelas'       => $idKelas,
            'hari'          => $hari,
            'jam_mulai'     => $jam_mulai,
            'jam_selesai'   => $jam_selesai,
        );

        $this->m_model->update($where, $data, 'tb_jadwal');
        $this->session->set_flashdata('pesan', 'Data jadwal berhasil diupdate!');
        redirect('admin/jadwal');
    }

    public function delete($id)
    {
        $where = array('id' => $id);

        $this->m_model->delete($where, 'tb_jadwal');
        $this->session->set_flashdata('pesan', 'Data jadwal berhasil dihapus!');
        redirect('admin/jadwal');
    }
}