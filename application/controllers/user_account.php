<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_account extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$type = $this->session->userdata('type');
		if($type != 'U')
		{
			$this->session->set_flashdata('no_access', '<i class="fas fa-exclamation-triangle"></i> You are not allowed or not logged in! Please Log in with your account');
			redirect('users/login');
		}
		$this->load->library('cart');
	}

    public function index()
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();

        $uid = $this->session->userdata('id');
		$this->load->model('user_model');
		$view['user_detail'] = $this->user_model->getUser($uid);
		$view['user_view'] = "users/user_detail";
		$this->load->view('layouts/user_home', $view);
    }


    public function user_orders()
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $this->load->model('user_model');
        if($this->user_model->getOrders())
        {
            $view['orders'] = $this->user_model->getOrders();
            $view['user_view'] = "users/orders";
            $this->load->view('layouts/user_home', $view);	
        }
        else 
        {
            $view['user_view'] = "include/404order";
            $this->load->view('layouts/user_home', $view);
        }

    }
     public function orderDetail($id)
     {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $this->load->model('user_model');
        $order=  $this->user_model->getOrderDetail($id);
        $orderItems = $this->user_model->getOrderItems($id);
        if($order && $orderItems)
        {
            $view['orderDetail'] =$this->user_model->getOrderDetail($id);
            $view['orderItems'] =$this->user_model->getOrderItems($id);

            $view['user_view'] = "users/orderDetail";
			$this->load->view('layouts/user_home', $view);
        }
        else 
        {
            $view['user_view'] = "include/404order";
			$this->load->view('layouts/user_home', $view);
        }
        
     }



}