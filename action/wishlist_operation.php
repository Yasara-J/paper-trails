<?php

class WishlistDatabase {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addItem($userId, $itemId, $productName) {
        $sql = "INSERT INTO wishlist (user_id, item_id, product) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt) {
            $stmt->bind_param("iis", $userId, $itemId, $productName);
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
    

    public function getItems($userId) {
        $sql = "SELECT * FROM wishlist WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = array();

        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }

        return $items;
    }

    public function updateItem($itemId, $productName, $productUrl, $notes) {
        $sql = "UPDATE wishlist SET product_name = ?, product_url = ?, notes = ? WHERE item_id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssi", $productName, $productUrl, $notes, $itemId);
            if ($stmt->execute()) {
                return true; // Item updated successfully
            } else {
                return false; // Error updating item
            }
            $stmt->close();
        } else {
            return false; // Error preparing the SQL statement
        }
    }

    public function deleteItem($itemId) {
        $sql = "DELETE FROM wishlist WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $itemId);
            if ($stmt->execute()) {
                return true; // Item deleted successfully
            } else {
                return false; // Error deleting item
            }
            $stmt->close();
        } else {
            return false; // Error preparing the SQL statement
        }
    }
}

?>
