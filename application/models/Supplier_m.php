<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_m extends CI_Model {

  
public function get($id = null)
{
  $this->db->from('supplier');
  if($id != null){
    $this->db->where('supplier_id', $id);
  }
  $query = $this->db->get();
    return $query;
}
public function del($id)
	{
		$this->db->where('supplier_id', $id);
		$this->db->delete('supplier');		
	}
public function add($post){
 $params = [
  'name' => $post['namasupplier_form'],
  'phone' => $post['nomor_form'],
  'alamat' => $post['alamats_form'],
  'deskripsi' => empty($post['deskripsi_form']) ? null : $post['deskripsi_form'],
  'updated' => date('Y-m-d H:i:s')
];
 $this->db->insert('supplier', $params);
}
public function edit($post){
  $params = [
   'name' => $post['namasupplier_form'],
   'phone' => $post['nomor_form'],
   'alamat' => $post['alamats_form'],
   'deskripsi' => empty($post['deskripsi_form']) ? null : $post['deskripsi_form'],
  ];
  $this->db->where('supplier_id', $post['id']);
  $this->db->update('supplier', $params);
 }
}