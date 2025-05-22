<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Untuk memanggil model
class Dashboard extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->model('harga_m');
		$this->load->model('pesan_m');
		// Validasi sudah login apa belum
		no();
    }
	// untuk fungsi di dashboard seperti jumlah pemesanan
		public function index() {
		  $this->load->model('Pesan_m');
		  $this->load->model('keranjang_model');
		  
		  $user_id = $this->fungsi->user_login()->stokis;
		  $pemesan_id = $this->fungsi->user_login()->user_id;
		  $data['count_new_pesan'] = $this->Pesan_m->count_new_pesan($user_id);
		  $data['count_new_pesan_mit'] = $this->Pesan_m->count_new_pesan_mit($user_id);
		  $data['count_new_pesan_tl'] = $this->Pesan_m->count_new_pesan_tl($user_id);
		  $data['count_new_pesan_tl_mit'] = $this->Pesan_m->count_new_pesan_tl_mit($user_id);
		  $data['count_new_pesan_s'] = $this->Pesan_m->count_new_pesan_s($user_id);
		  $data['count_new_pesan_s_mit'] = $this->Pesan_m->count_new_pesan_s_mit($user_id);
		  $data['count_new_pesan_b'] = $this->Pesan_m->count_new_pesan_b($user_id);
		  $data['count_new_pesan_b_mit'] = $this->Pesan_m->count_new_pesan_b_mit($user_id);
		  $data['count_new_ayam'] = $this->Pesan_m->count_new_ayam($user_id);
		  $data['count_new_kentang'] = $this->Pesan_m->count_new_kentang($user_id);
		  $data['count_new_usus'] = $this->Pesan_m->count_new_usus($user_id);
		  $data['count_harga'] = $this->harga_m->count_harga($user_id);
		  $data['count_new_kulit'] = $this->pesan_m->count_new_kulit($user_id);
		  $data['count_user'] = $this->user_m->count_user($user_id);
		  $data['count_user_stokis_jawa'] = $this->user_m->count_user_stokis_jawa($user_id);
		  $data['count_user_mitra_jawa'] = $this->user_m->count_user_mitra_jawa($user_id);
		  $data['count_user_mitra_all'] = $this->user_m->count_user_mitra_all($user_id);
		  $data['count_user_mitra_sumatera'] = $this->user_m->count_user_mitra_sumatera($user_id);
		  $data['count_user_stokis_sumatera'] = $this->user_m->count_user_stokis_sumatera($user_id);
		  $data['count_user_mitra_wita'] = $this->user_m->count_user_mitra_wita($user_id);
		  $data['count_user_stokis_wita'] = $this->user_m->count_user_stokis_wita($user_id);
		  $data['count_harga_jawa'] = $this->harga_m->count_harga_jawa($user_id);
		  $data['count_harga_sumatra'] = $this->harga_m->count_harga_sumatra($user_id);
		  $data['count_harga_wita'] = $this->harga_m->count_harga_wita($user_id);
		  $data['count_penjualan'] = $this->harga_m->count_penjualan($user_id);
		  $data['count_item_jawa'] = $this->harga_m->count_item_jawa($user_id);
		  $data['countBarangByPesanId'] = $this->keranjang_model->countBarangByPesanId($user_id);
		  $data['count_permintaan_stok'] = $this->harga_m->count_permintaan_stok($user_id);
		  $data['count_total_stokis'] = $this->pesan_m->count_total_stokis($user_id);
		  $data['count_total_stokis_tl'] = $this->pesan_m->count_total_stokis_tl($user_id);
		  $data['count_total_stokis_tl_b'] = $this->pesan_m->count_total_stokis_tl_b($user_id);

		  $this->template->load('template','dashboard',$data);
		}
	  }
	  

	
