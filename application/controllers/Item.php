<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	function __construct(){
		parent:: __construct();
		no();
		$this->load->model(['item_m', 'kategori_m', 'unit_m']);
		
	}

	public function index()
	{
		$data['row'] = $this->item_m->get();
		$this->template->load('template','produk/item/item_data', $data);
	}

	public function del($id){


		$item = $this->item_m->get($id)->row();
					if($item->files != null) {
						$target_file = './file/'.$item->files;
						unlink($target_file);
					}
		$this->item_m->del($id);
		if($this->db->affected_rows() > 0){
			echo "<script>
				alert('Data berhasil dihapus');
			</script>";
		}
		echo "<script>
			window.location = '".site_url('item')."';</script>;
		</script>";
	} 
	public function tambah(){
		$item = new stdClass();
		$item->item_id = null;
		$item->barcode = null;
		$item->name = null;
		$item->price = null;
		$item->category_id = null;
		

		
		$kategori = $this->kategori_m->get();

		$query_unit = $this->unit_m->get();
		$unit[null] = '== Pilih ==';
		foreach($query_unit->result() as $unt) {
			$unit[$unt->unit_id] = $unt->name;
		}

		$data = array (
			'page' => 'add',
			'row' => $item,
			'kategori' => $kategori,
			'unit' => $unit, 'selectedunit' =>null,
		);
		$this->template->load('template','produk/item/item_form', $data);		
	}

	public function edit($id)
	{
		$query = $this->item_m->get($id);
		if($query->num_rows() > 0) {
			$item = $query->row();
			$kategori = $this->kategori_m->get();

		$query_unit = $this->unit_m->get();
		$unit[null] = '== Pilih ==';
		foreach($query_unit->result() as $unt) {
			$unit[$unt->unit_id] = $unt->name;
		}

		$data = array (
			'page' => 'edit',
			'row' => $item,
			'kategori' => $kategori,
			'unit' => $unit, 'selectedunit' => $item->unit_id,
		);
		$this->template->load('template','produk/item/item_form', $data);
		
		} else{
			echo "<script>
					alert('Data tidak ditemukan');";
				echo "window.location = '".site_url('item')."';</script>";

		}
	}

	public function process()
	{
		$config['upload_path'] 		= './file/';
		$config['allowed_types'] 	= 'gif|jpg|png|xls|xlsx|doc|docx';
		$config['max_size'] 		= 2048;
		$config['file_name'] 		= 'item-'.date('ymd').'-'.substr(md5(rand()),0,10);
		$this->load->library('upload', $config);
		$post = $this->input->post(null, TRUE);
		if(isset($_POST['add'])) {
			if($this->item_m->cek_barcode($post['barcode_form'])->num_rows > 0){
				echo "<script>
				alert('Barcode sudah di pakai');
			</script>";
			redirect('item/add');
			} else{
				if(@$_FILES['file_form']['name'] != null) {
				if($this->upload->do_upload('file_form')){
					$post['file_form'] = $this->upload->data('file_name');
					$this->item_m->add($post);
					if($this->db->affected_rows() > 0){
						echo "<script>
							alert('Data berhasil disimpan');
						</script>";
					}
					echo "<script>
						window.location = '".site_url('item')."';</script>;
					</script>";
				} else{
					echo "<script>
							alert('Eror');
						</script>";
						echo "<script>
						window.location = '".site_url('item')."';</script>;
					</script>";
					
				}	
				} else {
					$post['file_form'] = null;
					$this->item_m->add($post);
					if($this->db->affected_rows() > 0){
						echo "<script>
							alert('Data berhasil disimpan');
						</script>";
					}
					echo "<script>
						window.location = '".site_url('item')."';</script>;
					</script>";
				}
				
			}	
		} else if(isset($_POST['edit'])) {
			if(@$_FILES['file_form']['name'] != null) {
				if($this->upload->do_upload('file_form')){

					$item = $this->item_m->get($post['id'])->row();
					if($item->files != null) {
						$target_file = './file/'.$item->files;
						unlink($target_file);
					}

					$post['file_form'] = $this->upload->data('file_name');
					$this->item_m->edit($post);
					if($this->db->affected_rows() > 0){
						echo "<script>
							alert('Data berhasil disimpan');
						</script>";
					}
					echo "<script>
						window.location = '".site_url('item')."';</script>;
					</script>";
				} else{
					echo "<script>
							alert('Eror');
						</script>";
						echo "<script>
						window.location = '".site_url('item')."';</script>;
					</script>";
					
				}	
				} else {
					$post['file_form'] = null;
					$this->item_m->edit($post);
					if($this->db->affected_rows() > 0){
						echo "<script>
							alert('Data berhasil disimpan');
						</script>";
					}
					echo "<script>
						window.location = '".site_url('item')."';</script>;
					</script>";
				}
			
		}
	}
	function barcode_qr($id) {
		$data['row'] = $this->item_m->get($id)->row();
		$this->template->load('template','produk/item/barcode_qrd', $data);		
	}
	
	
}
