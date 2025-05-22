<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kemitraan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('harga_m');
        $this->load->model('user_m');
        $this->load->model('kemitraan_m');
        $this->load->library('form_validation');
		no();
        
    }

    public function index()
	{
		$data['user'] = $this->kemitraan_m->get()->result(); // untuk banyak data

		$this->template->load('template','kemitraan/kemitraan_data', $data);
	}

	public function index1()
	{
		$data['user'] = $this->kemitraan_m->get()->result(); // untuk banyak data

		$this->template->load('template','kemitraan/kemitraan_data', $data);
	}

	public function wita()
	{
		$data['user_wita'] = $this->kemitraan_m->wita()->result(); // untuk banyak data

		$this->template->load('template','kemitraan/kemitraan_data_wita', $data);
	}

public function sumatera()
	{
		$data['user_sumatera'] = $this->kemitraan_m->sumatera()->result(); // untuk banyak data

		$this->template->load('template','kemitraan/kemitraan_data_sumatera', $data);
	}
public function jawa()
	{
		$data['user_jawa'] = $this->kemitraan_m->jawa()->result(); // untuk banyak data

		$this->template->load('template','kemitraan/kemitraan_data_jawa', $data);
	}


    public function up($id)
    {
        $user=$this->kemitraan_m->detail($id);
        $data = array('user' => $user);
        $this->template->load('template', 'kemitraan/kemitraan_edit',$data);
    }
    public function editin()
	{
		$user_id = $this->input->post('user_id');
		
		$nama_form = $this->input->post('nama_form');
		$alamat = $this->input->post('alamat_form');
		$type = $this->input->post('type_form');
		$aktif = $this->input->post('status_form');
	
		
		$dataupdate = array(
			'name' => $nama_form,
			'alamat' => $alamat,
			'type' => $type,
			'aktif' => $aktif
		);
	
		$password_form = $this->input->post('password_form');
		if (!empty($password_form)) {
			$dataupdate['password'] = sha1($password_form);
		}
	
		
		$this->user_m->edits($dataupdate, $user_id);
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(base_url('kemitraan'));
	}
	
}
