<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
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


        if ($this->session->userdata('id')) {
            $this->load->model('user_model');
            $view['cartItems'] = $this->user_model->getAllCartItems();
        }
        $view['user_view'] = "users/cart";
        $this->load->view('layouts/user_layout', $view);
    }

    public function addCart($id)
    {
        $this->load->model('admin_model');
        $view['categories'] = $this->admin_model->getCategory();
        $view['countCartItems'] = $this->countCartItems();

        $this->load->model('admin_model');
        $book = $this->admin_model->getBookDetail($id);

        if ($book) {
            $data = array(
                'id' => $book->id,
                'price' => $book->price,
                'name' => $book->book_name,
                'book_image' => $book->book_image,
                'qty' => 1
            );
            if ($book->quantity > 0) {

                if ($this->session->userdata('id')) {
                    $user_id = $this->session->userdata('id');

                    //kayıtlı kullanıcı sepete ekledi ilk, sonra aynısından aynı sayfada bi daha ekleyecek o zaman update cart item demen lazım

                    $this->load->model('user_model');
                    $cartItem = array(
                        'book_id' => $book->id,
                        'user_id' => $user_id,
                        'qty' => 1
                    );
                    $this->load->model('user_model');
                    $check_cartItem = $this->user_model->getCartItem($book->id, $user_id);
                    if ($check_cartItem) {
                        $this->load->model('user_model');
                        $this->user_model->updateCartItemQTY($check_cartItem->id, $check_cartItem->qty, 1);
                        redirect($_SERVER['HTTP_REFERER']);
                    } else {
                        $this->user_model->addCartItem($cartItem);
                        redirect($_SERVER['HTTP_REFERER']);
                    }
                } else {
                    $this->cart->product_name_rules = '[:print:]'; #...For inserting special char
                    $this->cart->insert($data);
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('not_enough', 'There is not enough stock.');
                redirect('cart');
            }
        }
    }


    public function deleteItem($id)
    {
        if ($this->cart->remove($id)) {
            $this->session->set_flashdata('remove_cart', 'Book removed from the cart.');
        }
        redirect('cart');
    }

    public function deleteCartItem($id)
    {
        $this->load->model('user_model');
        if ($this->user_model->deleteCartItem($id)) {
            $this->session->set_flashdata('remove_cart', 'Book removed from the cart.');
        }
        redirect('cart');
    }

    // public function updateCartContentItem()
    // {
    //     $this->load->model('admin_model');
    //     $contents = $this->input->post();
    //     foreach ($contents as $content) {
    //         $info = array(
    //             'rowid' => $content['rowid'],
    //             'qty' => $content['qty']
    //         );
    //         // if ($content['qty'] < 0) {
    //         //     $this->session->set_flashdata('cart_error', '<i class="fas fa-exclamation-triangle"></i> Quantity can not be less than 0 or negative value');
    //         // } else {
    //         //     if ($content['qty'] > 5) {
    //         //         $this->session->set_flashdata('cart_error', '<i class="fas fa-exclamation-triangle"></i> You can not buy more than 5 books at a time');
    //         //     } else {
    //         //         $this->cart->update($info);
    //         //     }
    //         // }
    //     }
    //     redirect('cart');
    // }

    private function countCartItems()
    {
        if ($this->session->userdata('id')) {
            $this->load->model('user_model');
            $countCartItems = $this->user_model->getCartItemCount();
            return $countCartItems->count;
        }
    }

    public function updateCartItemQuantity()
    {
        $newQuantity =  $_POST["new_quantity"];
        $cart_item_id = $_POST["cart_id"];
        $this->load->model('user_model');
        $this->user_model->updateCartQuantity($newQuantity, $cart_item_id);
    }

    public function updateCartContentItem()
    {
        $newQuantity =  $this->input->post('new_quantity');
        $cart_item_id =$this->input->post('row_id');
        $this->load->model('admin_model');
        $contents = $this->input->post();
        foreach ($this->cart->contents() as $content) {
            print $newQuantity;
            print $cart_item_id;
            die;
            if($content['rowid'] == $cart_item_id){
                $info = array(
                    'rowid' => $content['rowid'],
                    'qty' => $newQuantity
                );

                $this->cart->update($info);
            }
          
        }
    }
}
