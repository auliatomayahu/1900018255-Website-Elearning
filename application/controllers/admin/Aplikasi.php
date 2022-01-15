<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aplikasi extends CI_Controller {

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
        $data['title']      = 'Tentang Aplikasi';
        $data['aplikasi']   = $this->m_model->get_desc('tb_aplikasi');
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/aplikasi');
		$this->load->view('admin/templates/footer');
    }
    
    public function update($id)
    {
        $nama   = $_POST['nama'];
        $email  = $_POST['email'];
        $telp   = $_POST['telp'];
        $alamat = $_POST['alamat'];
        $logo   = $_FILES['logo'];    

        if($logo != ''){
            $config['upload_path'] = './assets/logo/';
            $config['allowed_types'] = 'png|jpeg|jpg';
            $config['file_name'] = 'Logo-' . time();
            $config['max_size'] = 5120;

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload('logo')){
                $logo = '';
            } else {
                $logo = $this->upload->data('file_name');
            }
        }

        $where = array('id' => $id);

        if($logo == '') {
            $data = array(
                'nama'      => $nama,
                'email'     => $email,
                'telp'      => $telp,
                'alamat'    => $alamat,
            );
        } else {
            $data = array(
                'nama'      => $nama,
                'logo'      => $logo,
                'email'     => $email,
                'telp'      => $telp,
                'alamat'    => $alamat,
            );
        }
        
        $this->m_model->update($where, $data, 'tb_aplikasi');
        $this->session->set_flashdata('pesan', 'Pengaturan aplikasi berhasil diubah!');
        redirect('admin/aplikasi');
    }
}