<?php


class CategoryDatabase {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addCategory($categoryName) {
        $sql = "INSERT INTO BookCategories (category_name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $categoryName);
            if ($stmt->execute()) {
                return true; // Category added successfully
            } else {
                return false; // Error adding category
            }
            $stmt->close();
        } else {
            return false; // Error preparing the SQL statement
        }
    }

    public function updateCategory($categoryId, $newCategoryName) {
        $sql = "UPDATE BookCategories SET category_name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("si", $newCategoryName, $categoryId);
            if ($stmt->execute()) {
                return true; // Category updated successfully
            } else {
                return false; // Error updating category
            }
            $stmt->close();
        } else {
            return false; // Error preparing the SQL statement
        }
    }

    public function deleteCategory($categoryId) {
        $sql = "DELETE FROM BookCategories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("i", $categoryId);
            if ($stmt->execute()) {
                return true; // Category deleted successfully
            } else {
                return false; // Error deleting category
            }
            $stmt->close();
        } else {
            return false; // Error preparing the SQL statement
        }
    }

    public function getAllCategories() {
        $sql = "SELECT id, category_name FROM BookCategories";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $categories = array();
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
            return $categories;
        } else {
            return null; // No categories found
        }
    }
}
?>
