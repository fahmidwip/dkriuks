<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cust extends CI_Controller {

	function __construct(){
		parent:: __construct();
		no();
		$this->load->model('cust_m');
		
	}

	public function index()
	{
		$data['row'] = $this->cust_m->get();
		$this->template->load('template','customer/customer_data', $data);
	}

	public function del($id){
		$this->cust_m->del($id);
		if($this->db->affected_rows() > 0){
			echo "<script>
				alert('Data berhasil dihapus');
			</script>";
		}
		echo "<script>
			window.location = '".site_url('cust')."';</script>;
		</script>";
	}
	public function tambah(){
		$customer = new stdClass();
		$customer->cust_id = null;
		$customer->name = null;
		$customer->phone = null;
		$customer->alamat = null;
		$customer->gender = null;
		$data = array (
			'page' => 'add',
			'row' => $customer
		);
		$this->template->load('template','customer/customer_form', $data);		
	}

	public function edit($id)
	{
		$query = $this->cust_m->get($id);
		if($query->num_rows() > 0) {
			$customer = $query->row();
			$data = array (
				'page' => 'edit',
				'row' => $customer
			);
			$this->template->load('template','customer/customer_form', $data);
		} else{
			echo "<script>
					alert('Data tidak ditemukan');";
				echo "window.location = '".site_url('cust')."';</script>";

		}
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])) {
			$this->cust_m->add($post);
		} else if(isset($_POST['edit'])) {
			$this->cust_m->edit($post);
		}

		if($this->db->affected_rows() > 0){
			echo "<script>
				alert('Data berhasil disimpan');
			</script>";
		}
		echo "<script>
			window.location = '".site_url('cust')."';</script>;
		</script>";
	}
}
