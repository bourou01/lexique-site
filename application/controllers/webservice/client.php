<?php



class client extends CI_Controller
{
    function client()
    {
        
        parent::__construct();
    }
    
    public function index()
    {

        echo "client welcome";
    }
    
    function rest_client_example($id)  
    {
        
        $this->load->library('rest', array(  
            'server' => 'http://localhost:8888/lexique/webservice/example/',  
            'http_user' => 'admin',  
            'http_pass' => '1234',  
            'http_auth' => 'basic' // or 'digest'  
        ));  

  
      $user = $this->rest->get('user', array('id' => $id), 'xml');  
  
      //echo $user->name;

      print_r($user);
  }  
    
}



?>