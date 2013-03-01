<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Parlons ChimaorŽ
 * @package		lexique
 * @author		ABDULLATIF Mouhamadi
 * @copyright	Copyright (c) 2012, ABDULLATIF, Inc. (http://ellislab.com/)
 */

class Welcome extends CI_Controller {

	/**
	 * @brief constructor
	 */	
	function Welcome()
	{
		parent::__construct();
		session_start();
		

    	//$this->output->enable_profiler(FALSE);
	}


	public function test()
	{
		echo $this->getalldatabyajax();
	}
	
	
	
	/**
	 * @brief main function
	 */
	public function index()
	{
		$data['categories'] = $this->MCats->getCategoriesDropDown();
		
		$data['title'] = "Parlons Mahorais";
		$data['navlist'] = $this->MCats->getCategoriesNav();

		$data['get_data_method'] = "index.php/welcome/getalldatabyajax";
		$data['main'] = 'users/hometab';
		
		$this->load->vars($data);
		
		$this->load->view('template');
	
	}
	
	
	public function home()
	{

		$data['categories'] = $this->MCats->getCategoriesDropDown();
		
		$data['title'] = "Parlons Mahorais";
		$data['navlist'] = $this->MCats->getCategoriesNav();

		$data['get_data_method'] = "";
		$data['main'] = 'users/home';
		
		$data['products'] = $this->MProducts->getRandomProducts(10);
		
		$this->load->vars($data);
		
		$this->load->view('template');
		
		
	}
	
	
	
	public function mobile()
	{

		$data['categories'] = $this->MCats->getCategoriesDropDown();
		
		$data['title'] = "Parlons Mahorais";
		$data['navlist'] = $this->MCats->getCategoriesNav();

		$data['get_data_method'] = "";
		$data['main'] = 'tools/mobile';
		
		$data['products'] = $this->MProducts->getRandomProducts(10);
		
		$this->load->vars($data);
		
		$this->load->view('template');
		
		
	}
	
	
	
	public function getalldatabyajax()
	{
		$this->load->library('datatables');
		$this->datatables
				->select('id,mahorais,francais')
				->where('status', 'active')
				->from('products');
		echo $this->datatables->generate();
	}

	
	
	public function cat($id)
	{
		
		$cat = $this->MCats->getCategory($id);
		
		if (!count($cat)){
			redirect('welcome/index','refresh');
		}
		
		$data['title'] = "Parlons de ". $cat['name'];
					
		/*load the model and get results*/
		$data['categories'] = $this->MCats->getCategoriesDropDown();
		$data['title'] = "Parlons Mahorais";
		/*Fin load the model and get results*/
		
		// pour pdfCreator
		$data['cat_id'] = $id;
		
		
		$data['category'] = $cat;
		
		$data['get_data_method'] = "index.php/welcome/getdatabyajax/".$id;
		$data['main'] = 'users/cattab';
		
		$data['navlist'] = $this->MCats->getCategoriesNav();

		$this->load->vars($data);
		$this->load->view('template');


	}

	
	
	public function getdatabyajax($cat_id)
	{

		$this->load->library('datatables');
		$this->datatables
				->select('id,mahorais,francais')
				->from('products')
				->where('status', 'active')
				->where('category_id', id_clean($cat_id));
			
		echo $this->datatables->generate();
	}
	
	
	
	
	public function product($id)
	{
		$product = $this->MProducts->getProduct($id);
		if (!count($product))
		{
			redirect('welcome/index','refresh');
		}
		
		$data['product'] = $product;
		$data['title'] = "Parlons ". $product['francais'];

		
		$data['mainf'] = $product;
		$skip = $data['mainf']['id'];
		$data['sidef'] = $this->MProducts->getRandomProducts(12);
		

		$data['main'] = 'product';
		$data['navlist'] = $this->MCats->getCategoriesNav();
		$this->load->vars($data);
		$this->load->view('template');
	}
	
	public function pages($path)
	{
	    $page = $this->MPages->getPagePath($path);
		$data['main'] = 'page';
		$data['title'] = $page['name'];
		$data['page'] = $page;
		$data['navlist'] = $this->MCats->getCategoriesNav();
		$this->load->vars($data);
		$this->load->view('template'); 
	}
	
	public function addCart($productid)
	{
		$user_id = $this->session->userdata('user_id');
		if ($user_id>0)
		{
			$this->MOrders->addCartInProfile($user_id, $productid);
			redirect('welcome/index', 'refresh');
		}
		
		else
		{	
			$this->session->set_flashdata('message', 'Loggez vous avant de vouloir utiliser le favoris.<br/>Ou enregistrez vous.');
			redirect('welcome/index', 'refresh');
		}
		redirect('welcome/cart', 'refresh');
		
	}
	
	
	
	public function removeCart($productid)
	{
		
		if ($this->session->userdata('user_id')>0)
		{
			$user_id = $this->session->userdata('user_id');
			
			// suppression
			$this->MOrders->removeCartFromProfile($user_id, $productid);
			redirect("welcome/cart", "refresh");
		}
		else
		{
			echo "error";
			die();
		}
	
	}
	
	public function cart()
	{
		
		
		if ($this->session->userdata('logged_in'))
		{
			// get profile
			$currentUserId = $this->session->userdata('user_id');
			
			$data['title'] = "Parlons Mahorais";
			/*Fin load the model and get results*/

		$data['get_data_method'] = "index.php/welcome/getfavorisdatabyajax/".$currentUserId;
		$data['main'] = 'users/favoris';
		$data['title'] = "Cherchons Mahorais";
		$data['navlist'] = $this->MCats->getCategoriesNav();
		$this->load->vars($data);
		$this->load->view('template'); 

		}
		else
		{
			echo "Vous n'etes pas connctŽ";
		}
		
	}
	
	public function getfavorisdatabyajax($user_id)
	{

		$this->load->library('datatables');
		$this->datatables
				->select('id,mahorais,francais')
				->from('products')
				->where('status', 'active')
				->add_column('Choix','<a href="#">Enlever</a>');
				
		echo $this->datatables->generate();
	}
	
	public function profile()
	{
		$this->session->set_flashdata('alert-info','En cours de developpement');
		redirect('welcome/index','refresh');
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */