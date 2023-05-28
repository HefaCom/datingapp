<?php
include("connection.php");
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $image = base64_encode(file_get_contents(addslashes($_FILES['profile_picture']['tmp_name'])));
   
    $imgData = file_get_contents($_FILES['profile_picture']['tmp_name']);
    $imgType = $_FILES['profile_picture']['type'];

    // Process the uploaded image
    
            // Save the data to the database
$sql = "INSERT INTO wusers (name, dob, gender, location, phone, email, passwrd, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$statement = $database->prepare($sql);

// Check if the statement preparation is successful
if ($statement) {
    $statement->bind_param('ssssssss', $name, $dob, $gender, $country, $phone, $email, $password, $image);
    $statement->execute();

    if ($statement->affected_rows > 0) {
        header("location: login.php");
    } else {
        echo "Error: Failed to insert data into the database.";
    }

    $statement->close();
} else {
    echo "Error: Failed to prepare the statement.";
}

    // Close the database connection
    $database->close();
}

?>
