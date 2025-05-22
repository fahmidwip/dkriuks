<?php defined('BASEPATH') OR exit('No direct script access allowed');

class cust_m extends CI_Model {

  
public function get($id = null)
{
  $this->db->from('customer');
  if($id != null){
    $this->db->where('cust_id', $id);
  }
  $query = $this->db->get();
    return $query;
}
public function del($id)
	{
		$this->db->where('cust_id', $id);
		$this->db->delete('customer');		
	}
public function add($post){
 $params = [
  'name' => $post['namacustomer_form'],
  'phone' => $post['nomor_form'],
  'gender' => $post['gender_form'],
  'alamat' => $post['alamats_form'],
  
];
 $this->db->insert('customer', $params);
}
public function edit($post){
  $params = [
    'name' => $post['namacustomer_form'],
    'phone' => $post['nomor_form'],
    'gender' => $post['gender_form'],
    'alamat' => $post['alamats_form'],
   'updated' => date('Y-m-d H:i:s')
  ];
  $this->db->where('cust_id', $post['id']);
  $this->db->update('customer', $params);
 }
}