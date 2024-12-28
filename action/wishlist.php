
<?php
include './db.php'; // Include the database configuration
include './wishlist_operation.php'; // Include the WishlistDatabase class


$wishlistDb = new WishlistDatabase($conn);

if (isset($_POST['status']) && $_POST['status'] == 'add') {
    $itemId = $_POST['item_id']; 
    $productName = $_POST['product_name'];
    $userId = $_POST['userid'];

    if ($wishlistDb->addItem($userId, $itemId, $productName,$userid)) {
        echo json_encode(array("status" => "success", "message" => "Item added successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Item not added successfully."));
    }
}

if (isset($_POST['update'])) {
    $itemId = $_POST['item_id'];
    $productName = $_POST['product_name'];
    $productUrl = $_POST['product_url'];
    $notes = $_POST['notes'];

    if ($wishlistDb->updateItem($itemId, $productName, $productUrl, $notes)) {
        // Item updated successfully
    } else {
        // Error updating item
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'delete_item') {
    $itemId = $_POST['item_id'];

    if ($wishlistDb->deleteItem($itemId)) {
        // Item deleted successfully
        echo json_encode(array("status" => "success", "message" => "Item deleted successfully."));

    } else {
        // Error deleting item
        echo json_encode(array("status" => "error", "message" => "Error deleting item."));

    }
}

if (isset($_POST['status']) && $_POST['status'] == 'get_all_wish_list_for_user') {
    $user_id = $_POST['user_id'];
    $sql = "SELECT * FROM wishlist w, books b WHERE w.item_id = b.id and user_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $wishlistItems = array();

        while ($row = $result->fetch_assoc()) {
            $wishlistItems[] = $row;
        }

        // Send the wishlist items as a JSON response
        echo json_encode(array("status" => "success", "wishlistItems" => $wishlistItems));

        $stmt->close();
    } else {
        // Error preparing the SQL statement
        echo json_encode(array("status" => "error", "message" => "Error preparing SQL statement."));
    }

}
?>
