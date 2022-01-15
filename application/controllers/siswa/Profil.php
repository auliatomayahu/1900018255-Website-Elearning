<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

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
        $data['title']      = 'Profil';
		
		$this->load->view('siswa/templates/header', $data);
		$this->load->view('siswa/templates/sidebar');
		$this->load->view('siswa/profil');
		$this->load->view('siswa/templates/footer');
    }
    
    public function update($id)
    {
        $nama           = $_POST['nama'];
        $jenisKelamin   = $_POST['jenisKelamin'];
        $tptLahir       = $_POST['tptLahir'];
        $tglLahir       = $_POST['tglLahir'];
        $telp           = $_POST['telp'];
        $alamat         = $_POST['alamat'];
        $password       = $_POST['password'];
        $skin           = $_POST['skin'];
        $foto           = $_FILES['foto'];

        if($foto != ''){
            $config['upload_path'] = './assets/profil/';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['file_name'] = 'Profil-' . time();
            $config['max_size'] = 5120;

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('foto')){
                $foto = '';
            } else {
                $foto = $this->upload->data('file_name');
            }
        }

        $where = array('id' => $id);

        if($password == '' AND $foto == '') {
            $data = array(
                'nama'          => $nama,
                'jenisKelamin'  => $jenisKelamin,
                'tptLahir'      => $tptLahir,
                'tglLahir'      => $tglLahir,
                'telp'          => $telp,
                'skin'          => $skin,
                'alamat'        => $alamat,
            );
        } elseif ($password != '' AND $foto == '') {
            $options = [
                'cost' => 10,
            ];
    
            $enkripPassword = password_hash($password, PASSWORD_BCRYPT, $options);

            $data = array(
                'nama'          => $nama,
                'jenisKelamin'  => $jenisKelamin,
                'tptLahir'      => $tptLahir,
                'tglLahir'      => $tglLahir,
                'telp'          => $telp,
                'password'      => $enkripPassword,
                'skin'          => $skin,
                'alamat'        => $alamat,
            );
        } elseif ($password == '' AND $foto != '') {
            $data = array(
                'nama'          => $nama,
                'jenisKelamin'  => $jenisKelamin,
                'tptLahir'      => $tptLahir,
                'tglLahir'      => $tglLahir,
                'telp'          => $telp,
                'skin'          => $skin,
                'alamat'        => $alamat,
                'foto'          => $foto,
            );
        }
        
        $this->m_model->update($where, $data, 'tb_user');
        $this->session->set_userdata($data);
        $this->session->set_flashdata('pesan', 'Profil berhasil diubah!');
        redirect('siswa/profil');
    }
}