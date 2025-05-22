<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('harga_m');
        $this->load->model('user_m');
        $this->load->model('stokis_m');
		$this->load->model('provinsi_m');
        $this->load->library('form_validation');
		no();
		check_admin();
    }

	public function index()
	{
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->provinsi_m->get();
		$this->template->load('template','provinsi/provinsi_data', $data);
	}
	public function tambah(){
		$data['provinsi'] = $this->user_m->get_provinsi();
		$this->template->load('template', 'provinsi/provinsi_tambah',$data);
	
}
public function input() {
    
    $provinsi = $this->input->post('provinsi');

    $stokis_data = array(
        'provinsi' => $provinsi
    );

        $this->provinsi_m->add($stokis_data);
    
    $this->session->set_flashdata('success', 'Data berhasil diinput.');
    redirect(base_url('provinsi'));
}

public function ed($id)
	{
		$provinsi = $this->provinsi_m->detail($id);
		
		$data = array(

			'provinsi' => $provinsi
		);
	
		$this->template->load('template', 'provinsi/provinsi_edit', $data);
	}

    public function editin()
	{
		$id_prov = $this->input->post('id_prov');
		$provinsi = $this->input->post('provinsi');
	
		$dataupdate = array(

			'provinsi' => $provinsi,
		);
        $this->provinsi_m->edits($dataupdate, $id_prov);
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(base_url('provinsi'));
    }

    public function del()
	{
		$id = $this->input->post('id_prov');
		$this->provinsi_m->del($id);
		if($this->db->affected_rows() > 0){
			echo "<script>
				alert('Data berhasil dihapus');
			</script>";
		}
		echo "<script>
			window.location = '".site_url('provinsi')."';</script>;
		</script>";
	
	}
}