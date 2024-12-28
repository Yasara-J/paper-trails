<?php
include './db.php';
include './cart_opration.php';

$cart = new Cart($conn);

if (isset($_POST['status']) && $_POST['status'] == 'add_to_cart') {
    $userId = $_POST['user_id'];
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $cartId = checkCartExists($conn, $userId);

    if ($cartId === null) {
        $cartId = createCart($conn, $userId);
        if ($cartId === null) {
            $response = array("status" => "error", "message" => "Error creating the cart");
            echo json_encode($response);
            exit;
        }
    }

    $sql = "INSERT INTO cart_item (cart_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "iisid", $cartId, $productId, $productName, $quantity, $price);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        $response = array("status" => "success", "message" => "Item added to cart successfully");
        echo json_encode($response);
    } else {
        $response = array("status" => "error", "message" => "Error preparing the statement: " . mysqli_error($conn));
        echo json_encode($response);
    }
}


function checkCartExists($conn, $userId) {
    $sql = "SELECT cart_id FROM cart WHERE user_id = ? AND status = 'Not_complete'";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $cartId);

        if (!mysqli_stmt_fetch($stmt)) {
            return null;
        }

        mysqli_stmt_close($stmt);
        return $cartId;
    } else {
        return null;
    }
}

function createCart($conn, $userId) {
    $sql = "INSERT INTO cart (user_id, status) VALUES (?, 'Not_complete')";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $cartId = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);
        return $cartId;
    } else {
        return null;
    }
}



// Update cart item quantity
if (isset($_POST['status']) && $_POST['status'] == 'delete_cart_item') {
    $cart_item_id = $_POST['cart_item_id'];

    if (!$conn) {
        $response = array("status" => "error", "message" => "Connection failed: " . mysqli_connect_error());
        echo json_encode($response);
        exit;
    }

    $sql = "DELETE FROM cart_item WHERE cart_item_id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $cart_item_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $response = array("status" => "success", "message" => "Item deleted from cart successfully");
        echo json_encode($response);
    } else {
        $response = array("status" => "error", "message" => "Error preparing the statement: " . mysqli_error($conn));
        echo json_encode($response);
    }
}


// get cart item list
if (isset($_POST['status']) && $_POST['status'] == 'get_cart_item_list') {
    $cartId = get_last_not_complete_cart_id($_POST['user_id'] , $conn);
  
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM cart_item WHERE cart_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $cartId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $cartItems = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $cartItems[] = $row;
    }

   
    echo json_encode($cartItems);
}

// List cart items
if (isset($_POST['status']) && $_POST['status'] == 'list_cart_items') {
    $userId = 1; // Replace with the actual user ID
    $cartItems = $cart->getCartItems($userId);

   
}

if (isset($_POST['status']) && $_POST['status'] == 'pay_for_book') {
    $cartId = get_last_not_complete_cart_id($_POST['user_id'] , $conn);
  
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "UPDATE cart SET status = 'paid' WHERE cart_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $cartId);

    if (mysqli_stmt_execute($stmt)) {
        // Update successful
        echo "Cart status updated to 'paid' for cart ID: " . $cartId;
    } else {
        // Update failed
        echo "Error updating cart status: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

if (isset($_POST['status']) && $_POST['status'] == 'get_all_Cart_items_in_paid') {
    
    $userId = $_POST['user_id'];
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT ci.*
            FROM cart c
            INNER JOIN cart_item ci ON c.cart_id = ci.cart_id
            WHERE c.status = 'paid' AND c.user_id = $userId";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $cartItems = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $cartItems[] = $row;
        }

        echo json_encode($cartItems);

    } else {
        echo "Error querying the database: " . mysqli_error($conn);
    }

}

function get_last_not_complete_cart_id($userId, $conn) {
    $sql = "SELECT cart_id
            FROM cart
            WHERE user_id = ? AND status != 'paid'
            ORDER BY order_date DESC
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['cart_id'];
    } else {
        return null;
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'payment_history') {
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $userId = $_POST['user_id'];

    $sql = "SELECT *
            FROM cart c, cart_item ct, books b , customer cus
            WHERE c.cart_id = ct.cart_id 
            AND ct.product_id = b.id
            AND cus.customerID = c.user_id
            AND b.author = '$userId'"; 
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $paymentHistory = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $paymentHistory[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($paymentHistory);

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'payment_history_filter') {
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $userId = $_POST['user_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    $sql = "SELECT *
        FROM cart c, cart_item ct, books b , customer cus
        WHERE c.cart_id = ct.cart_id 
        AND ct.product_id = b.id
        AND cus.customerID = c.user_id
        AND b.author = '$userId' AND c.order_date BETWEEN '$start_date' AND '$end_date'"; 
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $paymentHistory = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $paymentHistory[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($paymentHistory);

    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'save_payment') {
    $amount = $_POST['amount'];
    $pay_by = $_POST['pay_by'];
    $pay_method = $_POST['pay_method'];

    $sql = "INSERT INTO payment (amount, pay_by, pay_method) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dss", $amount, $pay_by, $pay_method);

    if ($stmt->execute()) {
        // Payment information saved successfully
        echo "Payment information saved.";
    } else {
        // Error handling if the insertion fails
        echo "Error: " . $stmt->error;
    }
}

// Close the database connection (if needed)
$conn->close();
?>
