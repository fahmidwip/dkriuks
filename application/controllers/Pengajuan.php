<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('pengajuan_m');
        $this->load->model('divisi_m');
        $this->load->model('sifat_m');
        $this->load->library('form_validation');
		no();
    }

	public function index()
	{
		$user_id = $this->fungsi->user_login()->user_id;
		$data['row'] = $this->pengajuan_m->get();
		$data['aju_user'] = $this->pengajuan_m->aju_user($user_id);
		$this->template->load('template','pengajuan/pengajuan_data', $data);
	}

	public function tambah(){
		
			$this->template->load('template', 'pengajuan/pengajuan_tambah');
		
	}
	public function kr($id){
	$aju=$this->pengajuan_m->detail($id);
	$data = array('ajuan' => $aju);
	$this->template->load('template', 'pengajuan/pengajuan_edit',$data);

}
public function input(){
	$perihal = $this->input->post('perihal');
	
	$sifat = $this->input->post('sifat');
	$status = 1;
	$pembuat = $this->input->post('pembuat');
	$spv = $this->input->post('spv');

	$tanggal = date('Y-m-d H:i:s');
	$tgl_buat = date('Y-m-d H:i:s');

	$data = array (
		'perihal' => $perihal,
        'sifat' => $sifat,
        'status' => $status,
        'pembuat' => $pembuat,
		'spv' => $spv,
        'tanggal' => $tanggal,
		'tgl_buat' => $tgl_buat
    );
$this->pengajuan_m->add($data);
$this->session->set_flashdata('successs', 'Data berhasil diinput.');
redirect(base_url('pengajuan'));
}

public function editin(){
	$id_aju = $this->input->post('id_aju');
	$perihal = $this->input->post('perihal');
	$sifat = $this->input->post('sifat');
	$status = 2;
	$pembuat = $this->input->post('pembuat');
	$spv = $this->input->post('spv');
	$tanggal = date('Y-m-d H:i:s');

	$dataupdate = array (
		'perihal' => $perihal,
        'sifat' => $sifat,
        'status' => $status,
		'spv' => $spv,
        'tanggal' => $tanggal
    );
	$this->pengajuan_m->edit($dataupdate,$id_aju);
	$this->session->set_flashdata('success', 'Data berhasil dikirim.');
	redirect(base_url('pengajuan'));
}
public function del($id){
	$this->pengajuan_m->delete($id);
	$this->session->set_flashdata('danger', 'Data berhasil dihapus.');
	redirect(base_url('pengajuan'));
}

public function spv()
	{
		$user_id = $this->fungsi->user_login()->user_id;
		$data['row'] = $this->pengajuan_m->get();
		$data['aju_spv'] = $this->pengajuan_m->aju_spv($user_id);
		$this->template->load('template','pengajuan/pengajuan_data_spv', $data);
	}
	public function tambah_spv(){
		$this->template->load('template', 'pengajuan/pengajuan_tambah_spv');	
		}
		
		public function kr_spv($id){
		$aju=$this->pengajuan_m->detail($id);
		$data = array('ajuan' => $aju);
		$this->template->load('template', 'pengajuan/pengajuan_edit_spv',$data);
		}
	public function input_spv(){
		$perihal = $this->input->post('perihal');
		
		$sifat = $this->input->post('sifat');
		$status = 2;
		$pembuat = $this->input->post('pembuat');
		$spv = $this->input->post('spv');
		$manager = $this->input->post('manager');
		$tanggal = date('Y-m-d H:i:s');
		$tgl_buat = date('Y-m-d H:i:s');
	
		$data = array (
			'perihal' => $perihal,
			'sifat' => $sifat,
			'status' => $status,
			'pembuat' => $pembuat,
			'spv' => $spv,
			'manager' => $manager,
			'tanggal' => $tanggal,
			'tgl_buat' => $tgl_buat
		);
	$this->pengajuan_m->add($data);
	$this->session->set_flashdata('successs', 'Data berhasil diinput.');
	redirect(base_url('pengajuan/spv'));
	}

	public function editin_spv(){
		$id_aju = $this->input->post('id_aju');
		$perihal = $this->input->post('perihal');
		$sifat = $this->input->post('sifat');
		$status = 3;
		$pembuat = $this->input->post('pembuat');
		$spv = $this->input->post('spv');
		$manager = $this->input->post('manager');
		$tanggal = date('Y-m-d H:i:s');
	
		$dataupdate = array (
			'perihal' => $perihal,
			'sifat' => $sifat,
			'status' => $status,
			'spv' => $spv,
			'manager' => $manager,
			'tanggal' => $tanggal
		);
		$this->pengajuan_m->edit($dataupdate,$id_aju);
		$this->session->set_flashdata('success', 'Data berhasil dikirim.');
		redirect(base_url('pengajuan/spv'));
	}
	public function del_spv($id){
		$this->pengajuan_m->delete($id);
		$this->session->set_flashdata('danger', 'Data berhasil dihapus.');
		redirect(base_url('pengajuan/spv'));
	}

	public function ga()
	{
		$user_id = $this->fungsi->user_login()->user_id;
		$data['row'] = $this->pengajuan_m->get();
		$data['aju_ga'] = $this->pengajuan_m->aju_ga($user_id);
		$this->template->load('template','pengajuan/pengajuan_data_ga', $data);
	}

	public function tambah_ga(){
		$this->template->load('template', 'pengajuan/pengajuan_tambah_ga');	
		}
		
		public function kr_ga($id){
		$aju=$this->pengajuan_m->detail($id);
		$data = array('ajuan' => $aju);
		$this->template->load('template', 'pengajuan/pengajuan_edit_ga',$data);
		
		}
	public function input_ga(){
		$perihal = $this->input->post('perihal');
		
		$sifat = $this->input->post('sifat');
		$status = 3;
		$pembuat = $this->input->post('pembuat');
		$manager = $this->input->post('manager');
		$tanggal = date('Y-m-d H:i:s');
		$tgl_buat = date('Y-m-d H:i:s');
	
		$data = array (
			'perihal' => $perihal,
			'sifat' => $sifat,
			'status' => $status,
			'pembuat' => $pembuat,
			'manager' => $manager,
			'tanggal' => $tanggal,
			'tgl_buat' => $tgl_buat
		);
	$this->pengajuan_m->add($data);
	$this->session->set_flashdata('successs', 'Data berhasil diinput.');
	redirect(base_url('pengajuan/ga'));
	}

	public function editin_ga(){
		$id_aju = $this->input->post('id_aju');
		$perihal = $this->input->post('perihal');
		$sifat = $this->input->post('sifat');
		$status = 4;
		$pembuat = $this->input->post('pembuat');
		$spv = $this->input->post('spv');
		$direktur = $this->input->post('direktur');
		$tanggal = date('Y-m-d H:i:s');
	
		$dataupdate = array (
			'perihal' => $perihal,
			'sifat' => $sifat,
			'status' => $status,
			'direktur' => $direktur,
			'tanggal' => $tanggal
		);
		$this->pengajuan_m->edit($dataupdate,$id_aju);
		$this->session->set_flashdata('success', 'Data berhasil dikirim.');
		redirect(base_url('pengajuan/ga'));
	}
	public function del_ga($id){
		$this->pengajuan_m->delete($id);
		$this->session->set_flashdata('danger', 'Data berhasil dihapus.');
		redirect(base_url('pengajuan/ga'));
	}

	public function direktur()
	{
		$user_id = $this->fungsi->user_login()->user_id;
		$data['row'] = $this->pengajuan_m->get();
		$data['aju_direktur'] = $this->pengajuan_m->aju_direktur($user_id);
		$this->template->load('template','pengajuan/pengajuan_data_direktur', $data);
	}

	public function tambah_direktur(){
		$this->template->load('template', 'pengajuan/pengajuan_tambah_direktur');	
		}
		
		public function kr_direktur($id){
		$aju=$this->pengajuan_m->detail($id);
		$data = array('ajuan' => $aju);
		$this->template->load('template', 'pengajuan/pengajuan_edit_direktur',$data);
		
		}
	public function input_direktur(){
		$perihal = $this->input->post('perihal');
		$sifat = $this->input->post('sifat');
		$status = 3;
		$pembuat = $this->input->post('pembuat');
		$manager = $this->input->post('manager');
		$tanggal = date('Y-m-d H:i:s');
		$tgl_buat = date('Y-m-d H:i:s');
	
		$data = array (
			'perihal' => $perihal,
			'sifat' => $sifat,
			'status' => $status,
			'pembuat' => $pembuat,
			'manager' => $manager,
			'tanggal' => $tanggal,
			'tgl_buat' => $tgl_buat
		);
	$this->pengajuan_m->add($data);
	$this->session->set_flashdata('successs', 'Data berhasil diinput.');
	redirect(base_url('pengajuan/direktur'));
	}

	public function editin_direktur(){
		$id_aju = $this->input->post('id_aju');
		$perihal = $this->input->post('perihal');
		$sifat = $this->input->post('sifat');
		$status = 4;
		$pembuat = $this->input->post('pembuat');
		$spv = $this->input->post('spv');
		$direktur = $this->input->post('direktur');
		$tanggal = date('Y-m-d H:i:s');
	
		$dataupdate = array (
			'perihal' => $perihal,
			'sifat' => $sifat,
			'status' => $status,
			'direktur' => $direktur,
			'tanggal' => $tanggal
		);
		$this->pengajuan_m->edit($dataupdate,$id_aju);
		$this->session->set_flashdata('success', 'Data berhasil dikirim.');
		redirect(base_url('pengajuan/direktur'));
	}
	public function del_direktur($id){
		$this->pengajuan_m->delete($id);
		$this->session->set_flashdata('danger', 'Data berhasil dihapus.');
		redirect(base_url('pengajuan/direktur'));
	}

}