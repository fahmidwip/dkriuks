<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	function __construct(){
		parent:: __construct();
		no();
		$this->load->model('kategori_m');
		
	}

	public function index()
	{
		$data['row'] = $this->kategori_m->get();
		$this->template->load('template','produk/kategori/kategori_data', $data);
	}

	public function del($id){
		$this->kategori_m->del($id);
		if($this->db->affected_rows() > 0){
			echo "<script>
				alert('Data berhasil dihapus');
			</script>";
		}
		echo "<script>
			window.location = '".site_url('kategori')."';</script>;
		</script>";
	}
	public function tambah(){
		$kategori = new stdClass();
		$kategori->category_id = null;
		$kategori->name = null;
		$data = array (
			'page' => 'add',
			'row' => $kategori
		);
		$this->template->load('template','produk/kategori/kategori_form', $data);		
	}

	public function edit($id)
	{
		$query = $this->kategori_m->get($id);
		if($query->num_rows() > 0) {
			$kategori = $query->row();
			$data = array (
				'page' => 'edit',
				'row' => $kategori
			);
			$this->template->load('template','produk/kategori/kategori_form', $data);
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
			$this->kategori_m->add($post);
		} else if(isset($_POST['edit'])) {
			$this->kategori_m->edit($post);
		}

		if($this->db->affected_rows() > 0){
			echo "<script>
				alert('Data berhasil disimpan');
			</script>";
		}
		echo "<script>
			window.location = '".site_url('kategori')."';</script>;
		</script>";
	}
}
