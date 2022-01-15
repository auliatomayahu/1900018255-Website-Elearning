<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

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
        $data['title']  = 'Data Kelas';
        $data['kelas']   = $this->m_model->get_desc('tb_kelas');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/kelas');
		$this->load->view('admin/templates/footer');
    }
    
    public function insert()
    {
        $kelas           = $_POST['kelas'];

        $data = array(
            'kelas'          => $kelas
        );

        $this->m_model->insert($data, 'tb_kelas');
        $this->session->set_flashdata('pesan', 'Data kelas berhasil ditambahkan!');
        redirect('admin/kelas');
    }

    public function update($id)
    {
        $kelas           = $_POST['kelas'];

        $where = array('id' => $id);

        $data = array(
            'kelas'          => $kelas
        );

        $this->m_model->update($where, $data, 'tb_kelas');
        $this->session->set_flashdata('pesan', 'Data kelas berhasil diupdate!');
        redirect('admin/kelas');
    }

    public function delete($id)
    {
        $where = array('id' => $id);

        $this->m_model->delete($where, 'tb_kelas');
        $this->session->set_flashdata('pesan', 'Data kelas berhasil dihapus!');
        redirect('admin/kelas');
    }
    
}