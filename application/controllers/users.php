<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function  registration()
    {
        if ($this->session->userdata('logged_in') == TRUE) 
        {
            $this->session->set_flashdata('login_success', 'You are logged in!');
			redirect('home');
        }

        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[20]|xss_clean');
        $this->form_validation->set_rules('surname', ' Surname ', 'trim|required|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('contact', 'Contact', 'trim|required|numeric');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required|valid_email|is_unique[users.email]|xss_clean',
            array(
                'required' => 'Email field can not be empty',
                'is_unique' => 'This email is already registered'
            )
        );
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules(
            'repassword',
            'Confirm Password',
            'trim|required|min_length[3]|matches[password]'
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->model('admin_model');
            $view['categories'] = $this->admin_model->getCategory();

            $view['user_view'] = "users/registration";
            $this->load->view('layouts/user_layout', $view);
        } else 
        {
            $this->load->model('user_model');

            $options = ['cost' => 12];
            $encripted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);

            $data = array(

                'name'    => $this->input->post('name'),
                'surname'    => $this->input->post('surname'),
                'contact'    => $this->input->post('contact'),
                'email'    => $this->input->post('email'),
                'password' => $encripted_pass

            );

            if ($this->user_model->add_user($data))
            {
                $this->session->set_flashdata('reg_success', 'Your Registration is successfull.');
                redirect('users/login');
            } else 
            {
    
                $this->session->set_flashdata('reg_fail', 'Oops! Error.  Please try again later!!!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function login()
    {
        if ($this->session->userdata('logged_in') == TRUE) 
        {
            $this->session->set_flashdata('login_success', 'You are logged in!');
			redirect('home');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[3]');

        if($this->form_validation->run() == FALSE)
		{
		
            $this->load->model('admin_model');
            $view['categories'] = $this->admin_model->getCategory();

			$view['user_view'] = "users/login";
			$this->load->view('layouts/user_layout', $view);
		}
        else 
        {
            $this->load->model('user_model');

			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$user = $this->user_model->login($email, $password);

            if($user)
            {
                $login_data = array(
                    'user_data' =>$user,
                    'id'		=> $user->id,
					'email'		=> $email,
					'type'		=> $user->type,
					'name'		=> $user->name,
                    'surname'   => $user->surname,
					'logged_in'	=> true
                );

                $this->session->set_userdata($login_data);

                if($user->type == 'A')
                {
        
					redirect('admin/index');
                } elseif($user->type == 'U')
                {
					redirect('home');
                }
            } else 
            {
                $this->session->set_flashdata('login_fail', '<i class="fas fa-exclamation-triangle"></i> Invalid login. The email or password is incorrect. ');

				redirect($_SERVER['HTTP_REFERER']); 
            }

        }

    }

    public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');	
	}

    public function allBooks()
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();

        $this->load->model('user_model');
        $this->load->library('pagination');

        $config = [
            'base_url' => base_url('users/allBooks'),
            'per_page' => 10,
            'total_rows' => $this->user_model->booksNumRows(),
            'full_tag_open' => "<ul class='custom-pagination'>",
            'full_tag_close' => "</ul>",
            'first_tag_open' => '<li>',
            'first_tag_close' => '</li>',
            'last_tag_open' => '<li>',
            'last_link' => 'last',
            'last_tag_close' => '</li>',
            'next_tag_open' => '<li>',
            'next_tag_close' => '</li>',
            'prev_tag_open' => '<li>',
            'prev_tag_close' => '</li>',
            'cur_tag_open' => "<li class = 'active'><a>",
            'cur_tag_close' => '</a></li>',
        ];

        $this->pagination->initialize($config);

        $this->load->model('user_model');
        $bookCount = $this->user_model->getBooks($config['per_page'], $this->uri->segment(3));
        if($bookCount != 0)
        {
            $view['books'] = $this->user_model->getBooks($config['per_page'], $this->uri->segment(3));

            $view['user_view'] = "users/allBooks";
            $this->load->view('layouts/user_layout', $view);
        } else 
        {
            $view['user_view'] = "include/404product";
            $this->load->view('layouts/user_layout', $view);
        }
 
    }

    public function bookDetail($id)
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();

        $this->form_validation->set_rules('review', 'Review', 'trim|required|min_length[10]|xss_clean');
    
    
        if($this->form_validation->run() == FALSE)
        {
            $this->load->model('admin_model');
            $view['bookDetail'] = $this->admin_model->getBookDetail($id);

            $this->load->model('user_model');
            $view['comments'] = $this->user_model->getComments($id);

            if($this->admin_model->getBookDetail($id))
            {
                $view['user_view'] = "users/bookDetail";
				$this->load->view('layouts/user_layout', $view);
            } else 
            {
                $view['user_view'] = "include/404";
				$this->load->view('layouts/user_layout', $view);
            }
        } else{
            $data = array(
                'comment' => $this->input->post('comment'),
                'userId' => $this->session->userdata('id'),
                'bookId' => $id
            );

            $this->load->model('user_model');
			if($this->user_model->addComment($data))
            {
                $this->session->set_flashdata('success', 'Comment added successfully!');
                redirect('users/bookDetail/'.$id.''); //when user makes a comment 
            } else {
                $this->session->set_flashdata('error', 'Comment could not added!');
                redirect('users/bookDetail/'.$id.'');
            }
			
        }
    }

    public function allEBooks()
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();


        $this->load->model('user_model');
        $bookCount = $this->user_model->getEBooks();
        if($bookCount != 0)
        {
            $this->load->model('user_model');
            $view['eBooks'] = $this->user_model->getEBooks();

            $view['user_view'] = "users/allEBooks";
            $this->load->view('layouts/user_layout', $view);
        } else 
        {
            $view['user_view'] = "include/404product";
            $this->load->view('layouts/user_layout', $view);
        }

     
    }

    public function eBookDetail($id)
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();

        
        $this->load->model('user_model');

        $view['eBookDetail'] = $this->user_model->getEBookDetail($id);

        if($this->user_model->getEBookDetail($id))
        {
            $view['user_view'] = "users/eBookDetail";
			$this->load->view('layouts/user_layout', $view);
        } else
        {
            $view['user_view'] = "include/404";
			$this->load->view('layouts/user_layout', $view);
        }
    }


    public function deleteComment($id)
    {
        $this->load->model('user_model');
        $this->user_model->deleteComment($id);

        $this->session->set_flashdata('success', '<i class= "fas fa-trash text-danger"></i> Comment deleted successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function search()
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();

        $this->form_validation->set_rules('search', "Search",'trim|required|strip_tags[search_book]');
        if(!$this->form_validation->run())
        {
            redirect('home');
        } else 
        {
            $search = $this->input->post('search');
            $this->load->model('user_model');
            $view['books'] = $this->user_model->search($search);
            $view['user_view'] = 'users/searchView';
            $this->load->view('layouts/user_layout', $view);
        }
    }

}
