<?php defined('BASEPATH') OR exit('No direct script access allowed');

class provinsi_m extends CI_Model {

  
  public function get($id = null)
  {
    $this->db->from('provinsi');
    if($id != null){
      $this->db->where('id_prov', $id);
    }
    $query = $this->db->get();
      return $query;
  }

  public function get_level($id = null)
  {
    $this->db->from('level');
    if($id != null){
      $this->db->where('id_level', $id);
    }
    $query = $this->db->get();
      return $query;
  }
public function del($id)
	{
		$this->db->where('id_prov', $id);
		$this->db->delete('provinsi');		
	}

  public function del_level($id)
	{
		$this->db->where('id_level', $id);
		$this->db->delete('level');		
	}
  public function add($data){
    $this->db->insert('provinsi',$data);
    }

    public function add_level($data){
      $this->db->insert('level',$data);
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
      provinsi.*,  
  ');
  $this->db->from('provinsi');
  $this->db->where('provinsi.id_prov', $id);

  $query = $this->db->get();
  return $query->row();
}

public function detail_level($id) {
  $this->db->select('
      level.*,  
  ');
  $this->db->from('level');
  $this->db->where('level.id_level', $id);

  $query = $this->db->get();
  return $query->row();
}

public function edits($data, $id){
  $this->db->where('id_prov',$id);
  $this->db->update('provinsi',$data);
}

public function edits_level($data, $id){
  $this->db->where('id_level',$id);
  $this->db->update('level',$data);
}

}