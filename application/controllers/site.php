<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Parlons ChimaorŽ
 * @package		lexique
 * @author		ABDULLATIF Mouhamadi
 * @copyright	Copyright (c) 2012, ABDULLATIF, Inc. (http://ellislab.com/)
 */

class Site extends CI_Controller {

	function Welcome()
	{
		parent::__construct();

	}
	
	public function index()
	{
		echo "salut";
	}

}