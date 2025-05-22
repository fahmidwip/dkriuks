<?php defined('BASEPATH') OR exit('No direct script access allowed');

class divisi_m extends CI_Model {

  
public function get($id = null)
{
  $this->db->from('divisi');
  if($id != null){
    $this->db->where('id_divisi', $id);
  }
  $query = $this->db->get();
    return $query;
}
public function del($id)
	{
		$this->db->where('id_divisi', $id);
		$this->db->delete('divisi');		
	}
public function add($post){
 $params = [
  'divisi' => $post['divisi'],
];
 $this->db->insert('divisi', $params);
}
public function edit($post){
  $params = [
   'divisi' => $post['divisi'],
   'updated' => date('Y-m-d H:i:s')
  ];
  $this->db->where('id_divisi', $post['id']);
  $this->db->update('divisi', $params);
 }
}