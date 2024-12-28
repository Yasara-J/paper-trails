<?php
include './db.php'; 

if (isset($_POST['status']) && $_POST['status'] == 'addFeedback') {
    $feedback_type = $_POST['feedback_type'];
    $title = $_POST['title'];
    $cusotmer = $_POST['cusotmer'];
    $message = $_POST['message'];
    
    $sql = "INSERT INTO feedbacks ( feedback_type, title, cusotmer, message) VALUES ('$feedback_type', '$title', '$cusotmer', '$message')";
    if ($conn->query($sql)) {
        echo json_encode(array("status" => "success", "message" => "Feedback added successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to add feedback. ".$sql));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'getAllFeedback') {
    $cusotmer_id= $_POST['cusotmer_id'];

    $sql = "SELECT * FROM feedbacks where cusotmer = '$cusotmer_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $feedbackList = array();
        while ($row = $result->fetch_assoc()) {
            $feedbackList[] = $row;
        }
        echo json_encode(array("status" => "success", "feedbackList" => $feedbackList));
    } else {
        echo json_encode(array("status" => "error", "message" => "No feedback found."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'getOneFeedback') {
    $feedbackId = $_POST['feedbackId']; 
    $sql = "SELECT * FROM feedbacks WHERE feedback_id = $feedbackId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $feedbackData = $result->fetch_assoc();

        echo json_encode($feedbackData);
    } else {
        echo "Feedback not found.";
    }
    $conn->close();
    exit;
}

if (isset($_POST['status']) && $_POST['status'] == 'deleteFeedback') {
    $feedbackId = $_POST['feedbackId'];
    
    $sql = "DELETE FROM feedbacks WHERE feedback_id = $feedbackId";
    if ($conn->query($sql)) {
        echo json_encode(array("status" => "success", "message" => "Feedback deleted successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to delete feedback."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'updateFeedback') {
    $feedbackId = $_POST['feedbackId'];
    $updatedTitle = $_POST['updatedTitle'];
    $updatedMessage = $_POST['updatedMessage'];
    
    $sql = "UPDATE feedbacks SET title = '$updatedTitle',  message = '$updatedMessage' WHERE feedback_id = $feedbackId";
    if ($conn->query($sql)) {
        echo json_encode(array("status" => "success", "message" => "Feedback updated successfully."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to update feedback."));
    }
}

if (isset($_POST['status']) && $_POST['status'] == 'getAllFeedbackAdmin') {

    $sql = "SELECT * FROM feedbacks";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $feedbackList = array();
        while ($row = $result->fetch_assoc()) {
            $feedbackList[] = $row;
        }
        echo json_encode(array("status" => "success", "feedbackList" => $feedbackList));
    } else {
        echo json_encode(array("status" => "error", "message" => "No feedback found."));
    }
}
?>
