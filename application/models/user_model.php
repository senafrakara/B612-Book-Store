<?php

class user_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public $userTable = 'users';
    public $bookTable = 'books';
    public $catTable = 'category';
    public $ebooksTable = 'ebooks';
    public $comments = 'comments';
    public $orders = 'orders';
    public $orderItems = 'order_items';

    public function add_user($data)
    {
        $insert = $this->db->insert($this->userTable, $data);
        return $insert;
    }

    public function login($email, $pass)
    {
        $query = $this->db->get_where($this->userTable, array('email' => $email));
        if ($query->num_rows() > 0) {
            $db_password = $query->row('password');
            if (password_verify($pass, $db_password)) {
                return $query->row();
            } else {
                return false;
            }
        }
    }

    public function booksNumRows()
    {
        $this->db->select('*');
        $this->db->from($this->catTable);
        $this->db->join($this->bookTable, 'books.categoryId = category.id');
        $this->db->order_by('books.id', 'DESC');
        $this->db->where('books.status', '1');
        $books = $this->db->get();
        return $books->num_rows();
    }

    public function getBooks($num, $lastNum)
    {
        $this->db->select('books.id, books.book_name, books.description, books.author, books.publisher, books.quantity, books.price, books.book_image, category.category');
        $this->db->from($this->bookTable);
        $this->db->join($this->catTable, 'books.categoryId = category.id');

        if (isset($_GET['cat']) && $_GET['cat']) {
            $cat = $_GET['cat'];
            $this->db->where('category.tag', $cat);
            $this->db->order_by('books.id', 'DESC');
            $this->db->where('books.status', '1');
            $this->db->limit($num, $lastNum);
            $cat_books = $this->db->get();
            if ($cat_books->num_rows() == 0) {
                return 0;
            }
            return $cat_books->result();
        }

        $this->db->order_by('books.id', 'DESC');
        $this->db->where('books.status', '1');
        $this->db->limit($num, $lastNum);
        $allBooks = $this->db->get();
        if ($allBooks->num_rows() == 0) {
            return 0;
        }
        return $allBooks->result();
    }

    public function getComments($id)
    {
        $this->db->select('*');
        $this->db->from($this->userTable);
        $this->db->join($this->comments, 'comments.userId = users.id');
        $this->db->where('comments.bookId', $id);
        $this->db->order_by('comments.id', 'DESC');
        $reviews = $this->db->get();
        return $reviews->result();
    }

    public function deleteComment($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->comments);
    }


    public function getCommentsCommentField()
    {
        $this->db->select('*');
        $this->db->from($this->userTable);
        $this->db->join($this->comments, 'comments.userId = users.id');
        $this->db->where('comments.bookId', $this->uri->segment(3));
        $this->db->order_by('comments.id', 'DESC');
        $reviews = $this->db->get();
        return $reviews->result();
    }

    public function addComment($data)
    {

        $review = $this->db->insert($this->comments, $data);
        return $review;
    }

    public function getEBooks()
    {
        $this->db->select('*');
        $this->db->from($this->catTable);
        $this->db->join($this->ebooksTable, 'ebooks.categoryId = category.id');

        if (isset($_GET['cat']) && $_GET['cat']) {
            $cat = $_GET['cat'];
            $this->db->where('category.tag', $cat);
            $this->db->order_by('ebooks.id', 'DESC');
            $cat_books = $this->db->get();
            if ($cat_books->num_rows() == 0) {
                return 0;
            }
            return $cat_books->result();
        }

        $this->db->order_by('ebooks.id', 'DESC');
        $eBooks = $this->db->get();
        if ($eBooks->num_rows() == 0) {
            return 0;
        }
        return $eBooks->result();
    }

    public function getEBookDetail($id)
    {
        $this->db->select('ebooks.*, category.category');
        $this->db->from($this->ebooksTable);
        $this->db->join($this->catTable, 'ebooks.categoryId = category.id');
        $this->db->where('ebooks.id', $id);
        $ebook = $this->db->get();
        return $ebook->row();
    }

    public function recentBooks()
    {
        $this->db->select('*');
        $this->db->from($this->bookTable);
        $this->db->order_by('id', 'DESC');
        $this->db->where('status', 1);
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    public function scienceBooks()
    {
        $this->db->select('*');
        $this->db->from($this->bookTable);
        $this->db->order_by('id', 'DESC');
        $this->db->where('status', 1);
        $this->db->where('categoryId', '3');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }
    public function literatureBooks()
    {
        $this->db->select('*');
        $this->db->from($this->bookTable);
        $this->db->order_by('id', 'DESC');
        $this->db->where('status', 1);
        $this->db->where('categoryId', '1');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }
    public function novelBooks()
    {
        $this->db->select('*');
        $this->db->from($this->bookTable);
        $this->db->order_by('id', 'DESC');
        $this->db->where('status', 1);
        $this->db->where('categoryId', '5');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    public function getUser($uid)
    {
        $user = $this->db->get_where($this->userTable, array('id' => $uid));
        return $user->row();
    }

    public function getOrders()
    {
        $this->db->order_by('orderId', 'DESC');
        $orders = $this->db->get_where($this->orders, array('userId' => $this->session->userdata('id')));  
        return $orders->result();
    }

    public function getOrderDetail($id)
    {
        $this->db->select('orders.*, users.name, users.surname');
        $this->db->from($this->orders);
        $this->db->join($this->userTable, 'orders.userId=users.id');
        $this->db->where('orders.orderId', $id);
        $order= $this->db->get();
        return $order->row();
    }

    public function getOrderItems($orderID)
    {
        $this->db->select('books.id, books.book_name, books.price, books.book_image, order_items.total_price, order_items.quantity');
        $this->db->from($this->orderItems);
        $this->db->join($this->bookTable, 'order_items.bookId = books.id');
        $this->db->where('order_items.orderId', $orderID);
        $orderItems = $this->db->get();
       
        return $orderItems->result();
    }

    public function search($search)
    {
        $s = str_replace(" ", "|", $search);
        // $this->db->select("*");
        // $this->db->from($this->bookTable);
        // $this->db->where("book_name RLIKE '$query'");
        // $this->db->where("status", 1);
        // $this->db->or_where("author RLIKE '$query'");

        // $this->db->query('SELECT * FROM table_name1 UNION SELECT column_name(s) FROM table_name2');

        $query = "SELECT DISTINCT * FROM " . $this->bookTable . ", " . $this->ebooksTable . " WHERE books.book_name RLIKE ".$this->db->escape($s)." || ebooks.ebook_name RLIKE ".$this->db->escape($s)." || books.author RLIKE ".$this->db->escape($s)." || ebooks.author RLIKE ".$this->db->escape($s)."";

        $result =$this->db->query($query);

        return $result->result();
    }
}
