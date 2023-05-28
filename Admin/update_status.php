<?php
session_start();

// Include the database configuration file
include('../connection.php');

// Update status in database when user confirms action
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    if ($status == 0) {
        $sql = "UPDATE wusers SET status = 1 WHERE id = '$id'";
    } else {
        $sql = "UPDATE wusers SET status = 0 WHERE id = '$id'";
    }

    $result = mysqli_query($database, $sql);

    if ($result) {
        // Status updated successfully
        header('Location: action.php');
        exit;
    } else {
        // Status update failed
        echo 'Error updating status.';
    }
}

?>







