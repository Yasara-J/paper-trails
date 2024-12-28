<?php

class Cart {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function addToCart($user_id, $product_id, $product_name, $quantity, $price) {
        

        
    }

    public function getCartItems($user_id) {
        
    }

    public function updateCartItemQuantity($cart_id, $new_quantity) {
        
    }

    public function removeCartItem($cart_id) {
        
    }
}
?>
