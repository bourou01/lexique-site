<?php

class Sizes extends CI_Controller {
  function Sizes(){
    parent::__construct();
    //session_start();
    
  		if ($this->session->userdata('simple_user'))
		{
			$this->session->set_flashdata('error', "Connectez vous en tant que Moderateur pour acceder au dashboard");
	    	redirect('welcome/index','refresh');
	    }
  }
  

  function index(){
	$data['title'] = "Manage Sizes";
	$data['main'] = 'admin_sizes_home';
	$data['sizes'] = $this->MSizes->getAllSizes();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  

  
  function create(){
   	if ($this->input->post('name')){
  		$this->MSizes->createSize();
  		$this->session->set_flashdata('message','Size created');
  		redirect('admin/sizes/index','refresh');
  	}else{
		$data['title'] = "Create Size";
		$data['main'] = 'admin_sizes_create';
		$this->load->vars($data);
		$this->load->view('dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('name')){
  		$this->MSizes->updateSize();
  		$this->session->set_flashdata('message','Size updated');
  		redirect('admin/sizes/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Size";
		$data['main'] = 'admin_sizes_edit';
		$data['size'] = $this->MSizes->getSize($id);
		if (!count($data['size'])){
			redirect('admin/sizes/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MSizes->deleteSize($id);
	$this->session->set_flashdata('message','Size deleted');
	redirect('admin/sizes/index','refresh');
  }

	
}//end class
?>