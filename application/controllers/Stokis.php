<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stokis extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('harga_m');
        $this->load->model('user_m');
        $this->load->model('stokis_m');
        $this->load->library('form_validation');
		no();
		check_admin();
    }

	public function index()
	{
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->stokis_m->get();
		$this->template->load('template','stokis/stokis_data', $data);
	}

    public function index_b()
	{
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->harga_m->get1();
		$this->template->load('template','harga/harga_data_baru', $data);
	}

	public function tambah(){
		$data['provinsi'] = $this->user_m->get_provinsi();
		$this->template->load('template', 'stokis/stokis_tambah',$data);
	
}
public function input() {
    
    $nama_stokis = $this->input->post('nama_stokis');
	$alamat = $this->input->post('alamat'); 
    $provinsi = $this->input->post('provinsi');

    $stokis_data = array(
        'nama_stokis' => $nama_stokis,
        'alamat' => $alamat,
        'provinsi' => $provinsi
    );

        $this->stokis_m->add($stokis_data);
    
    $this->session->set_flashdata('success', 'Data berhasil diinput.');
    redirect(base_url('stokis'));
}

public function ed($id)
	{
		$stokis = $this->stokis_m->detail($id);
		$level = $this->user_m->get_level($id);
		$provinsi = $this->user_m->get_provinsi($id);
	
		$data = array(
			'row' => $stokis,
			'stokis' => $stokis,
			'level' => $level,
			'provinsi' => $provinsi
		);
	
		$this->template->load('template', 'stokis/stokis_edit', $data);
	}

    public function editin()
	{
		$id_stokis = $this->input->post('id_stokis');
		$nama_stokis = $this->input->post('nama_stokis');
	    $alamat = $this->input->post('alamat'); 
        $provinsi = $this->input->post('provinsi');
	
		$dataupdate = array(
			'nama_stokis' => $nama_stokis,
			'alamat' => $alamat,
			'provinsi' => $provinsi,
		);
        $this->stokis_m->edits($dataupdate, $id_stokis);
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(base_url('stokis'));
    }

    public function del()
	{
		$id = $this->input->post('id_stokis');
		$this->stokis_m->del($id);
		if($this->db->affected_rows() > 0){
			echo "<script>
				alert('Data berhasil dihapus');
			</script>";
		}
		echo "<script>
			window.location = '".site_url('stokis')."';</script>;
		</script>";
	
	}
}