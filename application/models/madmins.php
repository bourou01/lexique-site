<?php

class MAdmins extends CI_Model{

	function MAdmins()
	{
		parent::__construct();
	}


	function verifyUser($u,$pw)
	{
		$this->db->select('id,username,password,status');
		$this->db->where('username',db_clean($u,16));
		$this->db->where('password', db_clean(do_hash($pw),16));
		$this->db->where('status', 'active');
		$this->db->limit(1);
		$Q = $this->db->get('users');

		var_dump($Q->result_array());
		
		
		if ($Q->num_rows() > 0)
		{
			$row = $Q->row_array();
		}
		else
		{
			$this->session->set_flashdata('error', 'Sorry, your username or password is incorrect!');
		}		
	}

	function getUser($id)
	{
      $data = array();
      $options = array('id' => id_clean($id));
      $Q = $this->db->get_where('users',$options,1);
      if ($Q->num_rows() > 0){
        $data = $Q->row_array();
      }

      $Q->free_result();    
      return $data;
	}
	
	public function isThisUserHaveThePrivilege($id, $privilege)
	{
		
		$data = array();
	
	    $options = array( 'id' 		=> $id,
      					'privilege' => $privilege);
      
		$Q = $this->db->get_where('users',$options,1);
		
		if($Q->num_rows() > 0)
		{
        	$data = $Q->row_array();


      		if($data['privilege'] == $privilege)
      		{
				return true;
      		}
      		else
      		{
      			return false;
      		}
		}
		else
		{
			return false;
		}
	}

	
	
	function getAllUsers()
	{
		$data = array();
		$Q = $this->db->get('users');
		
		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		
		$Q->free_result();    
		return $data; 	
	}
	
	public function getUsersByPagination($num, $offset)
	{
     $data = array();
     $Q = $this->db->get('users', $num, $offset);
     if ($Q->num_rows() > 0){
       foreach ($Q->result_array() as $row){
         $data[] = $row;
       }
     }
     $Q->free_result();    
     return $data; 	
	}
	
	
	
	function addUser(){
      $data = array(
		'username' => db_clean($_POST['username'],16),
		'name' => db_clean($_POST['name'],255),
                'email' => db_clean($_POST['email'],255),
      		'privilege' => db_clean($_POST['privilege'],32),
                'status' => db_clean($_POST['status'],8),
		'password' => db_clean(do_hash($_POST['password']),16)
                    );
	
	  $this->db->insert('users',$data);
	
	}
	
	function updateUser()
	{
		$data = array(
			  'username' => db_clean($_POST['username'],16),
			  'name' => db_clean($_POST['name'],255),
			  'email' => db_clean($_POST['email'],255),
			  'privilege' => db_clean($_POST['privilege'],32),
			  'status' => db_clean($_POST['status'],8),
			  'password' => db_clean(do_hash($_POST['password']),16)
			      );
		    $this->db->where('id',id_clean($_POST['id']));
		    $this->db->update('users',$data);	
	
	}
	
	
	function deleteUser($id){
 	 $data = array('status' => 'inactive');
 	 $this->db->where('id', id_clean($id));
	 $this->db->update('users', $data);
	
	}
}


?>