<?php

class Database {
    private $conn;

    public function __construct() {
        global $conn; // Access the database connection from db_config.php
        $this->conn = $conn;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class Book {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function addBook($title, $publisher, $price, $pagecount, $availability, $isbn, $img_file, $description, $author , $book_category , $doc_link) {
        $conn = $this->db->getConnection();

        $sql = "INSERT INTO books (title, publisher, price, pagecount, availability, isbn, description , img , author , book_category , doc_link) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssdsssssss", $title, $publisher, $price, $pagecount, $availability, $isbn, $description, $img_file, $author , $book_category , $doc_link);
            if ($stmt->execute()) {
                return true; // Book record inserted successfully
            } else {
                return false; // Error inserting book record
            }
            $stmt->close();
        } else {
            return false; // Error preparing the SQL statement
        }
    }

    public function getAllBooks() {
        $conn = $this->db->getConnection();

        $sql = "SELECT b.id AS bookid, b.status AS bookstatus, b.*, bc.*, a.*
                FROM books b
                INNER JOIN bookcategories bc ON b.book_category = bc.id
                INNER JOIN authors a ON b.author = a.author_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $books = array();

            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }

            return $books;
        } else {
            return null; // No books found
        }
    }

    public function getAuthorBooks($author_id) {
        $conn = $this->db->getConnection();

        $sql = "SELECT b.id AS bookid, b.status AS bookstatus, b.*, bc.*, a.*
                FROM books b
                INNER JOIN bookcategories bc ON b.book_category = bc.id
                INNER JOIN authors a ON b.author = a.author_id 
                where a.author_id  = $author_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $books = array();

            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }

            return $books;
        } else {
            return null; // No books found
        }
    }

    

    public function getBookById($id) {
        $conn = $this->db->getConnection();

        $sql = "SELECT b.id AS bookid, b.*, bc.*, a.*
                FROM books b
                INNER JOIN bookcategories bc ON b.book_category = bc.id
                INNER JOIN authors a ON b.author = a.author_id where b.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null; // Book not found
            }
        } else {
            return null; // Error fetching book details
        }
    }

    public function changeStatus($bookID, $newStatus) {
        $conn = $this->db->getConnection();

        $sql = "UPDATE books SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("si", $newStatus, $bookID);
            if ($stmt->execute()) {
                return true; 
            } else {
                return false; 
            }
            $stmt->close();
        } else {
            return false; 
        }
    }

    public function getOneBook($id) {
        $conn = $this->db->getConnection();
    
        $sql = "SELECT * FROM books WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        } else {
            return null; 
        }
    }
    
    
}
?>
