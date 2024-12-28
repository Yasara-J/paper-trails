<?php
include './db.php'; 

if (isset($_POST['status']) && $_POST['status'] == 'add_customer') {
        $name = $_POST['name'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $bookType = $_POST['bookType'];
        
        // Hash the password before inserting it into the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO customer (FullName, Telephone, Address, Email, Password , BookType) VALUES (?, ?, ?, ?, ? , ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $name, $telephone, $address, $email, $hashedPassword , $bookType);
    
        if ($stmt->execute()) {
            // Customer data successfully inserted into the database
            if(add_user($email, $password, $conn , 'Customer')){
                echo json_encode(array("status" => "success", "message" => "Customer adding successfully."));
            }else{
                echo json_encode(array("status" => "error", "message" => "Customer adding not successfully."));
            }
        } else {
            // Error handling for failed database insertion
            echo json_encode(array("status" => "error", "message" => "Customer adding not successfully."));
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
}

if (isset($_POST['status']) && $_POST['status'] == 'get_user_profile') {
    $user_id = $_POST['user_id'];
    $user_profile = getUserProfile($user_id , $conn);

    if ($user_profile) {
        echo json_encode($user_profile); 
    } else {
        echo "User profile not found.";
    }
}

function getUserProfile($user_id, $conn) {
    $sql = "SELECT * FROM customer WHERE customerID = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_profile = $result->fetch_assoc();
        return $user_profile;
    } else {
        return null;
    }
}


function add_user($telephoneNumber, $pass, $conn , $userType) {
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Users (Username, Password , userType)
            VALUES ('$telephoneNumber', '$hashedPassword' , '$userType')";

    if ($conn->query($sql) === TRUE) {
        return true; 
    } else {
        return false; 
    }
}
?>