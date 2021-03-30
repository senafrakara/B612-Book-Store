<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('cart');
	}

	public function index()
	{

		$this->load->model('admin_model');
		$view['categories'] = $this->admin_model->getCategory();

		$this->load->model('user_model');
		$view['recentBooks'] = $this->user_model->recentBooks();


		$this->load->model('user_model');
		$view['literatureBooks'] = $this->user_model->literatureBooks();

		$this->load->model('user_model');
		$view['scienceBooks'] = $this->user_model->scienceBooks();

		$this->load->model('user_model');
		$view['novelBooks'] = $this->user_model->novelBooks();

		if($this->session->userdata('id'))
		{
			$view['countCartItems'] = $this->countCartItems();
		}
		$this->load->view('layouts/home_layout', $view);
	}

	private function countCartItems()
    {
        if($this->session->userdata('id'))
        {
            $this->load->model('user_model');
            $countCartItems = $this->user_model->getCartItemCount();
            return $countCartItems;

        }
    }

}
