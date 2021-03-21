<?php

class admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public $tableName = 'users';
    public $bookTable = 'books';
    public $catTable = 'category';
    public $ebooksTable= 'ebooks';


    public function booksNumRows() //for pagination
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
		$this->db->order_by('books.id', 'DESC');
		$this->db->where('books.status', '1');
		$this->db->limit($num, $lastNum);
		$allBooks = $this->db->get();
		return $allBooks->result();
    }

    public function addBook($bookData)
    {
		$addBook = $this->db->insert($this->bookTable, $bookData);
		return $addBook;
    }

    public function getBookDetail($id)
    {
        $this->db->select('books.*, category.category');
		$this->db->from($this->bookTable);
		$this->db->join($this->catTable, 'books.categoryId = category.id');
		$this->db->where('books.id', $id);
		$book = $this->db->get();
		return $book->row();	
    }

    public function deleteBook($id)
    {
        $this->db->where('id', $id);
		$this->db->delete($this->bookTable);
    }


    public function getCategory()
    {
        $cat = $this->db->get($this->catTable);
        return $cat->result();
    }

    public function updateBook($bookData, $id)
    {
        $result = $this->db->where('id', $id)->update($this->bookTable, $bookData);
        return $result;
    }

    public function getCategoryDetail($id)
    {
        $query = $this->db->get_where($this->catTable, array('id' => $id));
        return $query->row();
    }

    public function updateCategory($id, $data)
    {
         $query = $this->db->where('id', $id)->update($this->catTable, $data);
         return $query;

    }

    public function deleteCategory($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->catTable);
		
	}

    public function createCategory($data)
    {
        $createCat = $this->db->insert($this->catTable, $data);
		return $createCat;
    }

    public function deleteUser($id)
    {
        $this->db->where('id', $id);
		$this->db->delete($this->tableName);
    }

    public function getUsers()
    {
        $query = $this->db->get($this->tableName);
		return $query->result();
    }

    public function createUser($data)
    {
		$query = $this->db->insert('users', $data);
		return $query;
    }
    public function getEBooks()
    {
        $this->db->select('ebooks.*, category.category');
		$this->db->from($this->ebooksTable);
		$this->db->join($this->catTable, 'ebooks.categoryId = category.id');
		$this->db->order_by('ebooks.id', 'DESC');
		$ebooks = $this->db->get();
		return $ebooks->result();

    }

    public function addEBook($data)
    {
        $query = $this->db->insert($this->ebooksTable, $data);
		return $query;
    }

    public function deleteEBook($id)
    {
        $this->db->where('id', $id);
		$this->db->delete($this->ebooksTable);
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

    
    public function updateEBook($bookData, $id)
    {
        $result = $this->db->where('id', $id)->update($this->ebooksTable, $bookData);
        return $result;
    }
}
