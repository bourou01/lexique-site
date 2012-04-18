<?php

class Orders extends CI_Controller {
  function Orders(){
    parent::__construct();
    session_start();
    
  		if ($this->session->userdata('simple_user'))
		{
			$this->session->set_flashdata('error', "Connectez vous en tant que Moderateur pour acceder au dashboard");
	    	redirect('welcome/index','refresh');
	    }
  }
  
  
}


?>