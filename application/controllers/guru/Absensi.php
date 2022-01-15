<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

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
        $data['title']      = 'Absensi';
        $data['mapel']      = $this->db->query('SELECT DISTINCT idKelas FROM tb_mapel WHERE idGuru="'.$this->session->userdata('id').'" ');
        
        $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/templates/sidebar');
        $this->load->view('guru/absensi');
        $this->load->view('guru/templates/footer');
    }

    public function absensiswa()
    {
        $data['title']  = 'Absen Siswa';

        $idKelas = $this->input->post('idKelas');

        $where = array('idKelas' => $idKelas );
        $data['data_siswa']   = $this->m_model->get_where($where, 'tb_user');

        $this->db->where('idKelas', $idKelas);
        $this->db->where('idGuru', $this->session->userdata('id'));
        $data['mapel']  = $this->m_model->get_desc('tb_mapel');
        
        $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/templates/sidebar');
        $this->load->view('guru/absensiswa');
        $this->load->view('guru/templates/footer');
    }
    
    public function insert()
    {
        $result = array();
        foreach ($_POST['idSiswa'] as $key => $val) {
            $result[] = array(
                'idSiswa'       => $_POST['idSiswa'][$key],
                'idMapel'       => $_POST['idMapel'],
                'statusAbsensi' => $_POST['statusAbsensi'][$key],
                'tgl_absen'     => $_POST['tanggal'],
            );
        }
    
        $this->db->insert_batch('tb_absensi', $result);
        $this->session->set_flashdata('pesan', 'Berhasil melakukan absensi');
        redirect('guru/riwayatabsensi');
    }
}