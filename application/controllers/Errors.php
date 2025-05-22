<?php
class Errors extends CI_Controller {
    public function page_missing() {
        $this->output->set_status_header('404');
        $this->load->view('errors/html/error_404'); // Bisa pakai view custom kamu
    }
}
	  

	
