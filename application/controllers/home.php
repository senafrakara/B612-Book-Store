<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// $this->load->library('cart'); 
	}

	public function index()
	{
	
		 $this->load->model('admin_model');
		 $view['categories'] = $this->admin_model->getCategory();

		$this->load->view('layouts/home_layout', $view);
	}
}