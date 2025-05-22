<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Untuk memanggil model
class Keranjang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Keranjang_model');
		$this->load->model('harga_m');
    }

    // Fungsi untuk menampilkan keranjang belanja
    public function index() {
        // Misalnya kita menggunakan user_id dari sesi login
        $user_id = $this->session->userdata('userid');
        
        // Ambil data keranjang dari model
        $data['keranjang'] = $this->Keranjang_model->getKeranjangData($user_id);
        
        // Tampilkan view dengan data keranjang
        $this->template->load('template','keranjang/index', $data);
    }

    // Fungsi untuk menambah barang ke keranjang
	public function tambah($id_barang = null) {
		// Cek user login
		$user_id = $this->session->userdata('userid');
		if (!$user_id) {
			redirect('login');
			return;
		}
	
		// Cek ID barang dari URL
		if (!$id_barang) {
			show_404();
			return;
		}
	
		// Ambil data barang dari database
		$this->load->model('harga_m');
		$barang = $this->harga_m->getBarangById($id_barang);
	
		if (!$barang) {
			show_error("Barang tidak ditemukan");
			return;
		}
	
		// Tambah data ke keranjang
		$data = array(
			'user_id' => $user_id,
			'barang_id' => $id_barang,
			'jumlah' => 1, // default 1 atau sesuai kebutuhan
			'harga_total' => $barang->harga_jual_mitra, // hitung sesuai jumlah kalau perlu
			'created_at' => date('Y-m-d H:i:s')
		);
	
		$this->Keranjang_model->addToKeranjang($data);
		redirect('keranjang'); // redirect setelah ditambahkan
	}
	

    // Fungsi untuk mengupdate jumlah barang di keranjang
    public function update($keranjang_id) {
        $jumlah = $this->input->post('jumlah');
        $this->Keranjang_model->updateKeranjang($keranjang_id, $jumlah);
        
        // Redirect ke halaman keranjang
        redirect('keranjang');
    }

    // Fungsi untuk menghapus barang dari keranjang
    public function hapus($keranjang_id) {
        $this->Keranjang_model->deleteFromKeranjang($keranjang_id);
        
        // Redirect ke halaman keranjang
        redirect('keranjang');
    }
}
