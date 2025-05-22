<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Item_m extends CI_Model {

  
public function get($id = null)
{
  $this->db->select('p_item.*, p_kategori.name as category_name, p_unit.name as unit_name');
  $this->db->from('p_item');
  $this->db->join('p_kategori', 'p_kategori.category_id = p_item.category_id');
  $this->db->join('p_unit', 'p_unit.unit_id = p_item.unit_id');
  if($id != null){
    $this->db->where('item_id', $id);
  }
  $this->db->order_by('barcode', 'asc');
  $query = $this->db->get();
  
    return $query;
}
public function del($id)
	{
		$this->db->where('item_id', $id);
		$this->db->delete('p_item');		
	}
public function add($post){
 $params = [
  'barcode' => $post['barcode_form'],
  'name' => $post['name_form'],
  'category_id' => $post['kategori1'],
  'unit_id' => $post['unit'],
  'price' => $post['harga_form'],
  'files' => $post['file_form'],
];
 $this->db->insert('p_item', $params);
}
public function edit($post){
  $params = [
    'barcode' => $post['barcode_form'],
    'name' => $post['name_form'],
    'category_id' => $post['kategori1'],
    'unit_id' => $post['unit'],
    'price' => $post['harga_form'],
   'updated' => date('Y-m-d H:i:s')
  ];
  if($post['file_form'] != null) {
    $params['files'] = $post['file_form'];
  }
  $this->db->where('item_id', $post['id']);
  $this->db->update('p_item', $params);
 }

function cek_barcode($code, $id = null){
  $this->db->from('p_item');
  $this->db->where('barcode', $code);
  if($id != null){
    $this->db->where('item_id !=', $id);
  }
  $query = $this->db->get();
  return $query;
}

}