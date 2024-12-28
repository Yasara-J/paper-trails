<?php

include './db.php'; 

if (isset($_POST['status'])) {
    $status = $_POST['status'];

    if ($status == 'add_author') {

        $fullName = $_POST['full_name'];
        $telephoneNumber = $_POST['telephone_number'];
        $nic = $_POST['nic'];
        $mostWrittenBookCategory = $_POST['most_written_book_category'];
        $country = $_POST['country'];
        $language = $_POST['language'];
        $password = $_POST['password'];
        $biography = $_POST['biography'];

        // Insert author data into the Authors table
        $sql = "INSERT INTO authors (full_name, telephone_number, nic, most_written_book_category, country, language, password_hash, biography) VALUES ('$fullName', '$telephoneNumber', '$nic', '$mostWrittenBookCategory', '$country', '$language', '$password', '$biography')";
        if ($conn->query($sql) === TRUE) {
            // Create a user record for the author
            if (add_user($telephoneNumber, $password, $conn, "author")) {
                echo json_encode(array("status" => "success", "message" => "Author added successfully."));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error creating author user." . $sql));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Error adding author: " . $conn->error));
        }
    }

    if ($status == 'get_author_profile') {
        $author_id = $_POST['author_id'];

        $sql = "SELECT authors.*, bookcategories.category_name AS category_name
                FROM bookcategories 
                JOIN authors ON bookcategories.id = authors.most_written_book_category
                where author_id = ".$author_id;
        $result = $conn->query($sql);
        $data = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    
    if ($status == 'list_tutors') {
        $data = array();
        $sql = "SELECT * FROM authors";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
    
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    
    if ($status == 'update_status_author') {
        $author_id = $_POST['author_id'];
        $newStatus = $_POST['new_status']; 

        $sql = "UPDATE authors SET status = ? WHERE author_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
    
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $newStatus, $author_id);
            if (mysqli_stmt_execute($stmt)) {
                $response = [
                    'success' => true,
                    'message' => 'Author status updated successfully.'
                ];
                echo json_encode($response);
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Author status update failed.'
                ];
                echo json_encode($response);
            }
    
            mysqli_stmt_close($stmt);
        } else {
            $response = [
                'success' => false,
                'message' => 'Error preparing the SQL statement.'
            ];
            echo json_encode($response);
        }
    }

    if ($status == 'get_one_author') {

        $author_id = $_POST['author_id'];

        $data = array();
        $sql = "SELECT * FROM authors where author_id = ".$author_id ;
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
    
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    if ($status == 'update_author_profile') {
        $author_id = $_POST['author_id'];
        $most_written_book_category = $_POST['most_written_book_category'];
        $country = $_POST['country'];
        $language = $_POST['language'];
        $biography = $_POST['biography'];

        $sql = "UPDATE authors SET 
            most_written_book_category = ?,
            country = ?,
            language = ?,
            biography = ?
            WHERE author_id = ?";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssssi", $most_written_book_category, $country, $language, $biography, $author_id);
            if ($stmt->execute()) {
                // Update successful
                echo json_encode(array("status" => "success", "message" => "Author profile updated successfully."));
            } else {
                    // Error updating the author profile
                    echo json_encode(array("status" => "error", "message" => "Error updating author profile."));
            }
            $stmt->close();
        }
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