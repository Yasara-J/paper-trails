<?php
include './db.php'; 
include './book_operations.php'; 

// Create a Database instance
$db = new Database();

// Create a Book instance
$book = new Book($db);

if (isset($_POST['status']) && $_POST['status'] == 'add_book') {
    // Retrieve data from the form
    $title = $_POST['title'];
    $publisher = $_POST['publisher'];
    $price = $_POST['price'];
    $pagecount = $_POST['pagecount'];
    $availability = $_POST['availability'];
    $isbn = $_POST['isbn'];
    $img_file = $_POST['img_file'];
    $description = $_POST['description'];
    $author = $_POST['author'];
    $book_category =  $_POST['book_category'];
    $doc_link =  $_POST['doc_link'];

    if ($book->addBook($title, $publisher, $price, $pagecount, $availability, $isbn, $img_file, $description, $author, $book_category , $doc_link)) {
        echo json_encode(array("status" => "success", "message" => "Book record inserted successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error inserting book record."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'all_book') {
    $books = $book->getAllBooks();

    if ($books !== null) {
        $response['status'] = "success";
        $response['books'] = $books;
        echo json_encode($response);
    } else {
        $response['status'] = "error";
        $response['message'] = "No books found.";
        echo json_encode($response);
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'all_book_for_author') {
    $author_id = $_POST['author_id'];
    $books = $book->getAuthorBooks($author_id);

    if ($books !== null) {
        $response['status'] = "success";
        $response['books'] = $books;
        echo json_encode($response);
    } else {
        $response['status'] = "error";
        $response['message'] = "No books found.";
        echo json_encode($response);
    }
}


if (isset($_POST['status']) && $_POST['status'] == 'status_change') {
    $bookID = $_POST['bookID'];
    $newStatus = $_POST['newStatus'];

    if ($book->changeStatus($bookID, $newStatus)) {
        echo json_encode(array("status" => "success", "message" => "Status changed successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error changing status."));
    }
}


if (isset($_POST['status']) && $_POST['status'] == 'search_book') {
    $bookSearchTerm = $_POST['bookSearchTerm'];
    
    $bookSearch = '%' . mysqli_real_escape_string($conn, $bookSearchTerm) . '%';
    $sql = "SELECT * FROM books WHERE title LIKE ?";
    
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $bookSearch);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $booksArray = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $booksArray[] = $row;
        }

        echo json_encode($booksArray);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


if (isset($_POST['status']) && $_POST['status'] == 'search_book_with_category') {
    $bookSearchTerm = isset($_POST['bookSearchTerm']) ? $_POST['bookSearchTerm'] : '';
    $book_category = isset($_POST['book_category']) ? $_POST['book_category'] : '';

    $sql = "SELECT b.*, bc.category_name, a.full_name 
        FROM books b
        INNER JOIN bookcategories bc ON b.book_category = bc.id
        INNER JOIN authors a ON b.author = a.author_id
        WHERE 1";

    if (!empty($bookSearchTerm)) {
        $sql .= " AND b.title LIKE '%" . mysqli_real_escape_string($conn, $bookSearchTerm) . "%'";
    }

    if (!empty($book_category)) {
        $sql .= " AND b.book_category = '" . mysqli_real_escape_string($conn, $book_category) . "'";
    }


    $result = mysqli_query($conn, $sql);

    $searchResults = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $searchResults[] = $row;
    }

    echo json_encode($searchResults);
}

if (isset($_POST['status']) && $_POST['status'] == 'get_one_book') {
    
    $id = $_POST['id'];
    $bookData = $book->getBookById($id);

    if ($bookData !== null) {
        echo json_encode(array("status" => "success", "book" => $bookData));
    } else {
        echo json_encode(array("status" => "error", "book" => "There is a error"));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'update_book') {
    if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['publisher']) && isset($_POST['price']) &&
        isset($_POST['pagecount']) && isset($_POST['availability']) && isset($_POST['book_category']) && isset($_POST['description'])) {

        $id = $_POST['id'];
        $title = $_POST['title'];
        $publisher = $_POST['publisher'];
        $price = $_POST['price'];
        $pagecount = $_POST['pagecount'];
        $availability = $_POST['availability'];
        $book_category = $_POST['book_category'];
        $description = $_POST['description'];

        $sql = "UPDATE books
                SET title = ?, publisher = ?, price = ?, pagecount = ?, availability = ?,
                    book_category = ?,  description = ?
                WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssdisssi", $title, $publisher, $price, $pagecount, $availability,
            $book_category , $description, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(array("status" => "success", "message" => "Book information updated successfully."));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error updating book information: " . mysqli_error($conn)));
        }

        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(array("status" => "error", "message" => "Missing required data."));
    }
}


// Close the database connection
$db->closeConnection();
?>
