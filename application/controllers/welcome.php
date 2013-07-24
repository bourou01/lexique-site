<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Academic Free License version 3.0
 *
 * This source file is subject to the Academic Free License (AFL 3.0) that is
 * bundled with this package in the files license_afl.txt / license_afl.rst.
 * It is also available through the world wide web at this URL:
 * http://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2013, EllisLab, Inc. (http://ellislab.com/)
 * @license		http://opensource.org/licenses/AFL-3.0 Academic Free License (AFL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

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
			echo "Vous n'etes pas connêcté";
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
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 /*
	public function index()
	{
		$this->load->view('welcome_message');
	}
	*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */