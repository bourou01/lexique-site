<?php

class MUsers extends CI_Model{

	function MUsers()
	{
		parent::__construct();
	}

	public function register_user($username, $password, $name, $email)
	{
		$sec_username = db_clean($username,16);
		$sha1_password = db_clean(do_hash($password),16);
		 
		$query_str = "INSERT INTO users (username, password, name, email, status, privilege, last_visit, created, modified, traffic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		 
		$status = 'active';
		$privilege = 'Utilisateur';
		
		
		$datestring = "%Y:%m:%d - %h:%i %a";
		$time = time();
		
		$last_visit = mdate($datestring, $time);
		
		$created = $time;
		$modified = $time;
		
		
		$traffic = 0;
		
		$this->db->query($query_str, array($sec_username, $sha1_password, $name, $email, $status,$privilege, $last_visit, $created, $modified, $traffic));
	}
	
	public function check_exists_username($username)
	{
		$query_str = "SELECT username FROM users WHERE username = ?";
		$result = $this->db->query($query_str, $username);
		
		if ($result->num_rows() > 0)
		{
			// username exists
			return true;	
		}
		else
		{
			// username doesn't exist
			return false;
		}	
	}
	
	
	public function check_exists_email($email)
	{
		$query_str = "SELECT email FROM users WHERE email = ?";
		$result = $this->db->query($query_str, $email);
		
		if ($result->num_rows() > 0)
		{
			// email exists
			return true;	
		}
		else
		{
			// email doesn't exist
			return false;
		}
	}

	
	function check_login($username, $password)
	{
		$sec_username = db_clean($username,16);
		$sha1_password = db_clean(do_hash($password),16);
		
		$query_str = "SELECT id FROM users WHERE username = ? and password = ?";
		
		$result = $this->db->query($query_str, array($sec_username, $sha1_password));
		
		if ($result->num_rows() == 1)
		{
			return $result->row(0)->id;	
		}
		else
		{
			return false;
		}
	}
	
	
	
	
	
	function get_user_details($id)
	{
		
		$query_str = "SELECT * FROM users WHERE id = ?";
		
		$result = $this->db->query($query_str, $id);

		
		return $result->row(0);
		
	}
	
	function verifyUser($u,$pw)
	{

		$data = array();
		$this->db->select('id,username,password,privilege,name,traffic');
		$this->db->where('username',db_clean($u,16));
		$this->db->where('password', db_clean(do_hash($pw),16));
		$this->db->where('status', 'active');
		
		$this->db->limit(1);
		$Q = $this->db->get('users');

		if ($Q->num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)
			{	
				$data = $row;
			}
			
			$chat_id = 1;		
			
			$this->session->set_userdata(array(
						'logged_in' 		=> TRUE, 
						'user_id' 		=> $data['id'],
						'username' 		=> $data['username'],
						'name'			=> $data['name'],
						'privilege' 		=> $data['privilege'],
						'traffic'		=> $data['traffic'],
						'simple_user'		=> $this->MAdmins->isThisUserHaveThePrivilege($data['id'], 'Utilisateur'),
						'moderator' 		=> $this->MAdmins->isThisUserHaveThePrivilege($data['id'], 'Moderateur'),
						'super_moderator' 	=> $this->MAdmins->isThisUserHaveThePrivilege($data['id'], 'Super Moderateur'),
						'chat_id'		=> 1,
						'last_chat_message_id_' . $chat_id => 0
			));

						
			return true;
					
		}
		else
		{
			//$this->session->set_flashdata('error', 'Sorry, your username or password is incorrect!');
			$this->session->set_flashdata('login_error', TRUE);
			
		}
		
		return false;
		
	}

}


?>