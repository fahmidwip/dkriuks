<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('keranjang_model');
        $this->load->library('form_validation');
		no();
    }

	public function index($id)
	{
		$user_id = $this->fungsi->user_login()->provinsi;
		$data=$this->keranjang_m->detail($id);
		$data['row'] = $this->keranjang_model->get();
		$this->template->load('template','pesanan/pesanan_data', $data);
	}

	
}