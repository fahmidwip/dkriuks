<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rapat_m extends CI_Model {

  
public function get($id = null)
{
  $this->db->from('books');
  if($id != null){
    $this->db->where('id_book', $id);
  }
  $query = $this->db->get();
    return $query;
}
public function del($id)
	{
		$this->db->where('id_book', $id);
		$this->db->delete('books');		
	}
public function add($post){
  $params['ruang_rapat'] = $post['ruang_rapat'];
  $params['mulai'] = $post['mulai'];
  $params['durasi'] = $post['durasi'];
  $params['tanggal_acara'] = $post['tanggal'];
  $params['perihal'] = $post['perihal'];
  $this->db->insert('books', $params);
}
public function edit($post){
    $params['username'] = $post['user_form'];
    $params['name'] = $post['nama_form'];
  $this->db->where('id_book', $post['id']);
  $this->db->update('books', $params);
 }
}