<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sifat_m extends CI_Model {

  
public function get($id = null)
{
  $this->db->from('sifat');
  if($id != null){
    $this->db->where('id_sifat', $id);
  }
  $query = $this->db->get();
    return $query;
}
public function del($id)
	{
		$this->db->where('id_sifat', $id);
		$this->db->delete('sifat');		
	}
public function add($post){
 $params = [
  'sifat' => $post['sifat'],
];
 $this->db->insert('sifat', $params);
}
public function edit($post){
  $params = [
   'sifat' => $post['sifat'],
   
  ];
  $this->db->where('id_sifat', $post['id']);
  $this->db->update('sifat', $params);
 }
}