<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
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
        $view['countCartItems'] = $this->countCartItems();
        $view['isAnyProduct'] = FALSE;

        $this->form_validation->set_rules('name', 'Name', 'trim|required|strip_tags[name]');
        $this->form_validation->set_rules('name', 'Surname', 'trim|required|strip_tags[surname]');
        $this->form_validation->set_rules('contact', 'Contact', 'trim|numeric|required|strip_tags[contact]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|strip_tags[email]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|strip_tags[address]');
        $this->form_validation->set_rules('zipcode', 'Zip code or post code', 'trim|required|numeric|strip_tags[zipcode]');
        $this->form_validation->set_rules('city', 'City', 'trim|required|strip_tags[city]');
        $this->form_validation->set_rules('paymentcheck', 'Payment methods', 'trim|required');


        if (!$this->form_validation->run()) {
            if ($this->session->userdata('id')) {
                $this->load->model('user_model');
                if($this->user_model->getAllCartItems()){
                    $view['cartItems'] = $this->user_model->getAllCartItems();
                    $view['isAnyProduct'] = TRUE;
                }
                
            }
            $view['user_view'] = "users/checkout";
            $this->load->view('layouts/user_layout', $view);
        } else {
            if ($this->session->userdata('id')) {

                $this->load->model('user_model');
                $cartItems = $this->user_model->getAllCartItems();
                if($cartItems)
                {
                    $view['isAnyProduct'] = TRUE;
                } else {
                    $view['isAnyProduct'] = FALSE;
                }
                $total = 0;
                foreach ($cartItems as $cartItem) {
                    $this->load->model('admin_model');
                    $book =  $this->admin_model->getBookDetail($cartItem->book_id);
                    $total += $book->price *  $cartItem->qty;
                }
                $data = array(
                    'userId' => $this->session->userdata('id'),
                    'ship_name' => $this->input->post('name'),
                    'ship_surname' => $this->input->post('surname'),
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'email' => $this->input->post('email'),
                    'contact' => $this->input->post('contact'),
                    'zipcode' => $this->input->post('zipcode'),
                    'paymentcheck' => $this->input->post('paymentcheck'),
                    'total_price' => $total,
                );

                $this->load->model('user_model');
                $order = $this->user_model->addOrder($data);
                if ($order['complete']) {
                    foreach ($cartItems as $cartItem) {
                        $this->load->model('admin_model');
                        $book =  $this->admin_model->getBookDetail($cartItem->book_id);
                        $subtotal = $book->price *  $cartItem->qty;

                        $data = array(
                            'orderId' => $order['order_id'],
                            'bookId' => $cartItem->book_id,
                            'total_price' => $subtotal,
                            'quantity' => $cartItem->qty
                        );
                        $this->load->model('user_model');
                        $orderItem = $this->user_model->addOrderItem($data);
                    }
                    if ($orderItem) {
                        $this->load->model('user_model');
                        $this->user_model->deleteAllCartItems($this->session->userdata('id'));
                        $this->session->set_flashdata('success', 'Your order has been received. We will contact you soon');
                        //delete all cart items belongs to current user
                        redirect('checkout/orderFinish');
                    }
                }

                //kayıtlı kullanıcı order ve orderitem ekleme kısmı
            } else {
                $total = $this->cart->total();
                $data = array(
                    'ship_name' => $this->input->post('name'),
                    'ship_surname' => $this->input->post('surname'),
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'email' => $this->input->post('email'),
                    'contact' => $this->input->post('contact'),
                    'zipcode' => $this->input->post('zipcode'),
                    'paymentcheck' => $this->input->post('paymentcheck'),
                    'total_price' => $total,
                );
                $this->load->model('user_model');
                $order = $this->user_model->addOrder($data);

                if ($order['complete']) {

                    //order item a ekle şimdi
                    foreach ($this->cart->contents() as $book) {

                        $this->load->model('admin_model');
                        $book2 =  $this->admin_model->getBookDetail($book['id']);

                        $data = array(
                            'orderId' => $order['order_id'],
                            'bookId' => $book2->id,
                            'total_price' => $book['subtotal'],
                            'quantity' => $book['qty']
                        );

                        $this->load->model('user_model');
                        $orderItem = $this->user_model->addOrderItem($data);
                        if ($orderItem) {
                            $this->session->set_flashdata('success', 'Your order has been received. We will contact you soon');
                        }
                    }
                    $this->cart->destroy();
                    redirect('checkout/orderFinish');
                }
            }
        }
    }

    public function orderFinish()
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $view['countCartItems'] = $this->countCartItems();

        $view['user_view'] = "users/orderPlace";
        $this->load->view('layouts/user_layout', $view);
    }

    private function countCartItems()
    {
        if ($this->session->userdata('id')) {
            $this->load->model('user_model');
            $countCartItems = $this->user_model->getCartItemCount();
            return $countCartItems->count;
        }
    }
}
