<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model {

  public function login($post)
{
    $this->db->where('kode', $post['kode']);
    $this->db->where('password', sha1($post['password']));
    $query = $this->db->get('user');

    if ($query->num_rows() > 0) {
        $user = $query->row();

        
        $this->db->where('user_id', $user->user_id);
        $this->db->update('user', ['last_login' => date('Y-m-d H:i:s')]);

        return $user;
    }

    return null;
}
  
public function login1($post)
{
    $this->db->where('username', $post['username']);
    $this->db->where('password', sha1($post['password']));
    $query = $this->db->get('users');

    if ($query->num_rows() > 0) {
        $user = $query->row();

        // Update last login
        $this->db->where('users_id', $user->users_id);
        $this->db->update('users', ['last_login' => date('Y-m-d H:i:s')]);

        return $user;
    }

    return null;
}


public function get($id = null)
{
        $this->db->select('user.*, stokis.nama_stokis as stokis_name, provinsi.provinsi as provinsi_name, level.level as level_nama');
        $this->db->from('user');
        $this->db->join('stokis', 'stokis.id_stokis = user.stokis');
        $this->db->join('provinsi', 'provinsi.id_prov = user.provinsi');
        $this->db->join('level', 'level.id_level = user.level');
        if($id != null){
            $this->db->where('user_id', $id);
        }
        $this->db->order_by('user_id', 'asc');
        $query = $this->db->get();
        return $query;
}

public function get2($id = null)
{
  $this->db->from('user'); // pastikan nama tabel benar
  if($id != null) {
      $this->db->where('user_id', $id); // pastikan 'user_id' sesuai dengan kolom
  }
  return $this->db->get();
}

public function add($post){
  $params['username'] = $post['user_form'];
  $params['name'] = $post['nama_form'];
  $params['password'] = sha1($post['password_form']);
  $params['address'] = $post['alamat_form'];
  $params['stokis'] = $post['alamat_form'];
  $params['provinsi'] = $post['provinsi_form'];
  $params['level'] = $post['level_form'];
  
  $this->db->insert('user', $params);
}
public function del($id)
	{
		$this->db->where('user_id', $id);
		$this->db->delete('user');		
	}
  public function edit($post){
    $params['username'] = $post['user_form'];
    $params['name'] = $post['nama_form'];
    if(!empty($post['password_form'])){
    $params['password'] = sha1($post['password_form']);
    }
    $params['address'] = $post['alamat_form'];
    $params['level'] = $post['level_form'];
    $params['stokis'] = $post['stokis_form'];
    $params['provinsi'] = $post['provinsi_form'];
    $this->db->where('user_id', $post['user_id']);
    $this->db->update('user', $params);
  } 
  public function getBarangById($id) {
    return $this->db->get_where('user', ['user_id' => $id])->row();
}
public function get_stokis()
{
    return $this->db->get_where('stokis')->result();
}
public function get_stokis1()
{
    return $this->db->get_where('user')->result();
}

public function get_level()
{
    return $this->db->get_where('level')->result();
}
public function get_provinsi()
{
    return $this->db->get_where('provinsi')->result();
}

public function add1($data){
  $this->db->insert('user',$data);
  }
  public function edit_user($data, $id){
    $this->db->where('user_id',$id);
    $this->db->update('user',$data);
  }
  public function detail($id) {
    $this->db->select('
        user.*, 
        stokis.nama_stokis as stokis_name, 
        provinsi.provinsi as provinsi_name,
        level.level as level_name,
    ');
    $this->db->from('user');
    $this->db->join('stokis', 'stokis.id_stokis = user.stokis');
    $this->db->join('provinsi', 'provinsi.id_prov = user.provinsi');
    $this->db->join('level', 'level.id_level = user.level');
    $this->db->where('user.user_id', $id);
  
    $query = $this->db->get();
    return $query->row();
  }
  public function edits($data, $id){
    $this->db->where('user_id',$id);
    $this->db->update('user',$data);
  }

  public function count_user($user_id) {
    return $this->db->count_all_results('user');
  }

  public function update_last_logout($user_id)
{
    $this->db->where('user_id', $user_id);
    return $this->db->update('user', ['buat' => date('Y-m-d H:i:s')]);
}
public function count_user_stokis_jawa($user_id) {
  $this->db->where_in('user.provinsi', [1]);
  $this->db->where_in('user.level', [1]);
  return $this->db->count_all_results('user');
}
public function count_user_mitra_jawa($user_id) {
  $this->db->where_in('user.provinsi', [1]);
  $this->db->where_in('user.level', [2]);
  return $this->db->count_all_results('user');
}
public function count_user_mitra_sumatera($user_id) {
  $this->db->where_in('user.provinsi', [3]);
  $this->db->where_in('user.level', [2]);
  return $this->db->count_all_results('user');
}
public function count_user_mitra_all($user_id) {
  $this->db->where_in('user.provinsi', [1,3,7]);
  $this->db->where_in('user.level', [2]);
  return $this->db->count_all_results('user');
}
public function count_user_stokis_sumatera($user_id) {
  $this->db->where_in('user.provinsi', [3]);
  $this->db->where_in('user.level', [1]);
  return $this->db->count_all_results('user');
}
public function count_user_mitra_wita($user_id) {
  
  $this->db->where_in('user.provinsi', [7]);
  $this->db->where_in('user.level', [2]);
  return $this->db->count_all_results('user');
}
public function count_user_stokis_wita($user_id) {
  $this->db->where_in('user.provinsi', [7]);
  $this->db->where_in('user.level', [1]);
  return $this->db->count_all_results('user');
}

public function get_paginated_users($limit, $offset, $keyword = null)
{
  $this->db->select('user.*, stokis.nama_stokis as stokis_name, provinsi.provinsi as provinsi_name, level.level as level_nama');
        $this->db->from('user');
        $this->db->join('stokis', 'stokis.id_stokis = user.stokis');
        $this->db->join('provinsi', 'provinsi.id_prov = user.provinsi');
        $this->db->join('level', 'level.id_level = user.level');
        if($id != null){
            $this->db->where('user_id', $id);
        }
        $this->db->order_by('user_id', 'asc');
        $query = $this->db->get();
        return $query;
    if ($keyword) {
        $this->db->like('username', $keyword);
        $this->db->or_like('name', $keyword);
        
    }
    $this->db->limit($limit, $offset);
    return $this->db->get('user');
}

public function count_users($keyword = null)
{
    if ($keyword) {
        $this->db->like('username', $keyword);
        $this->db->or_like('name', $keyword);
    }
    return $this->db->get('user')->num_rows();
}
public function get_total_user()
{
    return $this->db->count_all('user');
}

}