<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kemitraan_m extends CI_Model {

  
  public function get($id = null)
  {
          $this->db->select('user.*, stokis.nama_stokis as stokis_name, provinsi.provinsi as provinsi_name, level.level as level_nama,
          ket1.keterangan as keterangan, aktif.status as status');
          $this->db->from('user');
          $this->db->join('stokis', 'stokis.id_stokis = user.stokis','left');
          $this->db->join('provinsi', 'provinsi.id_prov = user.provinsi','left');
          $this->db->join('level', 'level.id_level = user.level','left');
          $this->db->join('aktif', 'aktif.id_aktif = user.aktif','left');
          $this->db->join('ket as ket1', 'ket1.id_ket = user.type', 'left'); // pembuat
          
          $this->db->where_in('user.level', [2]);
          if($id != null){
              $this->db->where('user_id', $id);
          }
          $this->db->order_by('user_id', 'asc');
          $query = $this->db->get();
          return $query;
  }

  public function get1($id = null)
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

public function jawa($id = null)
{
        $provinsi_id = $this->fungsi->user_login()->provinsi;

    $this->db->select('user.*, stokis.nama_stokis as stokis_name, provinsi.provinsi as provinsi_name, level.level as level_nama,
          ket1.keterangan as keterangan, aktif.status as status');
          $this->db->from('user');
          $this->db->join('stokis', 'stokis.id_stokis = user.stokis','left');
          $this->db->join('provinsi', 'provinsi.id_prov = user.provinsi','left');
          $this->db->join('level', 'level.id_level = user.level','left');
          $this->db->join('aktif', 'aktif.id_aktif = user.aktif','left');
          $this->db->join('ket as ket1', 'ket1.id_ket = user.type', 'left'); // pembuat

    if ($id !== null) {
        $this->db->where('user.user_id', $id);
    }

    
   if ($provinsi_id != null) {
        $this->db->where('user.provinsi', 1);
    }

    $this->db->order_by('user.user_id', 'asc');
    
    return $this->db->get();

}
public function sumatera($id = null)
{
       $provinsi_id = $this->fungsi->user_login()->provinsi;

    $this->db->select('user.*, stokis.nama_stokis as stokis_name, provinsi.provinsi as provinsi_name, level.level as level_nama,
          ket1.keterangan as keterangan, aktif.status as status');
          $this->db->from('user');
          $this->db->join('stokis', 'stokis.id_stokis = user.stokis','left');
          $this->db->join('provinsi', 'provinsi.id_prov = user.provinsi','left');
          $this->db->join('level', 'level.id_level = user.level','left');
          $this->db->join('aktif', 'aktif.id_aktif = user.aktif','left');
          $this->db->join('ket as ket1', 'ket1.id_ket = user.type', 'left'); // pembuat

    if ($id !== null) {
        $this->db->where('user.user_id', $id);
    }

    
   if ($provinsi_id != null) {
        $this->db->where('user.provinsi', 3);
    }

    $this->db->order_by('user.user_id', 'asc');
    
    return $this->db->get();

}

public function wita($id = null)
{
    $provinsi_id = $this->fungsi->user_login()->provinsi;

    $this->db->select('user.*, stokis.nama_stokis as stokis_name, provinsi.provinsi as provinsi_name, level.level as level_nama,
          ket1.keterangan as keterangan, aktif.status as status');
          $this->db->from('user');
          $this->db->join('stokis', 'stokis.id_stokis = user.stokis','left');
          $this->db->join('provinsi', 'provinsi.id_prov = user.provinsi','left');
          $this->db->join('level', 'level.id_level = user.level','left');
          $this->db->join('aktif', 'aktif.id_aktif = user.aktif','left');
          $this->db->join('ket as ket1', 'ket1.id_ket = user.type', 'left'); // pembuat

    if ($id !== null) {
        $this->db->where('user.user_id', $id);
    }

    
   if ($provinsi_id != null) {
        $this->db->where('user.provinsi', 7);
    }

    $this->db->order_by('user.user_id', 'asc');
    
    return $this->db->get();
}

  public function detail($id) {
    $this->db->select('user.*, stokis.nama_stokis as stokis_name, provinsi.provinsi as provinsi_name, level.level as level_nama,
          ket1.keterangan as keterangan, aktif.status as status');
          $this->db->from('user');
          $this->db->join('stokis', 'stokis.id_stokis = user.stokis','left');
          $this->db->join('provinsi', 'provinsi.id_prov = user.provinsi','left');
          $this->db->join('level', 'level.id_level = user.level','left');
          $this->db->join('aktif', 'aktif.id_aktif = user.aktif','left');
          $this->db->join('ket as ket1', 'ket1.id_ket = user.type', 'left'); // pembuat
    $this->db->where('user.user_id', $id);
            
  $query = $this->db->get(); 
  return $query->row();
            }

}