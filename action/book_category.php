<?php
include './db.php'; 
include './book_category_operation.php'; 

// Create a CategoryDatabase instance
$categoryDb = new CategoryDatabase($conn);

if (isset($_POST['status']) && $_POST['status'] == 'add_category') {
    $categoryName = $_POST['category_name'];

    if ($categoryDb->addCategory($categoryName)) {
        echo json_encode(array("status" => "success", "message" => "Book category added successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error adding book category."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'update_category') {
    $categoryId = $_POST['category_id'];
    $newCategoryName = $_POST['new_category_name'];

    if ($categoryDb->updateCategory($categoryId, $newCategoryName)) {
        echo json_encode(array("status" => "success", "message" => "Book category updated successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error updating book category."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'delete_category') {
    $categoryId = $_POST['category_id'];

    if ($categoryDb->deleteCategory($categoryId)) {
        echo json_encode(array("status" => "success", "message" => "Book category deleted successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error deleting book category."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'list_categories') {
    $categories = $categoryDb->getAllCategories();

    if ($categories !== null) {
        echo json_encode(array("status" => "success", "categories" => $categories));
    } else {
        echo json_encode(array("status" => "error", "message" => "No book categories found."));
    }
}

// Close the database connection (if needed)
$conn->close();
?>