<?php

class Admins extends CI_Controller {
	
  
	function Admins()
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
  		
  		/*Init Paging*/
		$config['base_url'] = base_url().'index.php/admin/admins/index/';
		$config['total_rows'] = $this->db->count_all('users');
		$config['per_page'] = '10';
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);
		/*End Init Paging*/
		
		
		$data['admins'] = $this->MAdmins->getUsersByPagination($config['per_page'],$this->uri->segment(4));
		
  		
		$data['title'] = "Manage Users";
		$data['main'] = 'admin/admin_admins_home';
		//$data['admins'] = $this->MAdmins->getAllUsers();
		$this->load->vars($data);
		$this->load->view('admin/dashboard');  
	}
  

  
  function create(){
   	if ($this->input->post('username')){
  		$this->MAdmins->addUser();
  		$this->session->set_flashdata('message','User created');
  		redirect('admin/admins/index','refresh');
  	}else{
		$data['title'] = "Create User";
		$data['main'] = 'admin/admin_admins_create';
		$this->load->vars($data);
		$this->load->view('admin/dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('username')){
  		$this->MAdmins->updateUser();
  		$this->session->set_flashdata('message','User updated');
  		redirect('admin/admins/index','refresh');

  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit User";
		$data['main'] = 'admin/admin_admins_edit';
		$data['admin'] = $this->MAdmins->getUser($id);
		if (!count($data['admin'])){
			redirect('admin/admins/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('admin/dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MAdmins->deleteUser($id);
	$this->session->set_flashdata('message','User deleted');
	redirect('admin/admins/index','refresh');
  }
  
}


?>