<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetFolder = 'uploads/';
    $targetFile = $targetFolder . basename($_FILES['pdf']['name']);
    
    if (move_uploaded_file($_FILES['pdf']['tmp_name'], $targetFile)) {
        echo basename($_FILES['pdf']['name']);
    } else {
        echo 'File upload failed.';
    }
}
?>
