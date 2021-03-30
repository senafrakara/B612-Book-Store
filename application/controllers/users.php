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
        if ($this->session->userdata('logged_in') == TRUE) {
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
            $view['countCartItems'] = $this->countCartItems();

            $view['user_view'] = "users/registration";
            $this->load->view('layouts/user_layout', $view);
        } else {
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

            if ($this->user_model->add_user($data)) {
                $this->session->set_flashdata('reg_success', 'Your Registration is successfull.');
                redirect('users/login');
            } else {

                $this->session->set_flashdata('reg_fail', 'Oops! Error.  Please try again later!!!');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    public function login()
    {
        if ($this->session->userdata('logged_in') == TRUE) {
            $this->session->set_flashdata('login_success', 'You are logged in!');
            redirect('home');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[3]');

        if ($this->form_validation->run() == FALSE) {

            $this->load->model('admin_model');
            $view['categories'] = $this->admin_model->getCategory();
            $view['countCartItems'] = $this->countCartItems();
            $view['user_view'] = "users/login";
            $this->load->view('layouts/user_layout', $view);
        } else {
            $this->load->model('user_model');

            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->user_model->login($email, $password);

            if ($user) {

                $login_data = array(
                    'user_data' => $user,
                    'id'        => $user->id,
                    'email'        => $email,
                    'type'        => $user->type,
                    'name'        => $user->name,
                    'surname'   => $user->surname,
                    'logged_in'    => true
                );

                $this->session->set_userdata($login_data);
                $user_id = $user->id;
                if ($this->cart->contents()) //if there are some items in cart, then add them into cart item, if there some cart items belongs to this user, and cart content with same book id, update qty in cart item onyl
                {

                    foreach ($this->cart->contents() as $books) {
                        $data = array(
                            'book_id' => $books['id'],
                            'user_id' => $user_id,
                            'qty' => $books['qty']
                        );

                        $this->load->model('admin_model');
                        $book = $this->admin_model->getBookDetail($books['id']);
                        if ($book) {
                            $bookQuantity = $book->quantity;
                            //burada önce bu kullanıcıya ait olan cart item ların içinde book_id li var mı yok mu kontrol et
                            //varsa onun qty sini update et
                            //yoks yenisini ekle.
                            $this->load->model('user_model');
                            $check_cartItem = $this->user_model->getCartItem($books['id'], $user_id);
                            if ($check_cartItem) //eğer böyle bir cart item varsa qty sini content içindekini ekleyerek güncelle
                            {
                                $this->load->model('user_model');
                                $totalQuantity = $check_cartItem->qty + $books['qty'];
                                if ($totalQuantity < $bookQuantity) //if there is enough stock for that book in the cart content, then add it into cart items
                                {
                                    $this->user_model->updateCartItemQTY($check_cartItem->id, $check_cartItem->qty, $books['qty']);
                                }
                                   
                            } else {
                                //direkt cart item a ekle eğer o kitap benim cart itemlarım arasında yoksa
                                $this->load->model('user_model');
                                $this->user_model->addCartItem($data);
                            }
                        }
                    }
                    $this->cart->destroy();
                }

                if ($user->type == 'A') {

                    redirect('admin/index');
                } elseif ($user->type == 'U') {
                    redirect('home');
                }
            } else {
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
        if ($bookCount != 0) {
            $view['books'] = $this->user_model->getBooks($config['per_page'], $this->uri->segment(3));
            $view['countCartItems'] = $this->countCartItems();
            $view['user_view'] = "users/allBooks";
            $this->load->view('layouts/user_layout', $view);
        } else {
            $view['countCartItems'] = $this->countCartItems();
            $view['user_view'] = "include/404product";
            $this->load->view('layouts/user_layout', $view);
        }
    }

    public function bookDetail($id)
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $view['countCartItems'] = $this->countCartItems();
        $this->form_validation->set_rules('comment', 'Comment', 'trim|required|min_length[10]|xss_clean');

        $data = array(
            'book_id' => $id,
            'user_id' => $this->session->userdata('id')
        );

        if (!$this->form_validation->run()) {
            $this->load->model('admin_model');
            $view['bookDetail'] = $this->admin_model->getBookDetail($id);

            $this->load->model('user_model');
            $view['comments'] = $this->user_model->getComments($id);
            $view['isFavorite'] = $this->user_model->isInFavoriteList($data);
           
            if ($this->admin_model->getBookDetail($id)) {
                $view['user_view'] = "users/bookDetail";
                $this->load->view('layouts/user_layout', $view);
            } else {
                $view['user_view'] = "include/404";
                $this->load->view('layouts/user_layout', $view);
            }
        } else {
            $data = array(
                'comment' => $this->input->post('comment'),
                'userId' => $this->session->userdata('id'),
                'bookId' => $id
            );

            $this->load->model('user_model');
            if ($this->user_model->addComment($data)) {
                $this->session->set_flashdata('success', 'Comment added successfully!');
                redirect('users/bookDetail/' . $id . ''); //when user makes a comment 
            } else {
                $this->session->set_flashdata('error', 'Comment could not added!');
                redirect('users/bookDetail/' . $id . '');
            }
        }
    }

    public function allEBooks()
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $view['countCartItems'] = $this->countCartItems();

        $this->load->model('user_model');
        $bookCount = $this->user_model->getEBooks();
        if ($bookCount != 0) {
            $this->load->model('user_model');
            $view['eBooks'] = $this->user_model->getEBooks();

            $view['user_view'] = "users/allEBooks";
            $this->load->view('layouts/user_layout', $view);
        } else {
            $view['user_view'] = "include/404product";
            $this->load->view('layouts/user_layout', $view);
        }
    }

    public function eBookDetail($id)
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $view['countCartItems'] = $this->countCartItems();

        $this->load->model('user_model');

        $view['eBookDetail'] = $this->user_model->getEBookDetail($id);

        if ($this->user_model->getEBookDetail($id)) {
            $view['user_view'] = "users/eBookDetail";
            $this->load->view('layouts/user_layout', $view);
        } else {
            $view['user_view'] = "include/404";
            $this->load->view('layouts/user_layout', $view);
        }
    }


    public function deleteComment($id)
    {
        $view['countCartItems'] = $this->countCartItems();
        $this->load->model('user_model');
        $this->user_model->deleteComment($id);

        $this->session->set_flashdata('success', '<i class= "fas fa-trash text-danger"></i> Comment deleted successfully');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function search()
    {
        $view['countCartItems'] = $this->countCartItems();
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();

        $this->form_validation->set_rules('search', "Search", 'trim|required|strip_tags[search_book]');
        if (!$this->form_validation->run()) {
            redirect('home');
        } else {
            $search = $this->input->post('search');
            $this->load->model('user_model');

            $result = $this->user_model->search($search);

            if ($result == 0) {

                $view['user_view'] = 'include/404nosearch';
                $this->load->view('layouts/user_layout', $view);
            } else {
                $this->load->model('user_model');
                $view['books'] = $this->user_model->search($search);
                $view['user_view'] = 'users/searchView';
                $this->load->view('layouts/user_layout', $view);
            }
        }
    }

    public function aboutUs()
    {
        $view['countCartItems'] = $this->countCartItems();
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $view['user_view'] = 'include/aboutUs';
        $this->load->view('layouts/user_layout', $view);
    }

    public function contactUs()
    {
        $view['countCartItems'] = $this->countCartItems();
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();


        $this->load->library('email');
        $this->load->library('form_validation');


        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[6]|max_length[60]');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[12]|max_length[200]');


        if ($this->form_validation->run() === FALSE) {
            $view['user_view'] = 'users/contactUs';
            $this->load->view('layouts/user_layout', $view);
        } else {


            $name = $this->input->post('name');
            $from_email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            $isSent = $this->sendMailContactUs($from_email, $subject, $message);

            if ($isSent) {
                $this->session->set_flashdata('msg', 'We received your email, We will reply to your e-mail soon!');

                redirect('users/contactUs');
            } else {
                $this->session->set_flashdata('msg_fail', 'Mail could not sent, please try again!');
                $view['user_view'] = 'users/contactUs';

                $this->load->view('layouts/user_layout', $view);
            }
        }
    }

    private function sendMailContactUs($from_email, $subject, $message)
    {
        
        $this->load->library('email');
        $config = array(
            "protocol"  => "smtp",
            "smtp_host" => "smtp.googlemail.com",
            "smtp_crypto" => "tls",
            "smtp_port" => "587",
            "smtp_user" => "senafrakara@gmail.com",
            "smtp_pass" => "*Passw0rd#2009",
            "charset" => "utf-8",
            "mail_type" => "html",
            "wordwrap" => true,
            "newline" => "\r\n",
        );

        $this->email->initialize($config);
        $this->email->to($from_email);
        $this->email->from('senafrakara@gmail.com');
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->set_header('Content-Type', 'text/html');
        return $this->email->send();
    }

    public function ForgotPassword()
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();

        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required|valid_email|xss_clean',
            array(
                'required' => 'Email field can not be empty'
            )
        );

        if (!$this->form_validation->run()) {

            $view['user_view'] = "users/password_reset_form";
            $this->load->view('layouts/user_layout', $view);
        } else {

            $email = $this->input->post('email');

            $this->load->model('user_model');
            $user = $this->user_model->userCheck($email);

            if ($user) {

                $hash = md5($this->config->item('salt'));
                $date = date('Y-m-d H:i:s');

                $this->load->model('user_model');

                if ($this->user_model->addResetToken($user->id, $hash, $date)) {

                    $this->sendMaill($email, $user->name, $hash);
                    $view['user_view'] = "users/password_reset_done";
                    $this->load->view('layouts/user_layout', $view);
                } else {
                }
            } else {
                $this->session->set_flashdata('no_access', ' Email not found!');
                redirect(base_url('users/login'));
            }
        }
    }



    public function checkResetPassword()
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();

        $this->form_validation->set_rules('newpass', 'New Password', 'trim|required|min_length[3]|xss_clean');
        $this->form_validation->set_rules(
            'cnewpass',
            'Confirm Password',
            'trim|required|min_length[3]|matches[newpass]'
        );
        if (!$this->form_validation->run()) {

            $view['user_view'] = "users/password_reset_confirm";
            $this->load->view('layouts/user_layout', $view);
        } else {

            $email = $_GET['email'];
            $token = $_GET['token'];
            $this->load->model('user_model');

            $token_created_at = $this->user_model->verify_user($email, $token);

            if ($token_created_at) {

                if ($this->__validToken($token_created_at->token_created_at)) {
                    $options = ['cost' => 12];
                    $encripted_pass = password_hash($this->input->post('newpass'), PASSWORD_BCRYPT, $options);

                    $data = array(
                        'password' => $encripted_pass,
                    );

                    $this->load->model('user_model');
                    $changePwd = $this->user_model->changePassword($email, $data);
                    if ($changePwd) {
                        $view['user_view'] = "users/password_reset_complete";
                        $this->load->view('layouts/user_layout', $view);
                    } else {
                        $this->session->set_flashdata('no_access', ' The password could not reset!');
                        redirect(base_url('users/login'));
                    }
                } else {
                    $this->session->set_flashdata('no_access', ' The password reset request has either expired or is invalid.');
                    redirect(base_url('users/login'));
                }
            }
        }
    }

    private function __validToken($token_created_at)
    {
        $expired = strtotime($token_created_at) + 86400;
        $time = strtotime("now");
        if ($time < $expired) {
            return TRUE;
        }
        return FALSE;
    }

    public function sendMaill($email, $name, $hash)
    {
        $this->load->library('email');
        $config = array(
            "protocol"  => "smtp",
            "smtp_host" => "smtp.googlemail.com",
            "smtp_crypto" => "tls",
            "smtp_port" => "587",
            "smtp_user" => "senafrakara@gmail.com",
            "smtp_pass" => "*Passw0rd#2009",
            "charset" => "utf-8",
            "mail_type" => "html",
            "wordwrap" => true,
            "newline" => "\r\n",
        );

        $this->email->initialize($config);
        $this->email->to($email);
        $this->email->from('senafrakara@gmail.com');
        $this->email->subject('Reset password for B612 Book Store;');
        $this->email->message("Dear " . $name . ", you are receiving this email because you requested a password reset for your user account at B612 Book Store." . "\n" .
            "Please go to the following page and choose a new password: <a href=" . base_url('users/checkResetPassword/') . "?email=" . $email . "&token=" . $hash . ">Click here</a>  .");


        $this->email->set_header('Content-Type', 'text/html');

        $this->email->send();
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

    // private function __generateToken($uid)
    // {
    //     if (empty($uid)) {
    //         return null;
    //     }

    //     // Generate a random string 100 chars in length.
    //     $token = "";
    //     for ($i = 0; $i < 100; $i++) {
    //         $d = rand(1, 100000) % 2;
    //         $d ? $token .= chr(rand(33, 79)) : $token .= chr(rand(80, 126));
    //     }

    //     (rand(1, 100000) % 2) ? $token = strrev($token) : $token = $token;

    //     // Generate hash of random string
    //     $hash = hash('sha256', $token, true);;
    //     for ($i = 0; $i < 20; $i++) {
    //         $hash = hash('sha256', $hash,  true);
    //     }

    //     $this->load->model('user_model');

    //     $date = date('Y-m-d H:i:s');

    //     $tokenData = array(
    //         'token' => $hash,
    //     );

    //     $this->session->set_userdata($tokenData);
    //     if ($this->user_model->addResetToken($uid, $date)) {
    //         $data = array(
    //             'success' => TRUE,
    //             'hash' => $hash
    //         );
    //         return $data;
    //     } else {

    //         return FALSE;
    //     }
    // }
}
