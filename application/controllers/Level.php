<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// Untuk memanggil model
class Level extends CI_Controller {
    
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
// Untuk dashboard level
	public function index()
	{
		$user_id = $this->fungsi->user_login()->provinsi;
		$data['row'] = $this->provinsi_m->get_level();
		$this->template->load('template','level/level_data', $data);
	}
	// Untuk tambah level
	public function tambah(){
		$data['level'] = $this->user_m->get_level();
		$this->template->load('template', 'level/level_tambah',$data);
	
}
// Untuk memasukan datanya
public function input() {
    
    $level = $this->input->post('level');

    $stokis_data = array(
        'level' => $level
    );

        $this->provinsi_m->add_level($stokis_data);
    
    $this->session->set_flashdata('success', 'Data berhasil diinput.');
    redirect(base_url('level'));
}
// Untuk mennuju halaman edit
public function ed($id)
	{
		$level = $this->provinsi_m->detail_level($id);
		
		$data = array(

			'level' => $level
		);
	
		$this->template->load('template', 'level/level_edit', $data);
	}
// Untuk menyimpan data yang diedit
    public function editin()
	{
		$id_level = $this->input->post('id_level');
		$level = $this->input->post('level');
	
		$dataupdate = array(

			'level' => $level,
		);
        $this->provinsi_m->edits_level($dataupdate, $id_level);
		$this->session->set_flashdata('success', 'Data berhasil diubah.');
		redirect(base_url('level'));
    }
// Untuk delete data
    public function del()
	{
		$id = $this->input->post('id_level');
		$this->provinsi_m->del_level($id);
		if($this->db->affected_rows() > 0){
			echo "<script>
				alert('Data berhasil dihapus');
			</script>";
		}
		echo "<script>
			window.location = '".site_url('level')."';</script>;
		</script>";
	
	}
}