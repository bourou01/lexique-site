<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * @brief constructor
	 */	
	function Users()
	{
		parent::__construct();
		session_start();
    	//$this->output->enable_profiler(FALSE);
	}
	
	
	public function test()
	{

		$users = $this->MProducts->getAllProducts();
	        var_dump($users);

    
	}
	
	public function index()
	{
		
		echo "logged out";
		$user_id = $this->session->userdata('user_id');
		echo "<br/>";
		print_r($this->session->userdata('username'));

		echo "<br/>";
		print_r($this->session->userdata('name'));
		echo "<br/>";
		print_r($this->session->userdata('privilege'));
		
		/*
		echo "<br/>";
		echo $_SESSION['id'];
		echo "<br/>";
		echo $_SESSION['logged_in'];
		*/
	}

	
	public function register()
	{
		
		$this->form_validation->set_rules('username', 'Utilisateur', 'required|trim|alpha_numeric|min_length[6]|xss_clean|strtolower|callback_username_not_exists');
		$this->form_validation->set_rules('name', 'Nom', 'required|trim|min_length[6]|xss_clean');
		$this->form_validation->set_rules('email', 'Adresse mail', 'required|trim|min_length[6]|xss_clean|valid_email|callback_email_not_exists');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required|trim|alpha_numeric|min_length[6]|xss_clean');
		$this->form_validation->set_rules('password_conf', 'Confirmation', 'required|trim|alpha_numeric|min_length[6]|matches[password]|xss_clean');
		
		
		if($this->form_validation->run() == FALSE)
		{
			// hasn't been run or there are validation errors
			//$this->load->view('view_register', $this->view_data);
			
			$data['main'] = 'users/register';
			$data['title'] = "Enregistrons nous Mahorais";
			$data['navlist'] = $this->MCats->getCategoriesNav();
			$this->load->vars($data);
			$this->load->view('template'); 
			
		}
		else
		{
			// everything is good - process the form - write the data into the registration Database
			$username = $this->input->post('username');
			$name = $this->input->post('name');
			$password = $this->input->post('password');
			$email = $this->input->post('email');


			$this->MUsers->register_user($username, $password, $name, $email);

			$this->session->set_flashdata("alert-success", "OK	:	Vous &ecirc;tes bien enregistr&eacute;, maintenant vous pouvez vous connecter !");
			redirect('welcome/home');
				
				
			
			
			// email confirmation
			
			// confirmation message view
			
		}

	}
	
	function username_not_exists($username)
	{

		$this->form_validation->set_message('username_not_exists', 'L utilisateur %s existe deja. Merci de bien vouloir choisir un autre');
		
	
		if ($this->MUsers->check_exists_username($username))
		{
			return false;
		}
		else
		{
			return true;
		}	
	}
	
	function email_not_exists($email)
	{
		$this->form_validation->set_message('email_not_exists', 'Le mail %s existe deja. Merci de bien vouloir choisir un autre');
		
	
		if ($this->MUsers->check_exists_email($email))
		{
			return false;
		}
		else
		{
			return true;
		}	
	}
	
	public function login()
	{
		
		
		$this->form_validation->set_rules('username', 'Utilisateur', 'required|trim|max_length[50]|xss_clean');
		$this->form_validation->set_rules('password', 'Mot de passe', 'required|trim|max_length[200]|xss_clean');
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata("alert-error", "ERREUR	:	Formulaire incompl&egrave;te");
			redirect('welcome/home');
		}
		else
		{
			// process their input and login the user
			extract($_POST);

			$response = $this->MUsers->verifyUser($username, $password);
			
			if ($response)
			{
				$this->session->set_flashdata("alert-success", "OK	:	Vous &ecirc;tes maintenant connect&eacute;(e)");	
			}
			else
			{
				$this->session->set_flashdata("alert-error", "ERREUR	:	Login ou Mot de passe incorrect");
			}
			redirect('welcome/home');

		}
	}

	
	function verify()
	{
		/*
		if ($this->input->post('username')){
			$u = $this->input->post('username');
			$pw = $this->input->post('password');
			
			$this->MUsers->verifyUser($u,$pw);
			

				if ($this->session->userdata('Auserid') > 0)
				{
					redirect('admin/dashboard','refresh');
				}
				else 
				{
					redirect('users/verify','refresh');
				}
		}

		$data['main'] = 'login';
		$data['title'] = "Administrons Mahorais";
		$data['navlist'] = $this->MCats->getCategoriesNav();
		$this->load->vars($data);
		$this->load->view('template');
		*/
		
		if (!$this->session->userdata('logged_in'))
		{
			$this->session->set_flashdata('alert-error', 'ERROR	:	Loggez vous avant de vouloir utiliser le dashboard');
			redirect('welcome/home', 'refresh');
		}
		else
		{
			if (!$this->session->userdata('moderator'))
			{
				$this->session->set_flashdata('alert-error', "ERREUR	:	Vous n'etes pas moderateur");
				redirect('welcome/home', 'refresh');	
			}
			else
			{
				redirect('admin/dashboard','refresh');
			}
			
		}
	}

	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('welcome/home');		
	}

}

?>