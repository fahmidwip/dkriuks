<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan_m extends CI_Model {

  
  public function get($user_id = null, $id = null)
{
    if ($user_id === null) {
        $user_id = $this->fungsi->user_login()->user_id;
    }

    $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, item.nama_item as nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    
    $this->db->where_in('pesan.status', [1]);
    $this->db->where('pesan.pemesan', $user_id);

    // Jika ingin ambil berdasarkan ID pesan tertentu
    if ($id !== null) {
        $this->db->where('pesan.id_pesan', $id);
    }
    $this->db->order_by('pesan.id_pesan', 'DESC');
    $query = $this->db->get();
    return $query->result();
}

public function get1($user_id = null, $id = null)
{
    if ($user_id === null) {
        $user_id = $this->fungsi->user_login()->user_id;
    }

    $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, item.nama_item as nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    
    $this->db->where_in('pesan.status', [7]);
    $this->db->where('pesan.pemesan', $user_id);

    // Jika ingin ambil berdasarkan ID pesan tertentu
    if ($id !== null) {
        $this->db->where('pesan.id_pesan', $id);
    }
$this->db->order_by('pesan.id_pesan', 'DESC');
    $query = $this->db->get();
    return $query->result();
}

  public function add($data){
    $this->db->insert('pesan',$data);
    }
    public function getBarangById($id) {
      return $this->db->get_where('pesan', ['id_pesan' => $id])->row();
  }
  public function detail($id) {
    $this->db->select('pesan.*, user1.name as user, user2.alamat as alamat, item.nama_item as nama, status.status_nama as statusnya, stokis1.nama_stokis as nama_stokis, stokis2.alamat as alamat_stokis');
      $this->db->from('pesan');
      $this->db->join('user as user1', 'user1.user_id = pesan.pemesan', 'left');
      $this->db->join('user as user2', 'user1.user_id = pesan.pemesan', 'left');
      $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
      $this->db->join('stokis as stokis1', 'stokis1.id_stokis = pesan.stokis', 'left');
      $this->db->join('stokis as stokis2', 'stokis2.id_stokis = pesan.stokis', 'left');
      $this->db->join('status', 'status.id_status = pesan.status', 'left');
      $this->db->where('pesan.id_pesan', $id);
       $this->db->order_by('pesan.id_pesan', 'DESC');
      $query = $this->db->get(); // cukup get() tanpa parameter karena FROM sudah didefinisikan
      return $query->row();
}

public function detail1($user_id) {
    $this->db->select('pesan.*, user1.name as user, user2.alamat as alamat, item.nama_item as nama, status.status_nama as statusnya, stokis1.nama_stokis as nama_stokis, stokis2.alamat as alamat_stokis');
      $this->db->from('pesan');
      $this->db->join('user as user1', 'user1.user_id = pesan.pemesan', 'left');
      $this->db->join('user as user2', 'user1.user_id = pesan.pemesan', 'left');
      $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
      $this->db->join('stokis as stokis1', 'stokis1.id_stokis = pesan.stokis', 'left');
      $this->db->join('stokis as stokis2', 'stokis2.id_stokis = pesan.stokis', 'left');
      $this->db->join('status', 'status.id_status = pesan.status', 'left');
      $this->db->where('pesan.id_pesan', $user_id);
    $this->db->order_by('pesan.id_pesan', 'DESC');
      $query = $this->db->get(); // cukup get() tanpa parameter karena FROM sudah didefinisikan
      return $query->row();
}
public function stokis($user_id, $id = null) { 
  $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, item.nama_item as nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
  
  $this->db->where_in('pesan.status', [4]); 
  $this->db->where('pesan.stokis', $user_id);

  
  if ($id != null) {
      $this->db->where('pesan.id_pesan', $id);
  }

  $this->db->order_by('pesan.id_pesan', 'DESC');
$this->db->order_by('pesan.id_pesan', 'DESC');
  $query = $this->db->get();
  return $query->result(); 
}

public function stokis1($user_id, $id = null) { 
  $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, item.nama_item as nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
  
  $this->db->where_in('pesan.status', [4]); 
  

  
  if ($id != null) {
      $this->db->where('pesan.id_pesan', $id);
  }

  $this->db->order_by('pesan.id_pesan', 'asc');
$this->db->order_by('pesan.id_pesan', 'DESC');
  $query = $this->db->get();
  return $query->result(); 
}

public function stokis2($user_id, $id = null) { 
  $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, item.nama_item as nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
  
  $this->db->where_in('pesan.status', [5]); 
  $this->db->where('pesan.stokis', $user_id);

  
  if ($id != null) {
      $this->db->where('pesan.id_pesan', $id);
  }

  $this->db->order_by('pesan.id_pesan', 'DESC');

  $query = $this->db->get();
  return $query->result(); 
}

public function count_new_pesan($users_id) {
  // Jika object, ambil propertinya
  if (is_object($users_id)) {
    $users_id = $users_id->users_id;
  }

  $this->db->where_in('pesan.status', [1]);
  $this->db->where('stokis', $users_id);
  return $this->db->count_all_results('pesan');
}

public function count_new_pesan_mit() {
  $user = $this->fungsi->user_login();

  // Ambil nilai dari objek user
  $stokis_id = isset($user->stokis) ? $user->stokis : null;
  $user_id   = isset($user->user_id) ? $user->user_id : null;

  $this->db->where_in('pesan.status', [1]);

  if ($stokis_id !== null) {
      $this->db->where('stokis', $stokis_id);
  }

  if ($user_id !== null) {
      $this->db->where('pemesan', $user_id);
  }

  return $this->db->count_all_results('pesan');
}

public function count_new_pesan_tl($users_id) {
  $this->db->where_in('pesan.status', [4]);
  $this->db->where('stokis', $users_id);
  return $this->db->count_all_results('pesan');
}

public function count_new_pesan_tl_mit() {
  $user = $this->fungsi->user_login();

  // Ambil nilai dari objek user
  $stokis_id = isset($user->stokis) ? $user->stokis : null;
  $user_id   = isset($user->user_id) ? $user->user_id : null;

  $this->db->where_in('pesan.status', [4]);

  if ($stokis_id !== null) {
      $this->db->where('stokis', $stokis_id);
  }

  if ($user_id !== null) {
      $this->db->where('pemesan', $user_id);
  }

  return $this->db->count_all_results('pesan');
}


public function count_new_pesan_s($users_id) {
  $this->db->where_in('pesan.status', [2]);
  $this->db->where('stokis', $users_id);
  return $this->db->count_all_results('pesan');
}
public function count_new_pesan_s_mit() {
  $user = $this->fungsi->user_login();

  // Ambil nilai dari objek user
  $stokis_id = isset($user->stokis) ? $user->stokis : null;
  $user_id   = isset($user->user_id) ? $user->user_id : null;

  $this->db->where_in('pesan.status', [2]);

  if ($stokis_id !== null) {
      $this->db->where('stokis', $stokis_id);
  }

  if ($user_id !== null) {
      $this->db->where('pemesan', $user_id);
  }

  return $this->db->count_all_results('pesan');
}
public function count_new_pesan_b($users_id) {
  $this->db->where_in('pesan.status', [3]);
  $this->db->where('stokis', $users_id);
  return $this->db->count_all_results('pesan');
}

public function count_new_pesan_b_mit() {
  $user = $this->fungsi->user_login();

  // Ambil nilai dari objek user
  $stokis_id = isset($user->stokis) ? $user->stokis : null;
  $user_id   = isset($user->user_id) ? $user->user_id : null;

  $this->db->where_in('pesan.status', [3]);

  if ($stokis_id !== null) {
      $this->db->where('stokis', $stokis_id);
  }

  if ($user_id !== null) {
      $this->db->where('pemesan', $user_id);
  }

  return $this->db->count_all_results('pesan');
}
public function count_new_ayam($users_id, $id = null) {
  
  if ($users_id === null) {
    $users_id = $this->fungsi->user_login()->user_id;
}
  $this->db->select('SUM(keranjang.jumlah) as total');
  $this->db->from('keranjang');
  $this->db->join('pesan', 'pesan.id_pesan = keranjang.pesan_id', 'left');
  $this->db->where_in('keranjang.barang_id', [1, 2, 186, 191, 246, 254, 255, 274, 289, 317, 320, 321, 538, 546, 547, 763]);
  $this->db->where('pesan.status', 2);
  $this->db->where('keranjang.stokis', $users_id);
  $this->db->where_in('pesan.status', [2, 4, 3]);
  $this->db->where('pesan.pemesan', $users_id);

  // Jika ingin ambil berdasarkan ID pesan tertentu
  if ($id !== null) {
      $this->db->where('pesan.id_pesan', $id);
  }
  $query = $this->db->get();
  $result = $query->row();

  return isset($result->total) ? (int)$result->total : 0;
}
public function count_new_kentang($user_id) {
  
  $this->db->select('SUM(keranjang.jumlah) as total');
  $this->db->from('keranjang');
  $this->db->join('pesan', 'pesan.id_pesan = keranjang.pesan_id', 'left');
  $this->db->where_in('keranjang.barang_id', [34, 35, 47, 48, 116, 208, 211, 259, 263, 350, 351, 362, 363, 478, 480, 523, 527, 577, 578, 590, 705, 707, 748, 752]);
  $this->db->where('pesan.status', 2);
  $this->db->where('keranjang.stokis', $user_id);

  $query = $this->db->get();
  $result = $query->row();

  return isset($result->total) ? (int)$result->total : 0;
}
public function count_new_usus($user_id) {
  $this->db->select('SUM(keranjang.jumlah) as total');
  $this->db->from('keranjang');
  $this->db->join('pesan', 'pesan.id_pesan = keranjang.pesan_id', 'left');
  $this->db->where_in('keranjang.barang_id', [9, 10, 11, 12]);
  $this->db->where('pesan.status', 2);
  $this->db->where('keranjang.stokis', $user_id);

  $query = $this->db->get();
  $result = $query->row();

  return isset($result->total) ? (int)$result->total : 0;
}
  public function count_new_kulit($user_id) {
  $this->db->select('SUM(keranjang.jumlah) as total');
  $this->db->from('keranjang');
  $this->db->join('pesan', 'pesan.id_pesan = keranjang.pesan_id', 'left');
  $this->db->where_in('keranjang.barang_id', [24, 25]);
  $this->db->where('pesan.status', 2);
  $this->db->where('keranjang.stokis', $user_id);

  $query = $this->db->get();
  $result = $query->row();

  return isset($result->total) ? (int)$result->total : 0;
}



public function get_tl($user_id = null, $id = null)
{
    if ($user_id === null) {
        $user_id = $this->fungsi->user_login()->user_id;
    }

    $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, item.nama_item as nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    
    $this->db->where_in('pesan.status', [2, 4, 3]);
    $this->db->where('pesan.pemesan', $user_id);

    // Jika ingin ambil berdasarkan ID pesan tertentu
    if ($id !== null) {
        $this->db->where('pesan.id_pesan', $id);
    }

    $query = $this->db->get();
    return $query->result();
}
public function get_tl1($user_id = null, $id = null)
{
    if ($user_id === null) {
        $user_id = $this->fungsi->user_login()->user_id;
    }

    $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, item.nama_item as nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    
    $this->db->where_in('pesan.status', [3, 5, 6]);
    $this->db->where('pesan.pemesan', $user_id);

    // Jika ingin ambil berdasarkan ID pesan tertentu
    if ($id !== null) {
        $this->db->where('pesan.id_pesan', $id);
    }
$this->db->order_by('pesan.id_pesan', 'DESC');
    $query = $this->db->get();
    return $query->result();
}

public function delete($id){
  $this->db->where('id_pesan',$id);
  $this->db->delete('pesan');
}

public function stokis_tl($user_id, $id = null) { 
  $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, item.nama_item as nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
  
  $this->db->where_in('pesan.status', [2, 3]); 
  $this->db->where('pesan.stokis', $user_id);

  
  if ($id != null) {
      $this->db->where('pesan.id_pesan', $id);
  }

  $this->db->order_by('pesan.id_pesan', 'DESC');

  $query = $this->db->get();
  return $query->result(); 
}


public function stokis_tl2($user_id, $id = null) { 
  $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, item.nama_item as nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
  
  $this->db->where_in('pesan.status', [6, 3]); 
  $this->db->where('pesan.stokis', $user_id);

  
  if ($id != null) {
      $this->db->where('pesan.id_pesan', $id);
  }

  
$this->db->order_by('pesan.id_pesan', 'DESC');
  $query = $this->db->get();
  return $query->result(); 
}


public function stokis_tl2_direk($user_id, $id = null) { 
  $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, item.nama_item as nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
  
  $this->db->where_in('pesan.status', [6]); 
  

  
  if ($id != null) {
      $this->db->where('pesan.id_pesan', $id);
  }

  
$this->db->order_by('pesan.id_pesan', 'DESC');
  $query = $this->db->get();
  return $query->result(); 
}



public function stokis_tl1($user_id, $id = null) { 
  $this->db->select('pesan.*, user.name as user, stokis.nama_stokis as stokis_nama, item.nama_item as nama, status.status_nama as statusnya');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = pesan.stokis', 'left');
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
  
  $this->db->where_in('pesan.status', [2, 3]); 
  

  
  if ($id != null) {
      $this->db->where('pesan.id_pesan', $id);
  }

  $this->db->order_by('pesan.id_pesan', 'asc');

  $query = $this->db->get();
  return $query->result(); 
}


public function stokis_tl_sum($user_id, $id = null) {
    $this->db->select('
        pesan.*, 
        user.name AS user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); // diasumsikan item diambil dari keranjang
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left'); // diasumsikan id_harga = barang_id

    $this->db->where('pesan.status', 2); 
    $this->db->where('pesan.stokis', $user_id);

    if ($id !== null) {
        $this->db->where('pesan.id_pesan', $id);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');

    $query = $this->db->get();
    return $query->result();
}

public function stokis_tl_sum_direk($user_id, $id = null) {
    $this->db->select('
        pesan.*, 
        user.name AS user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); // diasumsikan item diambil dari keranjang
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left'); // diasumsikan id_harga = barang_id

    $this->db->where('pesan.status', 2); 
    

    if ($id !== null) {
        $this->db->where('pesan.id_pesan', $id);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');

    $query = $this->db->get();
    return $query->result();
}



public function stokis_tl_sum1($user_id, $id = null) { 
  $this->db->select('
        pesan.*, 
        user.name AS user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); // diasumsikan item diambil dari keranjang
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left'); // diasumsikan id_harga = barang_id

    $this->db->where('pesan.status', 2); 
    

    if ($id !== null) {
        $this->db->where('pesan.id_pesan', $id);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');

    $query = $this->db->get();
    return $query->result();
}

public function logistik_tl_sum($user_id, $id = null) {
    $this->db->select('
        pesan.*, 
        user.name AS user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); // diasumsikan item diambil dari keranjang
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left'); // diasumsikan id_harga = barang_id

    $this->db->where('pesan.status', 6); 
    $this->db->where('pesan.stokis', $user_id);

    if ($id !== null) {
        $this->db->where('pesan.id_pesan', $id);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');

    $query = $this->db->get();
    return $query->result();
}

public function logistik_tl_sum_stk($user_id, $id = null) {
  $user = $this->fungsi->user_login();

  // Ambil nilai dari objek user
  
  $user_id   = isset($user->user_id) ? $user->user_id : null;
  $this->db->select('
        pesan.*, 
        user.name AS user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); // diasumsikan item diambil dari keranjang
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left'); // diasumsikan id_harga = barang_id

    $this->db->where('pesan.status', 6); 
    $this->db->where('pesan.pemesan', $user_id);
    

    if ($id !== null) {
        $this->db->where('pesan.id_pesan', $id);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');

    $query = $this->db->get();
    return $query->result();
}

public function logistik_tl_sum1($user_id, $id = null) {
    $this->db->select('
        pesan.*, 
        user.name AS user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); // diasumsikan item diambil dari keranjang
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left'); // diasumsikan id_harga = barang_id

    $this->db->where('pesan.status', 6); 
    $this->db->where('pesan.stokis', $user_id);

    if ($id !== null) {
        $this->db->where('pesan.id_pesan', $id);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');

    $query = $this->db->get();
    return $query->result();
}

public function logistik_tl_sum_direk($user_id, $id = null) {
    $this->db->select('
        pesan.*, 
        user.name AS user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); // diasumsikan item diambil dari keranjang
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left'); // diasumsikan id_harga = barang_id

    $this->db->where('pesan.status', 6); 
    

    if ($id !== null) {
        $this->db->where('pesan.id_pesan', $id);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');

    $query = $this->db->get();
    return $query->result();
}



public function edit_pesan($data, $id){
  $this->db->where('id_pesan',$id);
  $this->db->update('pesan',$data);
}

public function total_transaksi($user_id, $id_pesan = null) {
    if ($id_pesan === null) {
        return null; // atau bisa lempar exception / error
    }

    $this->db->select('harg.nama_produk, keranjang.harga_total');
    $this->db->from('keranjang');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id');
    $this->db->where('keranjang.pesan_id', $id_pesan);
    $this->db->where('keranjang.user_id', $user_id); // validasi tambahan jika diperlukan

    $items = $this->db->get()->result();

    $nama_produk = [];
    $total_harga = 0;
    foreach ($items as $item) {
        $nama_produk[] = $item->nama_produk;
        $total_harga += (int) $item->harga_total;
    }

    return [
        'produk' => $nama_produk,
        'total' => $total_harga
    ];
}

public function get_data_by_date($start_date, $end_date, $user_id = null, $id = null)
{
  
    $this->db->select('
        pesan.*, 
        user.name AS nama_user, 
        stokis.nama_stokis AS stokis_nama, 
        item.nama_item AS nama_item, 
        status.status_nama AS statusnya, 
        keranjang.harga_total AS harga_item, 
        keranjang.jumlah AS jumlah, 
        harg.nama_produk AS nama_produk
    ');
    $this->db->from('pesan');
    $this->db->join('user', 'user.user_id = pesan.pemesan', 'left');
    $this->db->join('keranjang', 'keranjang.pesan_id = pesan.id_pesan', 'left');
    $this->db->join('stokis', 'stokis.id_stokis = pesan.stokis', 'left');
    $this->db->join('item', 'item.id_item = keranjang.barang_id', 'left'); 
    $this->db->join('status', 'status.id_status = pesan.status', 'left');
    $this->db->join('harg', 'harg.id_harga = keranjang.barang_id', 'left');

    $this->db->where('pesan.status', 2);

    if ($user_id !== null) {
        $this->db->where('pesan.stokis', $user_id);
    }

    if ($id !== null) {
        $this->db->where('pesan.id_pesan', $id);
    }

    // Filter tanggal
    if (!empty($start_date) && !empty($end_date)) {
        $this->db->where('pesan.tanggal >=', $start_date);
        $this->db->where('pesan.tanggal <=', $end_date);
    }

    $this->db->order_by('pesan.id_pesan', 'DESC');

    $query = $this->db->get();
    return $query->result();
}
public function count_total_stokis($user_id, $id = null) {
    $this->db->from('pesan');
    $this->db->where_in('pesan.status', [5]); 
    $this->db->where('pesan.stokis', $user_id);

    if ($id != null) {
        $this->db->where('pesan.id_pesan', $id);
    }

    return $this->db->count_all_results();
}

public function count_total_stokis_tl($user_id, $id = null) {
    $this->db->from('pesan');
    $this->db->where_in('pesan.status', [6]); 
    $this->db->where('pesan.stokis', $user_id);

    if ($id != null) {
        $this->db->where('pesan.id_pesan', $id);
    }

    return $this->db->count_all_results();
}
public function count_total_stokis_tl_b($user_id, $id = null) {
    $this->db->from('pesan');
    $this->db->where_in('pesan.status', [3]); 
    $this->db->where('pesan.stokis', $user_id);

    if ($id != null) {
        $this->db->where('pesan.id_pesan', $id);
    }

    return $this->db->count_all_results();
}

}