<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_m extends CI_Model {

  
public function get($id = null)
{
  $this->db->from('p_kategori');
  if($id != null){
    $this->db->where('category_id', $id);
  }
  $query = $this->db->get();
    return $query;
}
public function del($id)
	{
		$this->db->where('category_id', $id);
		$this->db->delete('p_kategori');		
	}
public function add($post){
 $params = [
  'name' => $post['namakate_form'],
];
 $this->db->insert('p_kategori', $params);
}
public function edit($post){
  $params = [
   'name' => $post['namakate_form'],
   'updated' => date('Y-m-d H:i:s')
  ];
  $this->db->where('category_id', $post['id']);
  $this->db->update('p_kategori', $params);
 }
}