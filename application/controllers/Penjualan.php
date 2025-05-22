<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Untuk memanggil model
class Penjualan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('keranjang_model');
		$this->load->model('pesan_m');
		$this->load->model('harga_m');
        $this->load->library('form_validation');
		no();
    }
// Untuk dashboard penjualan
	public function index()
	{
		check_stokis();
    $user_id = $this->fungsi->user_login()->stokis;
    $data['row'] = $this->harga_m->get();
    $data['rows'] = $this->pesan_m->stokis($user_id);
    $data['rows_tl'] = $this->pesan_m->stokis_tl($user_id);
	$data['rows_tl_sum'] = $this->pesan_m->stokis_tl_sum($user_id);
    $this->template->load('template','penjualan/penjualan_data', $data);
	}
// Untuk dashboard penjualan khusus direksi
    public function index1()
	{
        check_direksi();
    $user_id = $this->fungsi->user_login()->stokis;
    $data['row'] = $this->harga_m->get();
    $data['rows'] = $this->pesan_m->stokis($user_id);
    $data['rows_tl'] = $this->pesan_m->stokis_tl($user_id);
	$data['rows_tl_sum'] = $this->pesan_m->stokis_tl_sum1($user_id);
    $this->template->load('template','penjualan/penjualan_data_direksi_po', $data);
	}
// Untuk dashboard penjualan khusus stokis
	public function index2()
{
    check_stokis();
    $user_id = $this->fungsi->user_login()->stokis;

    $data = [
        'row' => $this->harga_m->get(),
        'rows' => $this->pesan_m->stokis($user_id),
        'rows_tl' => $this->pesan_m->stokis_tl($user_id),
        'rows_tl_sum' => $this->pesan_m->stokis_tl_sum($user_id),
        
    ];

    $this->template->load('template', 'penjualan/penjualan_data2', $data);
}
// Untuk dashboard pemesanan bahan khusus direksi
	public function index_item()
{
    check_direksi();
    $user_id = $this->fungsi->user_login()->stokis;

    $data = [
        'row' => $this->harga_m->get(),
        'rows' => $this->pesan_m->stokis($user_id),
        'rows_tl' => $this->pesan_m->stokis_tl($user_id),
        'rows_tl_sum' => $this->pesan_m->stokis_tl_sum_direk($user_id),
        
    ];

    $this->template->load('template', 'penjualan/penjualan_data_direksi', $data);
}



}