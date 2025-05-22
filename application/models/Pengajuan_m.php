<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_m extends CI_Model {
    
  public function get($id = null)
  {
      $this->db->select('pengajua.*, sifat.sifat as sifat_name, status.status as status_name, user.username as username');
      $this->db->from('pengajua');
      $this->db->join('sifat', 'sifat.id_sifat = pengajua.sifat', 'left');
      $this->db->join('user', 'user.user_id = pengajua.pembuat', 'left');
      $this->db->join('status', 'status.id_status = pengajua.status', 'left');
  
      if($id != null){
          $this->db->where('id_aju', $id);
      }
  
      $this->db->order_by('id_aju', 'asc');
      $query = $this->db->get();
      return $query;
  }
    public function add($data){
$this->db->insert('pengajua',$data);
}
public function edit($data, $id){
  $this->db->where('id_aju',$id);
  $this->db->update('pengajua',$data);
}
public function detail($id) {
  $this->db->select('
      pengajua.*, 
      sifat.sifat AS sifat_name, 
      status.status AS status_name, 
      user.username AS username
  ');
  $this->db->from('pengajua');
  
  $this->db->join('sifat', 'sifat.id_sifat = pengajua.sifat');
  $this->db->join('user', 'user.user_id = pengajua.pembuat');
  $this->db->join('status', 'status.id_status = pengajua.status');
  $this->db->where('pengajua.id_aju', $id);

  $query = $this->db->get(); // cukup get() tanpa parameter karena FROM sudah didefinisikan
  return $query->row();
}
public function delete($id){
  $this->db->where('id_aju',$id);
  $this->db->delete('pengajua');
}
public function count_new_pengajuan($user_id) {
  $this->db->where('status', 1); // Ubah kondisi sesuai kebutuhan
  $this->db->where('pembuat', $user_id); // Ubah kondisi sesuai kebutuhan
  return $this->db->count_all_results('pengajua'); // Gantilah 'pengajuan' dengan nama tabel yang benar
}
public function aju_user($user_id, $id = null) {
  $this->db->select('
      pengajua.*, 
      sifat.sifat as sifat_name, 
      status.status as status_name, 
      user1.username as username, 
      user1.level as pembuat_level, 
      user2.username as spv_username, 
      user2.username as username_status, 
      user3.username as manager_username, 
      user3.level as manager_level, 
      user4.username as direktur_username, 
      user4.level as direktur_level, 
      user5.address as divisi, 
      user5.address as posisi_level
  ');
  
  $this->db->from('pengajua');
  $this->db->join('sifat', 'sifat.id_sifat = pengajua.sifat', 'left');
  $this->db->join('user as user1', 'user1.user_id = pengajua.pembuat', 'left'); // pembuat
  $this->db->join('user as user2', 'user2.user_id = pengajua.spv', 'left');     // spv
  $this->db->join('user as user3', 'user3.user_id = pengajua.manager', 'left');
  $this->db->join('user as user4', 'user4.user_id = pengajua.direktur', 'left');
  $this->db->join('user as user5', 'user5.user_id = pengajua.pembuat', 'left'); // untuk address
  $this->db->join('status', 'status.id_status = pengajua.status', 'left');

  // Filter berdasarkan user_id pembuat
  $this->db->where('pengajua.pembuat', $user_id);

  // Filter berdasarkan id_aju jika ada
  if ($id != null) {
      $this->db->where('pengajua.id_aju', $id);
  }

  $this->db->order_by('pengajua.id_aju', 'asc');

  $query = $this->db->get();
  return $query->result(); // hasil sebagai array objek
}


public function aju_spv($user_id, $id = null) { 
  $this->db->select('pengajua.*, sifat.sifat as sifat_name, status.status as status_name, 
                     user1.username as username, user1.level as pembuat_level, 
                     user2.username as spv_username, user2.level as spv_level,
                     user3.username as manager_username, user3.level as manager_level, 
                     user4.username as direktur_username, user4.level as direktur_level,
                     user5.address as divisi, user5.address as posisi_level');
  $this->db->from('pengajua');

  $this->db->join('sifat', 'sifat.id_sifat = pengajua.sifat', 'left');
  $this->db->join('user as user1', 'user1.user_id = pengajua.pembuat', 'left'); // pembuat
  $this->db->join('user as user2', 'user2.user_id = pengajua.spv', 'left');     // spv
  $this->db->join('user as user3', 'user3.user_id = pengajua.manager', 'left'); // manager
  $this->db->join('user as user4', 'user4.user_id = pengajua.direktur', 'left'); // direktur
  $this->db->join('user as user5', 'user5.user_id = pengajua.pembuat', 'left'); // untuk alamat/posisi
  $this->db->join('status', 'status.id_status = pengajua.status', 'left');

  // Filter berdasarkan status dan spv
  $this->db->where_in('pengajua.status', [2, 3, 4, 5, 6]); 
  $this->db->where('pengajua.spv', $user_id);

  // Jika id diterima, tambahkan kondisi untuk filter id_aju
  if ($id != null) {
      $this->db->where('pengajua.id_aju', $id);
  }

  $this->db->order_by('pengajua.id_aju', 'asc');

  $query = $this->db->get();
  return $query->result(); 
}


public function aju_ga($user_id, $id = null) { 
  $this->db->select('pengajua.*, sifat.sifat as sifat_name, status.status as status_name, 
                     user1.username as username, user1.level as pembuat_level, 
                     user2.username as spv_username, user2.level as spv_level,
                     user3.username as manager_username, user3.level as manager_level, 
                     user4.username as direktur_username, user4.level as direktur_level,
                     user5.address as divisi, user5.address as posisi_level');
  $this->db->from('pengajua');

  $this->db->join('sifat', 'sifat.id_sifat = pengajua.sifat', 'left');
  $this->db->join('user as user1', 'user1.user_id = pengajua.pembuat', 'left'); // pembuat
  $this->db->join('user as user2', 'user2.user_id = pengajua.spv', 'left');     // spv
  $this->db->join('user as user3', 'user3.user_id = pengajua.manager', 'left'); // manager
  $this->db->join('user as user4', 'user4.user_id = pengajua.direktur', 'left'); // direktur
  $this->db->join('user as user5', 'user5.user_id = pengajua.pembuat', 'left'); // untuk alamat/posisi
  $this->db->join('status', 'status.id_status = pengajua.status', 'left');

  // Filter berdasarkan status dan spv
  $this->db->where_in('pengajua.status', [3, 4, 5, 6]); 
  $this->db->where('pengajua.manager', $user_id);

  // Jika id diterima, tambahkan kondisi untuk filter id_aju
  if ($id != null) {
      $this->db->where('pengajua.id_aju', $id);
  }

  $this->db->order_by('pengajua.id_aju', 'asc');

  $query = $this->db->get();
  return $query->result(); 
}

public function aju_direktur($user_id, $id = null) { 
  $this->db->select('pengajua.*, sifat.sifat as sifat_name, status.status as status_name, 
                     user1.username as username, user1.level as pembuat_level, 
                     user2.username as spv_username, user2.level as spv_level,
                     user3.username as manager_username, user3.level as manager_level, 
                     user4.username as direktur_username, user4.level as direktur_level,
                     user5.address as divisi, user5.address as posisi_level');
  $this->db->from('pengajua');

  $this->db->join('sifat', 'sifat.id_sifat = pengajua.sifat', 'left');
  $this->db->join('user as user1', 'user1.user_id = pengajua.pembuat', 'left'); // pembuat
  $this->db->join('user as user2', 'user2.user_id = pengajua.spv', 'left');     // spv
  $this->db->join('user as user3', 'user3.user_id = pengajua.manager', 'left'); // manager
  $this->db->join('user as user4', 'user4.user_id = pengajua.direktur', 'left'); // direktur
  $this->db->join('user as user5', 'user5.user_id = pengajua.pembuat', 'left'); // untuk alamat/posisi
  $this->db->join('status', 'status.id_status = pengajua.status', 'left');

  // Filter berdasarkan status dan spv
  $this->db->where_in('pengajua.status', [4, 5, 6]); 
  $this->db->where('pengajua.direktur', $user_id);

  // Jika id diterima, tambahkan kondisi untuk filter id_aju
  if ($id != null) {
      $this->db->where('pengajua.id_aju', $id);
  }
  $this->db->order_by('pengajua.id_aju', 'asc');

  $query = $this->db->get();
  return $query->result(); 
}

public function count_new_pengajuan_spv($user_id) {
  $this->db->where_in('pengajua.status', [2, 3, 4, 5, 6]); // status yang dimaksud mungkin pada tabel pengajua
  $this->db->where('pengajua.spv', $user_id); // Ubah kondisi sesuai kebutuhan
  return $this->db->count_all_results('pengajua'); // Gantilah 'pengajuan' dengan nama tabel yang benar
}
public function count_new_pengajuan_staff($user_id) {
  $this->db->where_in('pengajua.status', [1, 2, 3, 4, 5, 6]);
  $this->db->where('pembuat', $user_id);
  return $this->db->count_all_results('pengajua');
}
public function count_new_pengajuan_ga($user_id) {
  $this->db->where_in('pengajua.status', [3, 4, 5, 6]); 
  $this->db->where('pengajua.manager', $user_id); 
  return $this->db->count_all_results('pengajua'); 
}
public function count_new_pengajuan_direktur($user_id) {
  $this->db->where_in('pengajua.status', [4, 5, 6]); 
  $this->db->where('pengajua.direktur', $user_id); 
  return $this->db->count_all_results('pengajua'); 
}
}