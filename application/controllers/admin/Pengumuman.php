<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

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
        $data['title']  = 'Data Pengumuman';
        $data['pengumuman']   = $this->m_model->get_desc('tb_pengumuman');
        
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/sidebar');
        $this->load->view('admin/pengumuman');
        $this->load->view('admin/templates/footer');
    }
    
    public function insert()
    {
        date_default_timezone_set("Asia/Jakarta");
        $keterangan           = $_POST['keterangan'];
        $waktu = date('Y-m-d H:i:s');

        $data = array(
            'keterangan'   => $keterangan,
            'waktu'        => $waktu,
        );

        $this->m_model->insert($data, 'tb_pengumuman');
        $this->session->set_flashdata('pesan', 'Data pengumuman berhasil ditambahkan!');
        redirect('admin/pengumuman');
    }

    public function update($id)
    {
        $keterangan           = $_POST['keterangan'];

        $where = array('id' => $id);

        $data = array(
            'keterangan'   => $keterangan
        );

        $this->m_model->update($where, $data, 'tb_pengumuman');
        $this->session->set_flashdata('pesan', 'Data pengumuman berhasil diupdate!');
        redirect('admin/pengumuman');
    }

    public function delete($id)
    {
        $where = array('id' => $id);

        $this->m_model->delete($where, 'tb_pengumuman');
        $this->session->set_flashdata('pesan', 'Data pengumuman berhasil dihapus!');
        redirect('admin/pengumuman');
    }
    
}