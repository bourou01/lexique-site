<?php

class Categories extends CI_Controller {
  function Categories(){
    parent::__construct();
    session_start();
    
  		if ($this->session->userdata('simple_user'))
		{
			$this->session->set_flashdata('error', "Connectez vous en tant que Moderateur pour acceder au dashboard");
	    	redirect('welcome/index','refresh');
	    }
	    
  }
  

  function index(){
	$data['title'] = "Manage Categories";
	$data['main'] = 'admin/admin_cat_home';
	$data['categories'] = $this->MCats->getAllCategories();
	$this->load->vars($data);
	$this->load->view('admin/dashboard');  
  }
  

  
  function create(){
   	if ($this->input->post('name')){
  		$this->MCats->addCategory();
  		$this->session->set_flashdata('message','Category created');
  		redirect('admin/categories/index','refresh');
  	}else{
		$data['title'] = "Create Category";
		$data['main'] = 'admin/admin_cat_create';
		$data['categories'] = $this->MCats->getTopCategories();
		$this->load->vars($data);
		$this->load->view('admin/dashboard');    
	} 
  }
  
  function edit($id=0){

  	if ($this->input->post('name')){
  		$this->MCats->updateCategory();
  		$this->session->set_flashdata('message','Category updated');
  		redirect('admin/categories/index','refresh');
  	}else{
		//$id = $this->uri->segment(4);
		$data['title'] = "Edit Category";
		$data['main'] = 'admin/admin_cat_edit';
		$data['category'] = $this->MCats->getCategory($id);
		$data['categories'] = $this->MCats->getTopCategories();
		if (!count($data['category'])){
			redirect('admin/categories/index','refresh');
		}
		$this->load->vars($data);
		$this->load->view('admin/dashboard');    
	}
  }
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MCats->deleteCategory($id);
	$orphans = $this->MCats->checkOrphans($id);
	if (count($orphans)){
		$this->session->set_userdata('orphans',$orphans);
		redirect('admin/categories/reassign/'.$id,'refresh');	
	}else{
		$this->session->set_flashdata('message','Category deleted');
		redirect('admin/categories/index','refresh');
	}
  }

  function export(){
  	$this->load->helper('download');
  	$csv = $this->MCats->exportCsv();
  	$name = "category_export.csv";
  	force_download($name,$csv);

  }

	function reassign($id=0){
		if ($_POST){
			$this->MProducts->reassignProducts();
			$this->session->set_flashdata('message','Category deleted and products reassigned');
			redirect('admin/categories/index','refresh');
		}else{
			//$id = $this->uri->segment(4);
			$data['category'] = $this->MCats->getCategory($id);
			$data['title'] = "Reassign Products";
			$data['main'] = 'admin/admin_cat_reassign';
			$data['categories'] = $this->MCats->getCategoriesDropDown();
			$this->load->vars($data);
			$this->load->view('admin/dashboard');    	
		}	
	}

	
}//end class
?>