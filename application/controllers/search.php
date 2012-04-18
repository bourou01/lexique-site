<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Search extends CI_Controller {

	/**
	 * @brief constructor
	 */	
	function Search()
	{
		parent::__construct();
		//session_start();
		

    	//$this->output->enable_profiler(FALSE);
	}

        public function index($term)
        {
            $result = $this->MProducts->search($term);
	    
            $data['result'] = $result;
            
            $this->load->vars($data);            
            $this->load->view('tools/view_search');
            
        }
        
        public function trouver($term)
        {
            
            $result = $this->MProducts->search($term);
	    
            $data['result'] = $result;
            
            $this->load->vars($data);            
            $this->load->view('tools/view_search');
            
            
        }
        
        


}