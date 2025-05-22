<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang_model extends CI_Model {

  public function get($user_id, $id = null) { 
    $this->db->select('keranjang.*, item.nama_item as nama_item, user.name as nama,');
    $this->db->from('keranjang');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left');
    $this->db->join('user', 'user.user_id = keranjang.user_id', 'left'); // pembuat
  
    // Filter berdasarkan status dan spv
    $this->db->where('keranjang.user_id', $user_id);
  
    // Jika id diterima, tambahkan kondisi untuk filter id_aju
    if ($id != null) {
        $this->db->where('keranjang.keranjang_id', $id);
    }
  
    $this->db->order_by('keranjang.keranjang_id', 'asc');
  
    $query = $this->db->get();
    return $query->result(); 
  }
 

    // Fungsi untuk mengambil data keranjang dari database
    public function getKeranjangData($user_id = NULL) {
        // Jika user_id diberikan, ambil data keranjang untuk user tersebut
        if ($user_id) {
            $this->db->where('user_id', $user_id);
        }

        $query = $this->db->get('keranjang'); // Mengambil data dari tabel keranjang
        return $query->result(); // Mengembalikan data dalam bentuk array objek
    }

    // Fungsi untuk menambah barang ke keranjang
    public function addToKeranjang($data) {
        return $this->db->insert('keranjang', $data); // Menambah data ke tabel keranjang
    }

    // Fungsi untuk mengupdate jumlah barang di keranjang
    public function updateKeranjang($keranjang_id, $jumlah) {
        $this->db->set('jumlah', $jumlah); // Mengupdate jumlah barang
        $this->db->where('keranjang_id', $keranjang_id); // Berdasarkan ID keranjang
        return $this->db->update('keranjang'); // Melakukan update
    }

    // Fungsi untuk menghapus barang dari keranjang
    public function deleteFromKeranjang($keranjang_id) {
        $this->db->where('keranjang_id', $keranjang_id);
        return $this->db->delete('keranjang'); // Menghapus barang berdasarkan ID
    }

    // Fungsi untuk menghitung total harga keranjang
    public function getTotalKeranjang($user_id) {
        $this->db->select_sum('harga_total'); // Menghitung total harga
        $this->db->where('user_id', $user_id); // Berdasarkan ID user
        $query = $this->db->get('keranjang');
        return $query->row()->harga_total; // Mengembalikan total harga
    }

    public function detail($id) {
      $this->db->select('keranjang.*, item.nama_item as nama_item, user.name as nama');
      $this->db->from('keranjang');
      
      
      $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left');
      $this->db->join('user', 'user.user_id = keranjang.user_id', 'left');
      $this->db->where('keranjang.keranjang_id', $id);
    
      $query = $this->db->get(); // cukup get() tanpa parameter karena FROM sudah didefinisikan
      return $query->row();
    }
    public function getByPesanId($id) {
        $this->db->select('keranjang.*, item.nama_item as nama, pesan1.kode_pesanan,pesan2.catatan as catatan_mitra, pesan3.catatan_stokis as catatan_stokis, harg1.harga_mitra, harg2.nama_produk');
        $this->db->from('keranjang');
        $this->db->join('item', 'item.id_item = keranjang.jenis_id', 'left');
        $this->db->join('pesan as pesan1', 'pesan1.id_pesan = keranjang.pesan_id', 'left');
        $this->db->join('pesan as pesan2', 'pesan2.id_pesan = keranjang.pesan_id', 'left');
        $this->db->join('pesan as pesan3', 'pesan3.id_pesan = keranjang.pesan_id', 'left');
        $this->db->join('harg as harg1', 'harg1.id_harga = keranjang.barang_id', 'left');
        $this->db->join('harg as harg2', 'harg2.id_harga = keranjang.barang_id', 'left');
        $this->db->where('keranjang.pesan_id', $id);
    
        $query = $this->db->get();
        return $query->result(); // <-- return sebagai array!
    }
public function getByPesanId1($user_id) {
        $this->db->select('keranjang.*, item.nama_item as nama, pesan1.kode_pesanan,pesan2.catatan as catatan_mitra, pesan3.catatan_stokis as catatan_stokis, harg1.harga_mitra, harg2.nama_produk');
        $this->db->from('keranjang');
        $this->db->join('item', 'item.id_item = keranjang.jenis_id', 'left');
        $this->db->join('pesan as pesan1', 'pesan1.id_pesan = keranjang.pesan_id', 'left');
        $this->db->join('pesan as pesan2', 'pesan2.id_pesan = keranjang.pesan_id', 'left');
        $this->db->join('pesan as pesan3', 'pesan3.id_pesan = keranjang.pesan_id', 'left');
        $this->db->join('harg as harg1', 'harg1.id_harga = keranjang.barang_id', 'left');
        $this->db->join('harg as harg2', 'harg2.id_harga = keranjang.barang_id', 'left');
        $this->db->where('keranjang.pesan_id', $user_id);
    
        $query = $this->db->get();
        return $query->result(); // <-- return sebagai array!
    }

    public function delete($id){
        $this->db->where('pesan_id',$id);
        $this->db->delete('keranjang');    
}

public function countBarangByPesanId($id) {
   $this->db->select('barang_id, COUNT(barang_id) as jumlah');
    $this->db->from('keranjang');
    $this->db->where('pesan_id', $id);
    $this->db->group_by('barang_id');
    $this->db->order_by('jumlah', 'DESC');
    $this->db->limit(1); // hanya ambil yang paling banyak

    $query = $this->db->get();
    return $query->row(); // hasilnya object: barang_id dan jumlah
}
}