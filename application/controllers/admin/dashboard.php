<?php

class Dashboard extends CI_Controller {
	
	function Dashboard()
	{
		
    	parent::__construct();
    	session_start();

		if ($this->session->userdata('simple_user'))
		{
			$this->session->set_flashdata('error', "Connectez vous en tant que Moderateur pour acceder au dashboard");
	    	redirect('welcome/index','refresh');
	    }
	}
  
 
	function index()
	{
		$data['title'] = "Dashboard Home";
		$data['main'] = 'admin/admin_home';
		$this->load->vars($data);
		$this->load->view('admin/dashboard');
	}
 
 function logout()
 {
	redirect('welcome/index','refresh'); 	
 }
 
}
?>