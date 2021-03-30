<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_account extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $type = $this->session->userdata('type');
        if ($type != 'U') {
            $this->session->set_flashdata('no_access', '<i class="fas fa-exclamation-triangle"></i> You are not allowed or not logged in! Please Log in with your account');
            redirect('users/login');
        }
        $this->load->library('cart');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('login_fail', 'You are not allowed! Please log in!');
            redirect('home');
        }

        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $view['countCartItems'] = $this->countCartItems();

        $uid = $this->session->userdata('id');
        $this->load->model('user_model');
        $view['user_detail'] = $this->user_model->getUser($uid);
        $view['user_view'] = "users/user_detail";
        $this->load->view('layouts/user_home', $view);
    }


    public function user_orders()
    {
        if ($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('login_fail', 'You are not allowed! Please log in!');
            redirect('home');
        }

        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $view['countCartItems'] = $this->countCartItems();

        $this->load->model('user_model');
        if ($this->user_model->getOrders()) {
            $view['orders'] = $this->user_model->getOrders();
            $view['user_view'] = "users/orders";
            $this->load->view('layouts/user_home', $view);
        } else {
            $view['user_view'] = "include/404order";
            $this->load->view('layouts/user_home', $view);
        }
    }

    public function orderDetail($id)
    {
        if ($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('login_fail', 'You are not allowed! Please log in!');
            redirect('home');
        }

        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $view['countCartItems'] = $this->countCartItems();

        $this->load->model('user_model');
        $order =  $this->user_model->getOrderDetail($id);
        $orderItems = $this->user_model->getOrderItems($id);
        if ($order && $orderItems) {
            $view['orderDetail'] = $this->user_model->getOrderDetail($id);
            $view['orderItems'] = $this->user_model->getOrderItems($id);

            $view['user_view'] = "users/orderDetail";
            $this->load->view('layouts/user_home', $view);
        } else {
            $view['user_view'] = "include/404order";
            $this->load->view('layouts/user_home', $view);
        }
    }


    public function favoriteBook()
    {
        if ($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('login_fail', 'You are not allowed! Please log in!');
            redirect('home');
        }

        $data = array(
            'book_id' => $this->input->post('product_id'),
            'user_id' => $this->session->userdata('id')
        );

        $this->load->model('user_model');
        if ($this->user_model->isInFavoriteList($data)) {
            if ($this->user_model->removeFromFavoriteList($data)) {

                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('error', 'Something went wrong!Try Again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            if ($this->user_model->addFavoriteList($data)) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('error', 'Something went wrong!Try Again!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function allFavorites()
    {
        if ($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('login_fail', 'You are not allowed! Please log in!');
            redirect('home');
        }

        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $view['countCartItems'] = $this->countCartItems();

        $user = $this->session->userdata('id');

        $this->load->model('user_model');
        $bookCount = $this->user_model->getFavorites($user);
        if ($bookCount) {
            $this->load->model('user_model');
            $view['favorites'] = $this->user_model->getFavorites($user);

            $view['user_view'] = "users/favoriteList";
            $this->load->view('layouts/user_home', $view);
        } else {
            $view['user_view'] = "include/404favorite";
            $this->load->view('layouts/user_home', $view);
        }
    }

    public function editAccount()
    {

        if ($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('login_fail', 'You are not allowed! Please log in!');
            redirect('home');
        }

        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $view['countCartItems'] = $this->countCartItems();

        $user = $this->session->userdata('id');
        $this->load->model('user_model');
        $view['userDetail'] = $this->user_model->getUser($user);

        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[20]|xss_clean');
        $this->form_validation->set_rules('surname', ' Surname ', 'trim|required|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('contact', 'Contact', 'trim|required|numeric');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|valid_email|xss_clean',
            array(
                'required' => 'Email field can not be empty',
                'is_unique' => 'This email is already registered'
            )
        );

        if (!$this->form_validation->run()) {
            if ($this->user_model->getUser($user)) {
                $view['user_view'] = "users/editAccount";
                $this->load->view('layouts/user_home', $view);
            } else {
                $view['user_view'] = "include/404";
                $this->load->view('layouts/user_home', $view);
            }
        } else {
            $this->load->model('user_model');
            $userr = $this->user_model->getUser($user);
            if ($userr->email != $this->input->post('email')) {
                $user2 = $this->user_model->getUserWithEmail($this->input->post('email'));
                if ($user2) {
                    $this->session->set_flashdata('error', 'This email is already registered!');
                    redirect('user_account');
                }
            }

            $data = array(
                'name'    => $this->input->post('name'),
                'surname'    => $this->input->post('surname'),
                'contact'    => $this->input->post('contact'),
                'email'    => $this->input->post('email')
            );


            if ($this->user_model->updateUser($data)) {
                $this->session->set_flashdata('success', 'Your account updated successfully!');
                redirect('user_account');
            } else {
                $this->session->set_flashdata('error', 'Upps! Something went wrong, please try again!');
                redirect('user_account');
            }
        }
    }

    public function changePassword()
    {
        if ($this->session->userdata('logged_in') == FALSE) {
            $this->session->set_flashdata('login_fail', 'You are not allowed! Please log in!');
            redirect('home');
        }

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules(
            'repassword',
            'Confirm Password',
            'trim|required|min_length[3]|matches[password]'
        );
        $view['countCartItems'] = $this->countCartItems();
        if ($this->form_validation->run() == FALSE) {
            $this->load->model('admin_model');
            $view['categories'] = $this->admin_model->getCategory();
            $view['countCartItems'] = $this->countCartItems();

            $view['user_view'] = "users/editAccount";
            $this->load->view('layouts/user_layout', $view);
        } else {

            $this->load->model('user_model');
            $options = ['cost' => 12];
            $encripted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);

            $data = array(
                'password' => $encripted_pass

            );

            if ($this->user_model->updatePassword($data)) {
                $this->session->set_flashdata('login_success', 'Your password is changed!.');
                redirect('user_account');
            } else {

                $this->session->set_flashdata('login_fail', 'Oops! Error.  Please try again later!!!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    private function countCartItems()
    {
        if ($this->session->userdata('id')) {
            $this->load->model('user_model');
            $countCartItems = $this->user_model->getCartItemCount();
            return $countCartItems;
        }
    }
}
