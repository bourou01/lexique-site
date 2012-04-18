<?php

class Subscribers extends CI_Controller {
  function Subscribers(){
    parent::__construct();
	session_start();
	
    
    	if ($this->session->userdata('simple_user'))
		{
			$this->session->set_flashdata('error', "Connectez vous en tant que Moderateur pour acceder au dashboard");
	    	redirect('welcome/index','refresh');
	    }
    
    
  $this->tinyMce = '
    <!-- TinyMCE -->
    <script type="text/javascript" src="'.  base_url()
       .'js/tiny_mce/tiny_mce.js"></script>
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
	$data['title'] = "Manage Subscribers";
	$data['main'] = 'admin_subs_home';
	$data['subscribers'] = $this->MSubscribers->getAllSubscribers();
	$this->load->vars($data);
	$this->load->view('dashboard');  
  }
  
  
  function delete($id){
	//$id = $this->uri->segment(4);
	$this->MSubscribers->removeSubscriber($id);
	$this->session->set_flashdata('message','Subscriber deleted');
	redirect('admin/subscribers/index','refresh');
  }


  function sendemail(){
  
  	$this->load->helper('file');
  	if ($this->input->post('subject')){
  		$test = $this->input->post('test');
 		$subject = $this->input->post('subject');
 		$msg = $this->input->post('message');
 		
 		if ($test){
 			$this->email->clear();
			$this->email->from('claudia@example.com', 'ClaudiasKids.net');
			$this->email->to('myerman@gmail.com');
			$this->email->subject($subject);
			$this->email->message($msg);		
			$this->email->send();
			$this->session->set_flashdata('message', "Test email sent");
			write_file('/tmp/email.log', $subject ."|||".$msg);
			redirect('admin/subscribers/sendemail','refresh'); 
 		}else{
 			$subs = $this->MSubscribers->getAllSubscribers();
			foreach ($subs as $key => $list){
				$unsub = "<p><a href='". base_url()."welcome/unsubscribe/".$list['id']. "'>Unsubscribe</a></p>";
				$this->email->clear();
				$this->email->from('claudia@example.com', 'ClaudiasKids.net');
				$this->email->to($list['email']);
				$this->email->bcc('claudia@example.com'); 
				$this->email->subject($subject);
				$this->email->message($msg . $unsub);		
				$this->email->send();	
			}
 			$this->session->set_flashdata('message', count($subs) . " emails sent");
		}
		
		redirect('admin/subscribers/index','refresh'); 	


  	}else{
  		if ($this->session->flashdata('message') == "Test email sent"){
  			$lastemail = read_file('/tmp/email.log');
  			list($subj,$msg) = explode("|||",$lastemail);
			$data['subject'] = $subj;
			$data['msg'] = $msg;
		}else{
			$data['subject'] = '';
			$data['msg'] = '';
		}
 		$data['title'] = "Send Email";
		$data['main'] = 'admin_subs_mail';
		$this->load->vars($data);
		$this->load->view('dashboard');  			
  	}
  }
	
}//end class
?>