<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Controller {

	function __construct(){
		parent:: __construct();
		no();
		$this->load->model('unit_m');
		
	}

	public function index()
	{
		$data['row'] = $this->unit_m->get();
		$this->template->load('template','produk/unit/unit_data', $data);
	}

	public function del($id){
		$this->unit_m->del($id);
		if($this->db->affected_rows() > 0){
			echo "<script>
				alert('Data berhasil dihapus');
			</script>";
		}
		echo "<script>
			window.location = '".site_url('unit')."';</script>;
		</script>";
	}
	public function tambah(){
		$unit = new stdClass();
		$unit->unit_id = null;
		$unit->name = null;
		$data = array (
			'page' => 'add',
			'row' => $unit
		);
		$this->template->load('template','produk/unit/unit_form', $data);		
	}

	public function edit($id)
	{
		$query = $this->unit_m->get($id);
		if($query->num_rows() > 0) {
			$unit = $query->row();
			$data = array (
				'page' => 'edit',
				'row' => $unit
			);
			$this->template->load('template','produk/unit/unit_form', $data);
		} else{
			echo "<script>
					alert('Data tidak ditemukan');";
				echo "window.location = '".site_url('user')."';</script>";

		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])) {
			$this->unit_m->add($post);
		} else if(isset($_POST['edit'])) {
			$this->unit_m->edit($post);
		}

		if($this->db->affected_rows() > 0){
			echo "<script>
				alert('Data berhasil disimpan');
			</script>";
		}
		echo "<script>
			window.location = '".site_url('unit')."';</script>;
		</script>";
	}
}
