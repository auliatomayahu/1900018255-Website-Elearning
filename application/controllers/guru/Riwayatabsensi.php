<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayatabsensi extends CI_Controller {

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
        $data['title']  = 'Riwayat Absensi';
        $data['data_absensi']   = $this->m_model->get_desc('tb_absensi')->result();
        
        $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/templates/sidebar');
        $this->load->view('guru/riwayatabsensi');
        $this->load->view('guru/templates/footer');
    }

    public function update($id)
    {
        $statusAbsensi = $this->input->post('statusAbsensi');

        $data = array('statusAbsensi' => $statusAbsensi );
        $where = array('id' => $id );

        $this->m_model->update($where, $data, 'tb_absensi');
        $this->session->set_flashdata('pesan', 'Status Absensi berhasil diubah!');
        redirect('guru/riwayatabsensi');
    }

    public function delete($id)
    {
        $where = array('id' => $id );

        $this->m_model->delete($where, 'tb_absensi');
        $this->session->set_flashdata('pesan', 'Status Absensi berhasil dihapus!');
        redirect('guru/riwayatabsensi');
    }
}