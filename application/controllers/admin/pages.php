<?php

class Pages extends CI_Controller {
  function Pages(){
    parent::__construct();
	session_start();
    
  		if ($this->session->userdata('simple_user'))
		{
			$this->session->set_flashdata('error', "Connectez vous en tant que Moderateur pour acceder au dashboard");
	    	redirect('welcome/index','refresh');
	    }
    
    $this->tinyMce = '
		<!-- TinyMCE -->
		<script type="text/javascript" src="'. base_url().'js/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
			tinyMCE.init({
				// General options
				mode : "textareas",
				theme : "simple"
			});
		</script>
		<!-- /TinyMCE -->
		';
  }
  

  function index(){
	$data['title'] = "Manage Pages";
	$data['main'] = 'admin/admin_pages_home';
	$data['pages'] = $this->MPages->getAllPages();
	$this->load->vars($data);
	$this->load->view('admin/dashboard');  
  }
  

  
  function create(){
   	if ($this->input->post('name')){
  		$this->MPages->addPage();
  		$this->session->set_flashdata('message','Page created');
  		redirect('admin/pages/index','refresh');
  	}else{
		$data['title'] = "Create Page";
		$data['main'] = 'admin/admin_pages_create';
		$this->load->vars($data);
		$this->load->view('admin/dashboard');    
	} 
  }
  
  function edit($id=0){
  	if ($this->input->post('name')){
  		$this->MPages->updatePage();
  		$this->session->set_flashdata('message','Page updated');
  		redirect('admin/pages/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Page";
		$data['main'] = 'admin/admin_pages_edit';
		$data['page'] = $this->MPages->getPage($id);
		if (!count($data['page'])){
			redirect('admin/pages/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('admin/dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MPages->deletePage($id);
	$this->session->set_flashdata('message','Page deleted');
	redirect('admin/pages/index','refresh');
  }


	
}//end class
?>