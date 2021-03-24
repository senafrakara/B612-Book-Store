<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $user_type = $this->session->userdata('type');

        if ($user_type != 'A') {
            $this->session->set_flashdata('no_access', '<i class="fas fa-exclamation-triangle"></i> You are not allowed or not logged in! Please login with the admin account');
            redirect('users/login');
        }
        $this->load->library('cart');
    }

    public function index()
    {
        $this->load->model('admin_model');
        $view['admin_view'] = "admin/index_admin";
        $this->load->view('layouts/admin_layout', $view);
    }

    public function allBooks()
    {
        $this->load->model('admin_model');
        $this->load->library('pagination');

        $config = [
            'base_url' => base_url('admin/books'),
            'per_page' => 10,
            'total_rows' => $this->admin_model->booksNumRows(),
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

        $this->load->model('admin_model');
        $view['books'] = $this->admin_model->getBooks($config['per_page'], $this->uri->segment(3));

        $view['admin_view'] = "admin/allBooks";
        $this->load->view('layouts/admin_layout', $view);
    }

    public function addBook()
    {
        $this->load->model('admin_model');
        $view['category'] = $this->admin_model->getCategory();

        $config = [
            'upload_path' => './uploads/image/',
            'allowed_types' => 'jpg|png|jpeg|jpe|jfif',
            'max_size' => '800',
            'overwrite' => FALSE
        ];

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('book_name', 'Book name', 'trim|required|strip_tags[book_name]');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[100]|strip_tags[description]');
        $this->form_validation->set_rules('author', 'Author name', 'trim|required|strip_tags[author]');
        $this->form_validation->set_rules('publisher', 'Publisher name', 'trim|required|strip_tags[publisher]');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|strip_tags[price]');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric|strip_tags[quantity]');
        $this->form_validation->set_rules('categoryId', 'Category', 'trim|required');


        if ($this->form_validation->run() == FALSE) {

            $view['admin_view'] = "admin/addBook";
            $this->load->view('layouts/admin_layout', $view);
        } else {

            
            $dataImg = $this->uploadFile($config, 'userfile');
            $image_path = base_url("uploads/image/" . $dataImg['raw_name'] . $dataImg['file_ext']);

            $data = array(
                'book_name' => $this->input->post('book_name'),
                'description' => $this->input->post('description'),
                'author' => $this->input->post('author'),
                'publisher' => $this->input->post('publisher'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
                'categoryId' => $this->input->post('categoryId'),
                'book_image' => $image_path,
                'status' => $this->input->post('status')
            );

            $this->load->model('admin_model');

            if ($this->admin_model->addBook($data)) {
                $this->session->set_flashdata('success', 'Book added successfully');
                redirect('admin/allBooks');
            } else {
                $this->session->set_flashdata('error', 'Book could not added!');
                redirect('admin/allBooks');
            }
        }
    }

    public function bookDetail($id)
    {
        $this->load->model('admin_model');
        $view['book_detail'] = $this->admin_model->getBookDetail($id);

        if ($this->admin_model->getBookDetail($id)) {
            $view['admin_view'] = 'admin/bookDetail';
            $this->load->view('layouts/admin_layout', $view);
        } else {
            $view['admin_view'] = "include/404";
            $this->load->view('layouts/admin_layout', $view);
        }
    }

    public function editBook($id)
    {
        $this->load->model('admin_model');
        $view['category'] = $this->admin_model->getCategory();

        $view['book_detail'] = $this->admin_model->getBookDetail($id);

        $config = [
            'upload_path' => './uploads/image/',
            'allowed_types' => 'jpg|png|jpeg|jpe|jfif',
            'max_size' => '800',
            'overwrite' => TRUE
        ];

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('book_name', 'Book name', 'trim|required|strip_tags[book_name]');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[100]|strip_tags[description]');
        $this->form_validation->set_rules('author', 'Author name', 'trim|required|strip_tags[author]');
        $this->form_validation->set_rules('publisher', 'Publisher name', 'trim|required|strip_tags[publisher]');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|strip_tags[price]');
        $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric|strip_tags[quantity]');
        $this->form_validation->set_rules('categoryId', 'Category', 'trim|required');
     

        if (!$this->form_validation->run()) {


            $book_view = $this->admin_model->getBookDetail($id);
            if ($book_view) {
                $view['admin_view'] = "admin/updateBook";
                $this->load->view('layouts/admin_layout', $view);
            } else {
                $view['admin_view'] = "include/404";
                $this->load->view('layouts/admin_layout', $view);
            }
        } else {

            $dataImg = $this->uploadFile($config, 'userfile');
            $image_path = base_url("uploads/image/" . $dataImg['raw_name'] . $dataImg['file_ext']);
           
            if (!empty($_FILES['userfile']['name'])) {

                $data = array(
                    'book_name' => $this->input->post('book_name'),
                    'description' => $this->input->post('description'),
                    'author' => $this->input->post('author'),
                    'publisher' => $this->input->post('publisher'),
                    'price' => $this->input->post('price'),
                    'quantity' => $this->input->post('quantity'),
                    'categoryId' => $this->input->post('categoryId'),
                    'book_image' => $image_path,
                    'status' => $this->input->post('status')

                );
            } else {
                $data = array(
                    'book_name' => $this->input->post('book_name'),
                    'description' => $this->input->post('description'),
                    'author' => $this->input->post('author'),
                    'publisher' => $this->input->post('publisher'),
                    'price' => $this->input->post('price'),
                    'quantity' => $this->input->post('quantity'),
                    'categoryId' => $this->input->post('categoryId'),
                    'status' => $this->input->post('status')
                );
            }


            $this->load->model('admin_model');

            if ($this->admin_model->updateBook($data, $id)) {
                $this->session->set_flashdata('success', 'Book updated successfully');
                redirect('admin/allBooks');
            } else {
                $this->session->set_flashdata('error', 'Book could not updated!');
                redirect('admin/allBooks');
            }
        }
    }

    public function deleteBook($id)
    {
        $this->load->model('admin_model');
        $this->admin_model->deleteBook($id);

        $this->session->set_flashdata('success', '<i class= "fas fa-trash text-danger"></i> Book deleted successfully');
        redirect('admin/allBooks');
    }


    public function getCategories()
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();

        $view['admin_view'] = "admin/allCategories";
        $this->load->view('layouts/admin_layout', $view);
    }

    public function categoryDetail($id)
    {
        $this->load->model('admin_model');
        $view['catDetail'] = $this->admin_model->getCategoryDetail($id);

        if ($this->admin_model->getCategoryDetail($id)) {
            $view['admin_view'] = "admin/categoryDetail";
            $this->load->view('layouts/admin_layout', $view);
        } else {
            $view['admin_view'] = "include/404";
            $this->load->view('layouts/admin_layout', $view);
        }
    }

    public function editCategory($id)
    {
        $this->load->model('admin_model');
        $view['catDetail'] = $this->admin_model->getCategoryDetail($id);

        $this->form_validation->set_rules('category', 'Category name', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('tag', 'Category tag', 'trim|required|alpha|strip_tags[tag]');
        $this->form_validation->set_rules('description', 'Description', 'trim|strip_tags[description]');


        if ($this->form_validation->run() == FALSE) {

            if ($this->admin_model->getCategoryDetail($id)) {

                $view['admin_view'] = "admin/updateCategory";
                $this->load->view('layouts/admin_layout', $view);
            } else {

                $view['admin_view'] = "include/404";
                $this->load->view('layouts/admin_layout', $view);
            }
        } else {

            $this->load->model('admin_model');
            $data = array(
                'category' => $this->input->post('category'),
                'description' => $this->input->post('description'),
                'tag' => $this->input->post('tag')
            );

            if ($this->admin_model->updateCategory($id, $data)) {
                $this->session->set_flashdata('success', 'Category Updated successfully');
                redirect('admin/getCategories');
            } else {
                $this->session->set_flashdata('error', 'Category could not updated! Please try again!');
                redirect('admin/getCategories');
            }
        }
    }

    public function deleteCategory($id)
    {
        $this->load->model('admin_model');
        $this->admin_model->deleteCategory($id);

        $this->session->set_flashdata('success', '<i class= "fas fa-trash text-danger"></i> Category deleted successfully');
        redirect('admin/getCategories');
    }

    public function addCategory()
    {
        $this->form_validation->set_rules('category', 'Category name', 'trim|required|alpha_numeric_spaces');
        $this->form_validation->set_rules('tag', 'Category tag', 'trim|required|alpha|strip_tags[tag]');
        $this->form_validation->set_rules('description', 'Description', 'trim|strip_tags[description]');

        if ($this->form_validation->run() == FALSE) {
            $view['admin_view'] = "admin/addCategory";
            $this->load->view("layouts/admin_layout", $view);
        } else {
            $data = array(

                'category' => $this->input->post('category'),
                'description' => $this->input->post('description'),
                'tag' => $this->input->post('tag')
            );

            $this->load->model('admin_model');

            if ($this->admin_model->createCategory($data)) {
                $this->session->set_flashdata('success', 'Category is added successfully');
                redirect("admin/getCategories");
            } else {
                $this->session->set_flashdata('error', 'Category could not added, please try again!');
                redirect("admin/getCategories");
            }
        }
    }

    public function getAllUser()
    {
        $this->load->model('admin_model');
        $view['users'] = $this->admin_model->getUsers();


        $view['admin_view'] = "admin/allUsers";
        $this->load->view('layouts/admin_layout', $view);
    }

    public function deleteUser($id)
    {
        $this->load->model('admin_model');
        if ($this->admin_model->deleteUser($id)) {
            $this->session->set_flashdata('success', '<i class= "fas fa-trash text-danger"></i> User deleted successfully!');
            redirect('admin/allUsers');
        } else {
            $this->session->set_flashdata('error', '<i class= "fas fa-trash text-danger"></i> User could not deleted, try again!!');
            redirect('admin/allUsers');
        }
    }

    public function addUser()
    {

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
        $this->form_validation->set_rules('type', 'Type', 'trim|required');


        if ($this->form_validation->run() == FALSE) {
            $view['admin_view'] = "admin/addUser";
            $this->load->view('layouts/admin_layout', $view);
        } else {
            $this->load->model('admin_model');
            $options = ['cost' => 12];
            $encripted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);

            $data = array(

                'name'    => $this->input->post('name'),
                'surname'    => $this->input->post('surname'),
                'contact'    => $this->input->post('contact'),
                'email'    => $this->input->post('email'),
                'password' => $encripted_pass,
                'type' => $this->input->post('type')

            );

            if ($this->admin_model->createUser($data)) {
                $this->session->set_flashdata('success', 'User is registered successfully!');
                redirect('admin/getAllUser');
            } else {
                $this->session->set_flashdata('error', 'User could not added! Try again!');
                redirect('admin/getAllUser');
            }
        }
    }

    public function allEBooks()
    {
        $this->load->model('admin_model');
        $view['ebooks'] = $this->admin_model->getEBooks();

        $view['admin_view'] = "admin/allEbooks";
        $this->load->view("layouts/admin_layout", $view);
    }

    public function addEBook()
    {
        $this->load->model('admin_model');
        $view['category'] = $this->admin_model->getCategory();

        
        $a = array();

        $config_img = [
            'upload_path' => './uploads/image/',
            'allowed_types' => 'jpg|png|jpeg|jpe|jfif',
            'overwrite' => FALSE
        ];
        $config_file = [
            'upload_path' => './uploads/files_ebook/',
            'allowed_types' => 'pdf',
            'overwrite' => FALSE
        ];


        $this->form_validation->set_rules('ebook_name', 'Book Name', 'trim|required|strip_tags[book_name]');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[100]|strip_tags[description]');
        $this->form_validation->set_rules('author', 'Author Name', 'trim|required|alpha_numeric_spaces|strip_tags[author]');
        $this->form_validation->set_rules('categoryId', 'Category', 'trim|required');

        if (!$this->form_validation->run() && $this->upload->do_upload() == FALSE) 
        {

            $view['admin_view'] = "admin/addEBook";
            $this->load->view('layouts/admin_layout', $view);
        } else
        {

            $a = [
                '1' => $this->uploadFile($config_img, 'userfile2'),
                '2' => $this->uploadFile($config_file, 'userfile3')
            ];

            $file_path = base_url("uploads/files_ebook/" . $a['2']['raw_name'] . $a['2']['file_ext']);
            $img_path = base_url("uploads/image/" . $a['1']['raw_name'] . $a['1']['file_ext']);

             $data = array(
                 'ebook_name' => $this->input->post('ebook_name'),
                 'description' => $this->input->post('description'),
                 'author' => $this->input->post('author'),
                 'categoryId' => $this->input->post('categoryId'),
                 'book_file' => $file_path,
                 'book_image' => $img_path,
             );

             $this->load->model('admin_model');
             if ($this->admin_model->addEBook($data)) {
                 $this->session->set_flashdata('success', 'Book added successfully');
                 redirect('admin/allEBooks');
             } else {
                 $this->session->set_flashdata('error', 'Book could not added!');
                 redirect('admin/allEBooks');
             }
        }
    }

    public function ebookDetail($id)
    {
        $this->load->model('admin_model');
        $view['ebookDetail'] = $this->admin_model->getEBookDetail($id);

        if($this->admin_model->getEBookDetail($id))
		{
			$view['admin_view'] = "admin/eBookDetail";
			$this->load->view('layouts/admin_layout', $view);
		}
		else
		{
			$view['admin_view'] = "include/404";
			$this->load->view('layouts/admin_layout', $view);
		}

    }

    public function deleteEBook($id)
    {
		$this->load->model('admin_model');
		$this->admin_model->deleteEBook($id);

		$this->session->set_flashdata('success', '<i class= "fas fa-trash text-danger"></i> E-Book deleted successfully.');
		redirect('admin/allEBooks');
    }

    public function editEBook($id)
    {
        $this->load->model('admin_model');
        $view['category'] = $this->admin_model->getCategory();

        $view['ebookDetail'] = $this->admin_model->getEBookDetail($id);

        $a = array();

        $config_img = [
            'upload_path' => './uploads/image/',
            'allowed_types' => 'jpg|png|jpeg|jpe|jfif',
            'overwrite' => FALSE
        ];
        $config_file = [
            'upload_path' => './uploads/files_ebook/',
            'allowed_types' => 'pdf',
            'overwrite' => FALSE
        ];


        $this->form_validation->set_rules('ebook_name', 'Book Name', 'trim|required|strip_tags[book_name]');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[100]|strip_tags[description]');
        $this->form_validation->set_rules('author', 'Author Name', 'trim|required|alpha_numeric_spaces|strip_tags[author]');
        $this->form_validation->set_rules('categoryId', 'Category', 'trim|required');
     

        if (!$this->form_validation->run()) {


            $ebook_view = $this->admin_model->getEBookDetail($id);
            if ($ebook_view) {
                $view['admin_view'] = "admin/updateEBook";
                $this->load->view('layouts/admin_layout', $view);
            } else {
                $view['admin_view'] = "include/404";
                $this->load->view('layouts/admin_layout', $view);
            }
        } else {

            $a = [
                '1' => $this->uploadFile($config_img, 'userfile2'),
                '2' => $this->uploadFile($config_file, 'userfile3')
            ];

            $file_path = base_url("uploads/files_ebook/" . $a['2']['raw_name'] . $a['2']['file_ext']);
            $img_path = base_url("uploads/image/" . $a['1']['raw_name'] . $a['1']['file_ext']);


            if (!empty($_FILES['userfile2']['name'])) 
            {

                $data = array(
                    'ebook_name' => $this->input->post('ebook_name'),
                    'description' => $this->input->post('description'),
                    'author' => $this->input->post('author'),
                    'categoryId' => $this->input->post('categoryId'),
                    'book_image' => $img_path,
                );

            } elseif(!empty($_FILES['userfile3']['name']))
            {

                $data = array(
                    'ebook_name' => $this->input->post('ebook_name'),
                    'description' => $this->input->post('description'),
                    'author' => $this->input->post('author'),
                    'categoryId' => $this->input->post('categoryId'),
                    'book_file' => $file_path,
                );

            } else 
            {
                $data = array(
                    'ebook_name' => $this->input->post('ebook_name'),
                    'description' => $this->input->post('description'),
                    'author' => $this->input->post('author'),
                    'categoryId' => $this->input->post('categoryId'),
                );
            }


            $this->load->model('admin_model');

            if ($this->admin_model->updateEBook($data, $id)) {
                $this->session->set_flashdata('success', 'E-Book updated successfully');
                redirect('admin/allEBooks');
            } else {
                $this->session->set_flashdata('error', 'E-Book could not updated!');
                redirect('admin/allEBooks');
            }
        }
    }

    public function uploadFile($data = array(), $filename)
    {
        $this->upload->initialize($data);
  

        if ($this->upload->do_upload($filename)) {
            $a = $this->upload->data();
        } else {
            $a = $this->upload->display_errors();
        }
        return $a;
    }


}
