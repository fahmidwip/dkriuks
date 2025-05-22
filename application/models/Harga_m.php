<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Harga_m extends CI_Model {

  
  public function get($id = null)
  {
      // Ambil ID provinsi dari session
      $provinsi_id = $this->fungsi->user_login()->provinsi;
  
      $this->db->select('harga.*, item.nama_item as name_barang, provinsi.provinsi as provinsi_name, stok.stok as stok_barang');
      $this->db->from('harga');
      $this->db->join('item', 'item.id_item = harga.nama_item','left');
      $this->db->join('provinsi', 'provinsi.id_prov = harga.harga_provinsi','left');
      $this->db->join('stok', 'stok.id_stok = harga.nama_item','left');
  
      // Filter berdasarkan ID harga jika diberikan
      if ($id != null) {
          $this->db->where('harga.id_harga', $id);
      }
  
      // Filter berdasarkan provinsi dari session jika ada
      if ($provinsi_id != null) {
          $this->db->where('harga.harga_provinsi', $provinsi_id);
      }
  
      $this->db->order_by('harga.id_harga', 'asc');
  
      $query = $this->db->get();
      return $query->result();
  }

  public function get1($id = null)
  {
      
      $provinsi_id = $this->fungsi->user_login()->provinsi;
  
      $this->db->select('harg.*, provinsi.provinsi as provinsi_name');
      $this->db->from('harg');
      $this->db->join('provinsi', 'provinsi.id_prov = harg.provinsi','left');
      
  
      // Filter berdasarkan ID harga jika diberikan
      if ($id != null) {
        $this->db->where('harg.id_harga', $id);
    }

    // Filter berdasarkan provinsi dari session jika ada
    if ($provinsi_id != null) {
        $this->db->where('harg.provinsi', $provinsi_id);
    }

  
      $this->db->order_by('harg.id_harga', 'asc');
  
      $query = $this->db->get();
      return $query->result();
  }


    public function getfull($id = null)
  {
      
      $provinsi_id = $this->fungsi->user_login()->provinsi;
  
      $this->db->select('harg.*, provinsi.provinsi as provinsi_name');
      $this->db->from('harg');
      $this->db->join('provinsi', 'provinsi.id_prov = harg.provinsi','left');
      
  
      // Filter berdasarkan ID harga jika diberikan
      if ($id != null) {
        $this->db->where('harg.id_harga', $id);
    }


  
      $this->db->order_by('harg.id_harga', 'asc');
  
      $query = $this->db->get();
      return $query->result();
  }

  
public function jawa($id = null)
  {
      
      $provinsi_id = $this->fungsi->user_login()->provinsi;
  
      $this->db->select('harg.*, provinsi.provinsi as provinsi_name');
      $this->db->from('harg');
      $this->db->join('provinsi', 'provinsi.id_prov = harg.provinsi','left');
      
  
      // Filter berdasarkan ID harga jika diberikan
      if ($id != null) {
        $this->db->where('harg.id_harga', $id);
    }

    // Filter berdasarkan provinsi dari session jika ada
    if ($provinsi_id != null) {
        $this->db->where('harg.provinsi', 1);
    }

  
      $this->db->order_by('harg.id_harga', 'asc');
  
      $query = $this->db->get();
      return $query->result();
  }

public function sumatera($id = null)
  {
      
      $provinsi_id = $this->fungsi->user_login()->provinsi;
  
      $this->db->select('harg.*, provinsi.provinsi as provinsi_name');
      $this->db->from('harg');
      $this->db->join('provinsi', 'provinsi.id_prov = harg.provinsi','left');
      
  
      // Filter berdasarkan ID harga jika diberikan
      if ($id != null) {
        $this->db->where('harg.id_harga', $id);
    }

    // Filter berdasarkan provinsi dari session jika ada
    if ($provinsi_id != null) {
        $this->db->where('harg.provinsi', 3);
    }

  
      $this->db->order_by('harg.id_harga', 'asc');
  
      $query = $this->db->get();
      return $query->result();
  }

  public function wita($id = null)
  {
      
      $provinsi_id = $this->fungsi->user_login()->provinsi;
  
      $this->db->select('harg.*, provinsi.provinsi as provinsi_name');
      $this->db->from('harg');
      $this->db->join('provinsi', 'provinsi.id_prov = harg.provinsi','left');
      
  
      // Filter berdasarkan ID harga jika diberikan
      if ($id != null) {
        $this->db->where('harg.id_harga', $id);
    }

    // Filter berdasarkan provinsi dari session jika ada
    if ($provinsi_id != null) {
        $this->db->where('harg.provinsi', 7);
    }

  
      $this->db->order_by('harg.id_harga', 'asc');
  
      $query = $this->db->get();
      return $query->result();
  }

public function get3($id = null)
{
      
  $provinsi_id = $this->fungsi->user_login()->provinsi;
  $stokis_id = $this->fungsi->user_login()->stokis;

  $this->db->select('s.*, provinsi.provinsi as provinsi_name, harg1.nama_produk, harg2.harga_mitra');
  $this->db->from('s');
  $this->db->join('provinsi', 'provinsi.id_prov = s.provinsi','left');
  $this->db->join('harg as harg1', 'harg1.id_harga = s.barang_id', 'left');
  $this->db->join('harg as harg2', 'harg2.id_harga = s.barang_id', 'left');
  

  if ($provinsi_id != null) {
    $this->db->where('s.provinsi', $provinsi_id);
}
if ($stokis_id != null) {
  $this->db->where('s.stokis', $stokis_id);
}

 
  $this->db->order_by('s.id_stok', 'asc');

  $query = $this->db->get();
  return $query->result();
}

  public function get2($id = null)
  {
      
      $provinsi_id = $this->fungsi->user_login()->provinsi;
      $stokis_id = $this->fungsi->user_login()->logistik;
  
      $this->db->select('s.*, provinsi.provinsi as provinsi_name, harg1.nama_produk, harg2.harga_mitra');
      $this->db->from('s');
      $this->db->join('provinsi', 'provinsi.id_prov = s.provinsi','left');
      $this->db->join('harg as harg1', 'harg1.id_harga = s.barang_id', 'left');
      $this->db->join('harg as harg2', 'harg2.id_harga = s.barang_id', 'left');
      
  
      if ($provinsi_id != null) {
        $this->db->where('s.provinsi', $provinsi_id);
    }
    if ($stokis_id != null) {
      $this->db->where('s.stokis', $stokis_id);
  }
    
     
      $this->db->order_by('s.id_stok', 'asc');
  
      $query = $this->db->get();
      return $query->result();
  }

public function get4($id = null)
{
      
  $provinsi_id = $this->fungsi->user_login()->provinsi;
  $stokis_id = $this->fungsi->user_login()->stokis;

  $this->db->select('s.*, provinsi.provinsi as provinsi_name, harg1.nama_produk, harg2.harga_mitra');
  $this->db->from('s');
  $this->db->join('provinsi', 'provinsi.id_prov = s.provinsi','left');
  $this->db->join('harg as harg1', 'harg1.id_harga = s.barang_id', 'left');
  $this->db->join('harg as harg2', 'harg2.id_harga = s.barang_id', 'left');
  

  if ($provinsi_id != null) {
    $this->db->where('s.provinsi', 7);
}
if ($stokis_id != null) {
  $this->db->where('s.stokis', $stokis_id);
}

 
  $this->db->order_by('s.id_stok', 'asc');

  $query = $this->db->get();
  return $query->result();
}
   public function get7($id = null)
  {
      
      $provinsi_id = $this->fungsi->user_login()->provinsi;
      $stokis_id = $this->fungsi->user_login()->stokis;
  
      $this->db->select('s.*, provinsi.provinsi as provinsi_name, harg1.nama_produk, harg2.harga_mitra');
      $this->db->from('s');
      $this->db->join('provinsi', 'provinsi.id_prov = s.provinsi','left');
      $this->db->join('harg as harg1', 'harg1.id_harga = s.barang_id', 'left');
      $this->db->join('harg as harg2', 'harg2.id_harga = s.barang_id', 'left');
      
  
      if ($provinsi_id != null) {
        $this->db->where('s.provinsi', $provinsi_id);
    }
    if ($stokis_id != null) {
      $this->db->where('s.stokis', $stokis_id);
  }
    
     
      $this->db->order_by('s.id_stok', 'asc');
  
      $query = $this->db->get();
      return $query->result();
  }
  
  public function getBarangById($id) {
    return $this->db->get_where('harg', ['id_harga' => $id])->row();
}
public function add($data){
    $this->db->insert('keranjang',$data);
    }
    public function add_item($data){
        $this->db->insert('item',$data);
        }
        public function add_harga($data){
            $this->db->insert('harg',$data);
            }
  
            public function add_harga1($data){
              $this->db->insert('harg',$data);
              }

public function detail($id) {
      $this->db->select('harg.*, item.nama_item as name_barang, provinsi.provinsi as provinsi_name, stok.stok as stok_barang');
      $this->db->from('harg');
      $this->db->join('item', 'item.id_item = harg.nama_produk','left');
      $this->db->join('provinsi', 'provinsi.id_prov = harg.provinsi','left');
      $this->db->join('stok', 'stok.id_stok = harg.nama_produk','left');
      $this->db->where('harg.id_harga', $id);
              
    $query = $this->db->get(); 
    return $query->row();
              }
              public function detail1($id) {
                $this->db->select('s.*, provinsi.provinsi as provinsi_name');
                $this->db->from('S');
                $this->db->join('provinsi', 'provinsi.id_prov = s.provinsi','left');
                $this->db->where('s.id_stok', $id);
                        
              $query = $this->db->get(); 
              return $query->row();
                        }
public function detail_item($id)
{
    $this->db->select('item.*');
    $this->db->from('item');
    $this->db->where('id_item', $id);
  
    
     $query = $this->db->get(); // cukup get() tanpa parameter karena FROM sudah didefinisikan
    return $query->row();
}
public function delete_harga($id){
    $this->db->where('id_harga',$id);
    $this->db->delete('harg');
  }
  public function delete_item($id){
    $this->db->where('id_item',$id);
    $this->db->delete('item');
  }
  public function delete_harga1($id){
    $this->db->where('id_harga',$id);
    $this->db->delete('harg');
  }
  public function delete_item1($id){
    $this->db->where('id_item',$id);
    $this->db->delete('item');
  }

  public function edit_harga($data, $id){
    $this->db->where('id_harga',$id);
    $this->db->update('harg',$data);
  }
  public function edit_harga1($data, $id){
    $this->db->where('id_harga',$id);
    $this->db->update('harg',$data);
  }
  public function edit_harga2($data, $id){
    $this->db->where('id_stok',$id);
    $this->db->update('s',$data);
  }
  public function get_stok_by_id($id_harga)
{
    $this->db->select('stok');
    $this->db->from('harg');
    $this->db->where('id_harga', $id_harga);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return (int)$query->row()->stok;
    } else {
        return 0;
    }
}


public function get_stok_by_id1($id_stok)
{
    $this->db->select('stok1');
    $this->db->from('s');
    $this->db->where('id_stok', $id_stok);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return (int)$query->row()->stok1;
    } else {
        return 0;
    }
}

public function get_stok_by_id10($id_stok)
{
    $this->db->select('stok');
    $this->db->from('s');
    $this->db->where('id_stok', $id_stok);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return (int)$query->row()->stok;
    } else {
        return 0;
    }
}


public function get_stok_by_id5($id_stok)
{
    $this->db->select('stok');
    $this->db->from('s');
    $this->db->where('id_stok', $id_stok);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return (int)$query->row()->stok;
    } else {
        return 0;
    }
}

public function get_stok_by_id6($id_stok)
{
    $this->db->select('stok');
    $this->db->from('s');
    $this->db->where('id_stok', $id_stok);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return (int)$query->row()->stok;
    } else {
        return 0;
    }
}


public function get_stok_by_id2($id_harg)
{
    $this->db->select('stok');
    $this->db->from('s');
    $this->db->where('id_harga', $id_harg);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return (int)$query->row()->stok;
    } else {
        return 0;
    }
}


public function get_stok_by_jumlah($id_harga)
{
    $this->db->select('jumlah');
    $this->db->from('keranjang');
    $this->db->where('keranjang_id', $id_harga);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return (int)$query->row()->jumlah;
    } else {
        return 0;
    }
}
public function edit_stok($data, $id){
  $this->db->where('id_harga',$id);
  $this->db->update('harg',$data);
}

public function edit_stok1($data, $id){
  $this->db->where('id_stok',$id);
  $this->db->update('s',$data);
}

public function count_harga($user_id) {
    return $this->db->count_all_results('harg');
  }

  public function count_harga_jawa($user_id) {
    $this->db->where_in('harg.provinsi', [1]);
    return $this->db->count_all_results('harg');
  }
  public function count_harga_sumatra($user_id) {
    $this->db->where_in('harg.provinsi', [3]);
    return $this->db->count_all_results('harg');
  }
  public function count_harga_wita($user_id) {
    $this->db->where_in('harg.provinsi', [7]);
    return $this->db->count_all_results('harg');
  }
  public function count_penjualan($user_id) {
    $this->db->where_in('pesan.status', [2]);
    return $this->db->count_all_results('pesan');
  }
  public function count_item_jawa($user_id) {
    $provinsi_id = $this->fungsi->user_login()->provinsi;
    if ($provinsi_id != null) {
          $this->db->where('harg.provinsi', $provinsi_id);
      }
    return $this->db->count_all_results('harg');
  }
  public function count_mitra_jawa($user_id) {
    $this->db->where_in('user.level', [2]);
    $this->db->where_in('user.provinsi', [1]);
    return $this->db->count_all_results('user');
  }
 public function count_permintaan_stok($user_id) {
    $this->db->where_in('pesan.status', [6]);
    return $this->db->count_all_results('pesan');
  }


}
