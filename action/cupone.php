<?php
include './db.php'; 

if (isset($_POST['status']) && $_POST['status'] == 'add_cupone') {

    $user_id = $_POST['user_id'];
    $coupon_code = $_POST['coupon_code'];
    $expire_date = $_POST['expire_date'];
    $price = $_POST['price'];
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Check if there's a previously issued coupon for the user
    $existingCouponQuery = "SELECT * FROM coupon WHERE user_id = '$user_id' AND status = 'issued'";
    $existingCouponResult = mysqli_query($conn, $existingCouponQuery);
    
    if (mysqli_num_rows($existingCouponResult) > 0) {
        $response = array(
            'success' => false,
            'message' => 'A coupon has already been issued for this user'
        );
    } else {
        // No existing 'issued' coupon found for the user, proceed to insert a new coupon
        $sql = "INSERT INTO coupon (user_id, coupon_code, expire_date, time_stamp, amount, status)
                VALUES ('$user_id', '$coupon_code', '$expire_date', NOW(), '$price', 'issued' )";
    
        if (mysqli_query($conn, $sql)) {
            $response = array(
                'success' => true,
                'message' => 'Coupon added successfully'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Error: ' . mysqli_error($conn)
            );
        }
    }
    
    echo json_encode($response);
    
    
}

if (isset($_POST['status']) && $_POST['status'] == 'check_available_cupone') {
    $user_id = $_POST['user_id'];

    $sql = "SELECT * FROM coupon WHERE user_id = '$user_id' ORDER BY ABS(TIMESTAMPDIFF(SECOND, time_stamp, NOW())) LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        $coupon_db_code = $row['coupon_code'];
        $amount = $row['amount'];

        $response = array(
            'available' => true, 
            'message' => 'Coupon is available and valid for the user.' ,
            'coupon_code' => $coupon_db_code,
            'amount' => $amount,
            'status' => $row['status']
        );
    } else {
        $response = array(
            'available' => false, 
            'message' => 'Coupon is not available or has expired for the user.' ,
            'coupon_code'  => '',
            'amount' => '',
            'status' => $row['status']
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    mysqli_close($conn);
}

if (isset($_POST['status']) && $_POST['status'] == 'change_cupone_status') {
    $coupon_code = $_POST['coupon_code'];
    $cupone_status = $_POST['cupone_status'];

    $sql = "UPDATE coupon SET status = '$cupone_status' WHERE coupon_code = '$coupon_code'";
    
    if (mysqli_query($conn, $sql)) {
        $response = array(
            'success' => true,
            'message' => 'Coupon activated successfully.'
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'Error activating the coupon: ' . mysqli_error($conn)
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    mysqli_close($conn);
}

if (isset($_POST['status']) && $_POST['status'] == 'load_all_coupons') {
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * 
            FROM coupon cop, customer cus
            where cop.user_id = cus.customerID"; 
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $coupons = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $coupons[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode($coupons);
    } else {
        $response = array('message' => 'No coupons found');
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    mysqli_close($conn);
}



?>