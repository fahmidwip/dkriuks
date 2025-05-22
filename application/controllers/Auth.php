<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
// Untuk Login
	public function login()
	{
		ok();
		$this->load->view('login');
	}
    // Proses Login
    public function process() 
{
    $post = $this->input->post(null, TRUE);
    if(isset($post['login'])){
        $this->load->model('user_m');
        $user = $this->user_m->login($post); 

        if($user != null){
            $params = array(
                'userid' => $user->user_id,
                'level' => $user->level,
            );
            $this->session->set_userdata($params);

           
            $data['username'] = $user->name;
            $this->load->view('splash_screen', $data);

        } else {
            
            $this->load->view('splash_screen_gagal');
        }
    }
}

// Proses logout
public function logout()
{
    
    $user_id = $this->session->userdata('userid');

   
    if ($user_id) {
        $this->load->model('User_m'); // Pastikan model sudah dimuat
        $this->user_m->update_last_logout($user_id);
    }

   
    $params = array('userid', 'level');
    $this->session->unset_userdata($params);

   
    redirect('auth/login');
}

}
