<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Harga extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('harga_m');
        $this->load->model('user_m');
        $this->load->model('stokis_m');
        $this->load->library('form_validation');
		no();
        check_finance();
    }

	public function index()
	{
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->harga_m->get();
		$this->template->load('template','harga/harga_data', $data);
	}

    public function index_b()
	{
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->harga_m->getfull();
		$this->template->load('template','harga/harga_data_baru', $data);
	}
    public function jawa()
	{
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->harga_m->jawa();
		$this->template->load('template','harga/harga_data_baru_jawa', $data);
	}

    public function sumatera()
	{
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->harga_m->sumatera();
		$this->template->load('template','harga/harga_data_baru_sumatera', $data);
	}

    public function wita()
	{
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->harga_m->wita();
		$this->template->load('template','harga/harga_data_baru_wita', $data);
	}

    public function index_b1()
	{
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->harga_m->get3();
		$this->template->load('template','harga/harga_data_baru1', $data);
	}

	public function tambah(){
		$data['provinsi'] = $this->user_m->get_provinsi();
		$this->template->load('template', 'harga/harga_tambah',$data);
	
}
public function input() {
    $provinsi_id = $this->fungsi->user_login()->provinsi;
	
    $nama_item = $this->input->post('nama_item');
	$harga_jual_mitra = $this->input->post('harga_jual_mitra'); 
    $harga_jual = $this->input->post('harga_jual');

    $harga_data = array(
        'nama_item' => $nama_item,
		'harga_provinsi' => $provinsi_id,
        'harga_jual_mitra' => $harga_jual_mitra,
        'harga_jual' => $harga_jual
    );

        $this->harga_m->add_harga($harga_data);
    
    $this->session->set_flashdata('success', 'Data berhasil diinput.');
    redirect(base_url('harga/index_b'));
}
public function input_b() {
    $provinsi_id = $this->fungsi->user_login()->provinsi;
	
    $nama_produk = $this->input->post('nama_produk');
	$harga_mitra = $this->input->post('harga_mitra'); 
    $harga_beli = $this->input->post('harga_beli');
    $harga_stokis = $this->input->post('harga_stokis');
    $provinsi = $this->input->post('provinsi');

    $harga_data = array(
        'nama_produk' => $nama_produk,
		'provinsi' => $provinsi,
        'harga_mitra' => $harga_mitra,
        'harga_stokis' => $harga_stokis,
        'harga_beli' => $harga_beli
    );

        $this->harga_m->add_harga1($harga_data);
    
    $this->session->set_flashdata('success', 'Data berhasil diinput.');
    redirect(base_url('harga/index_b'));
}
public function ed($id)
{
         $hrg=$this->harga_m->detail($id);
   
		$provinsi = $this->user_m->get_provinsi($id);
	
		$data = array(
			'harga' => $hrg,
			'provinsi' => $provinsi
		);
	$this->template->load('template', 'harga/harga_edit',$data);
}

public function editin()
{
    $id_harga = $this->input->post('id_harga');
	$nama_produk = $this->input->post('nama_produk');
	$harga_mitra = $this->input->post('harga_mitra');
    $harga_beli = $this->input->post('harga_beli');
    $harga_stokis = $this->input->post('harga_stokis');
    $provinsi_form = $this->input->post('provinsi_form');
    $dataupdate = array (
		'nama_produk' => $nama_produk,
        'harga_mitra' => $harga_mitra,
        'harga_stokis' => $harga_stokis,
        'provinsi' => $provinsi_form,
        'harga_beli' => $harga_beli
    );
    $this->harga_m->edit_harga1($dataupdate,$id_harga);
	$this->session->set_flashdata('success', 'Data berhasil diubah.');
	redirect(base_url('harga/index_b'));
}


public function del($id)
{
    
    $hapus_harga = $this->harga_m->delete_harga1($id);   
    $hapus_item  = $this->harga_m->delete_item1($id);
    
    $this->session->set_flashdata('danger', 'Data berhasil dihapus.');
    redirect(base_url('harga/index_b'));
}


}