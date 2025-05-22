<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
			parent:: __construct();
			no();
			
		    $this->load->model('user_m');
			$this->load->library('form_validation');
		}
	
public function index()
{
	check_admin();
	
	$search = $this->input->get('search');
	$page = (int) $this->input->get('page');
	$page = ($page < 1) ? 1 : $page;
	$limit = 20;
	$offset = ($page - 1) * $limit;

	// Query dasar
	$this->db->from('user');
	$this->db->join('stokis', 'stokis.id_stokis = user.stokis', 'left');
	$this->db->join('provinsi', 'provinsi.id_prov = user.provinsi', 'left');
	$this->db->join('level', 'level.id_level = user.level', 'left');

	// Filter pencarian
	if (!empty($search)) {
		$this->db->group_start();
		$this->db->like('user.username', $search);
		$this->db->or_like('user.name', $search);
		$this->db->or_like('level.level', $search);
		$this->db->or_like('stokis.nama_stokis', $search);
		$this->db->group_end();
	}

	// Clone query builder sebelum limit untuk hitung total_rows
	$db_clone = clone $this->db;
	$total_rows = $db_clone->count_all_results();

	// Ambil data dengan limit dan order
	$this->db->select('user.*, stokis.nama_stokis as stokis_name, provinsi.provinsi as provinsi_name, level.level as level_nama');
	$this->db->order_by('user.user_id', 'asc');
	$this->db->limit($limit, $offset);
	$row = $this->db->get();

	// Hitung total halaman
	$total_pages = ceil($total_rows / $limit);

	// Kirim data ke view
	$data = [
		'row' => $row,
		'search' => $search,
		'page' => $page,
		'total_pages' => $total_pages,
		'total_rows' => $total_rows,
		'total_user' => $this->user_m->get_total_user()
	];

	$this->template->load('template', 'user/user_data', $data);
}
		
		public function tambah()
		
	{   check_admin();
		$data['stokis'] = $this->user_m->get_stokis(); 
		$data['level'] = $this->user_m->get_level();
		$data['provinsi'] = $this->user_m->get_provinsi();
		$this->template->load('template', 'user/user_tambah',$data);
	}

	public function input() {
		check_admin();
		$name = $this->input->post('nama_form');
		$username = $this->input->post('user_form');
		$password = sha1($this->input->post('password_form'));
		$stokis = $this->input->post('stokis_form');
		$provinsi = $this->input->post('provinsi_form');
		$level = $this->input->post('level_form');
		$data = array(
			'name' => $name,
			'username' => $username,
			'password' => $password,
			'stokis' => $stokis,
			'provinsi' => $provinsi,
			'level' => $level,
		);
		$this->user_m->add1($data);
		$this->session->set_flashdata('success', 'Data berhasil diinput.');
		redirect(base_url('user'));
	}
	
	

	public function del()
	{
		check_admin();
		$id = $this->input->post('user_id');
		$this->user_m->del($id);
		if($this->db->affected_rows() > 0){
			echo "<script>
				alert('Data berhasil dihapus');
			</script>";
		}
		echo "<script>
			window.location = '".site_url('user')."';</script>;
		</script>";
	
	}
	public function edit($id){
		check_admin();
		$this->form_validation->set_rules('nama_form', 'Name', 'required');
		$this->form_validation->set_rules('user_form', 'Username', 'required|min_length[5]|callback_username_check');
		if($this->input->post('password')){
		$this->form_validation->set_rules('password_form', 'Password', 'min_length[7]');
		$this->form_validation->set_rules('password2_form', 'Password Konfirmasi', 'matches[password_form]',
		array('matches' => '%s Tidak sesuai dengan Password')
	);
}	
	if($this->input->post('password2')){
	$this->form_validation->set_rules('password2_form', 'Password Konfirmasi', 'matches[password_form]',
	array('matches' => '%s Tidak sesuai dengan Password')
);
}
		$this->form_validation->set_rules('alamat_form', 'Alamat', 'required');
		$this->form_validation->set_rules('level_form', 'Level', 'required');
		$this->form_validation->set_rules('stokis_form', 'Level', 'required');
		$this->form_validation->set_rules('provinsi_form', 'Level', 'required');
		$this->form_validation->set_message('required', '%s Masih Kosong, silahkan isi');
		$this->form_validation->set_message('is_unique', '%s sudah dipakai');
		$this->form_validation->set_message('min_length', '%s Tambahkan lagi karakternya');
		if ($this->form_validation->run() == FALSE)
		{   $query = $this->user_m->get($id);
			if($query->num_rows() > 0 ){
				$data['row']=$query->row();
				
				$data['stokis'] = $this->user_m->get_stokis(); 
				$data['level'] = $this->user_m->get_level();
				$data['provinsi'] = $this->user_m->get_provinsi();
				$this->template->load('template', 'user/user_edit', $data);
			} else{
				echo "<script>
					alert('Data tidak ditemukan');";
				echo "window.location = '".site_url('user')."';</script>";
			}

		}else{
			$post = $this->input->post(null, TRUE);
			$this->user_m->edit($post);
			if($this->db->affected_rows() > 0){
				echo "<script>
					alert('Data berhasil disimpan');
				</script>";
			}
			echo "<script>
				window.location = '".site_url('user')."';</script>;
			</script>";
		}
	}
	function username_check(){
		check_admin();
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM user WHERE username = '$post[user_form]' AND user_id != '$post[user_id]'");	
		if($query->num_rows() > 0){
			$this->form_validation->set_message('username_check', '%s ini sudah di pakai');
			return FALSE;
		} else {

			return TRUE;
		}

	}
	public function profil($id){
		check_admin();
		$this->form_validation->set_rules('nama_form', 'Name', 'required');
		$this->form_validation->set_rules('user_form', 'Username', 'required|min_length[5]|callback_username_check');
		if($this->input->post('password')){
		$this->form_validation->set_rules('password_form', 'Password', 'min_length[7]');
		$this->form_validation->set_rules('password2_form', 'Password Konfirmasi', 'matches[password_form]',
		array('matches' => '%s Tidak sesuai dengan Password')
	);
}	
	if($this->input->post('password2')){
	$this->form_validation->set_rules('password2_form', 'Password Konfirmasi', 'matches[password_form]',
	array('matches' => '%s Tidak sesuai dengan Password')
);
}
	$this->form_validation->set_rules('alamat_form', 'Alamat', 'required');
		$this->form_validation->set_rules('level_form', 'Level', 'required');
		$this->form_validation->set_message('required', '%s Masih Kosong, silahkan isi');
		$this->form_validation->set_message('is_unique', '%s sudah dipakai');
		$this->form_validation->set_message('min_length', '%s Tambahkan lagi karakternya');
		if ($this->form_validation->run() == FALSE)
		{   $query = $this->user_m->get($id);
			if($query->num_rows() > 0 ){
				$data['row']=$query->row();
				$this->template->load('template', 'user/user_edit', $data);
			} else{
				echo "<script>
					alert('Data tidak ditemukan');";
				echo "window.location = '".site_url('user')."';</script>";
			}

		}else{
			$post = $this->input->post(null, TRUE);
			$this->user_m->edit($post);
			if($this->db->affected_rows() > 0){
				echo "<script>
					alert('Data berhasil disimpan');
				</script>";
			}
			echo "<script>
				window.location = '".site_url('user')."';</script>;
			</script>";
		}
	}

	public function ed($id)
	{check_admin();
		$usr = $this->user_m->detail($id);
		$stokiss = $this->user_m->get_stokis($id); 
		$level = $this->user_m->get_level($id);
		$provinsi = $this->user_m->get_provinsi($id);
		
	
		$data = array(
			'row' => $usr,
			'stokis' => $stokiss,
			'level' => $level,
			'provinsi' => $provinsi
		);
	
		$this->template->load('template', 'user/user_edit', $data);
	}
public function editin()
{
    check_admin();

    $user_id   = $this->input->post('user_id');
    $username  = $this->input->post('user_form');
    $nama_form = $this->input->post('nama_form');
    $stokis    = $this->input->post('stokis_form');
    $provinsi  = $this->input->post('provinsi_form');
    $level     = $this->input->post('level_form');

    $dataupdate = array(
        'name'     => $nama_form,
        'username' => $username,
        'provinsi' => $provinsi,
        'level'    => $level
    );

    $password_form = $this->input->post('password_form');
    if (!empty($password_form) || !empty($stokis)) {
        if (!empty($password_form)) {
            $dataupdate['password'] = sha1($password_form); 
        }
        if (!empty($stokis)) {
            $dataupdate['stokis'] = $stokis;
        }
    }

    $this->user_m->edits($dataupdate, $user_id);
    $this->session->set_flashdata('success', 'Data berhasil diubah.');
    redirect(base_url('user'));
}

	public function pass($id)
	{
		$usr = $this->user_m->detail($id);
		$stokiss = $this->user_m->get_stokis($id); 
		$level = $this->user_m->get_level($id);
		$provinsi = $this->user_m->get_provinsi($id);
		
	
		$data = array(
			'row' => $usr,
			'stokis' => $stokiss,
			'level' => $level,
			'provinsi' => $provinsi
		);
	
		$this->template->load('template', 'user/password_edit', $data);
	}
	public function editin1()
	{
		$user_id = $this->input->post('user_id');
		
	
		$password_form = $this->input->post('password_form');
		if (!empty($password_form)) {
			$dataupdate['password'] = sha1($password_form);
		}
	
		
		$this->user_m->edits($dataupdate, $user_id);
		$this->session->set_flashdata('success', 'Password berhasil diubah.');
		redirect(base_url('dashboard'));
	}
}
