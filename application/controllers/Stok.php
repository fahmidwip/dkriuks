<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('harga_m');
        $this->load->model('user_m');
        $this->load->library('form_validation');
		no();
        
    }

	public function index()
	{
        check_logistik();
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->harga_m->get3();
		$this->template->load('template','stok/stok_data1', $data);
	}

    public function stokis()
	{
        check_stokis();
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->harga_m->get3();
		$this->template->load('template','stok/stok_data2', $data);
	}

    public function index_b()
	{
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->harga_m->get1();
		$this->template->load('template','harga/harga_data_baru', $data);
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
	
    $nama_item = $this->input->post('nama_item');
	$harga_jual_mitra = $this->input->post('harga_jual_mitra'); 
    $harga_jual = $this->input->post('harga_jual');
    $provinsi = $this->input->post('provinsi');

    $harga_data = array(
        'nama_item' => $nama_item,
		'harga_provinsi' => $provinsi,
        'harga_jual_mitra' => $harga_jual_mitra,
        'harga_jual' => $harga_jual
    );

        $this->harga_m->add_harga($harga_data);
    
    $this->session->set_flashdata('success', 'Data berhasil diinput.');
    redirect(base_url('harga/index_b'));
}
public function up($id)
{
    $hrg=$this->harga_m->detail1($id);
	$data = array('harga' => $hrg);
	$this->template->load('template', 'stok/stok_edit',$data);
}

public function up1($id)
{
    $hrg=$this->harga_m->detail1($id);
	$data = array('harga' => $hrg);
	$this->template->load('template', 'stok/stok_edit1',$data);
}

public function editin()
{
    $id_harga = $this->input->post('id_harga');
    $stok_baru = (int)$this->input->post('update_stok');
    $stok_lama = $this->harga_m->get_stok_by_id1($id_harga); // Pastikan fungsi ini mengembalikan angka
    $stok_total = $stok_lama + $stok_baru;
    $dataupdate = array(
        'stok1' => $stok_total,
        'update_stok_logis' => date('Y-m-d H:i:s')
    );
    $this->harga_m->edit_harga2($dataupdate, $id_harga);
    $this->session->set_flashdata('success', 'Stok berhasil diubah.');
    redirect(base_url('stok'));
}
public function editin1()
{
    $id_harga = $this->input->post('id_harga');
    $stok_baru = (int)$this->input->post('update_stok');
    $stok_lama = $this->harga_m->get_stok_by_id10($id_harga); // Pastikan fungsi ini mengembalikan angka
    $stok_total = $stok_lama + $stok_baru;
    $dataupdate = array(
        'stok' => $stok_total,
        'update_stok' => date('Y-m-d H:i:s')
    );
    $this->harga_m->edit_harga2($dataupdate, $id_harga);
    $this->session->set_flashdata('success', 'Stok berhasil diubah.');
    redirect(base_url('stok/stokis'));
}

public function del($id)
{
    
    $hapus_harga = $this->harga_m->delete_harga($id);   
    $hapus_item  = $this->harga_m->delete_item($id);
    
    $this->session->set_flashdata('danger', 'Data berhasil dihapus.');
    redirect(base_url('harga/index_b'));
}
public function kurang()
{
    $status = $this->input->post('status'); 
    if($status == 2) {
        $id_harga = $this->input->post('id_harga');
        $jumlah = (int) $this->input->post('jumlah');
        $stok_lama = $this->harga_m->get_stok_by_id($id_harga); 
        $stok_total = $stok_lama - $jumlah;
        $dataupdate = array(
            'stok' => $stok_total
        );
        $this->harga_m->edit_stok($dataupdate, $id_harga);
        $this->session->set_flashdata('success', 'Stok berhasil dikurangi.');
        redirect(base_url('stok'));
    } else {

        $this->session->set_flashdata('error', 'Status tidak valid.');
        redirect(base_url('stok'));
    }
}

public function wita()
	{
        check_logistik();
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->harga_m->get4();
		$this->template->load('template','stok/stok_data3', $data);
	}


}