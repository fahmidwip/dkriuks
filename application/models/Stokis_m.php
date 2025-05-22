<?php defined('BASEPATH') OR exit('No direct script access allowed');

class stokis_m extends CI_Model {

  
  public function get($id = null)
  {
          $this->db->select('stokis.*, provinsi.provinsi as provinsi_name');
          $this->db->from('stokis');
          $this->db->join('provinsi', 'provinsi.id_prov = stokis.provinsi');
          if($id != null){
              $this->db->where('id_stokis', $id);
          }
          $this->db->order_by('id_stokis', 'asc');
          $query = $this->db->get();
          return $query;
  }
public function del($id)
	{
		$this->db->where('id_stokis', $id);
		$this->db->delete('stokis');		
	}
  public function add($data){
    $this->db->insert('stokis',$data);
    }
public function edit($post){
  $params = [
   'divisi' => $post['divisi'],
   'updated' => date('Y-m-d H:i:s')
  ];
  $this->db->where('id_divisi', $post['id']);
  $this->db->update('divisi', $params);
 }
 public function detail($id) {
  $this->db->select('
      stokis.*,  
      provinsi.provinsi as provinsi_name,
  ');
  $this->db->from('stokis');
  $this->db->join('provinsi', 'provinsi.id_prov = stokis.provinsi');
  $this->db->where('stokis.id_stokis', $id);

  $query = $this->db->get();
  return $query->row();
}

public function edits($data, $id){
  $this->db->where('id_stokis',$id);
  $this->db->update('stokis',$data);
}

}