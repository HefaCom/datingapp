<?php

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form data
  $name = $_POST["name"];
  $email = $_POST["email"];
  $subject = $_POST["subject"];
  $message = $_POST["message"];

  // Validate the form data
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    // Return an error message
    $response = array("type" => "danger", "message" => "Please fill in all fields.");
    echo json_encode($response);
    exit;
  }

  // Connect to the database
include("connection.php");
  if (!$database) {
    // Return an error message
    $response = array("type" => "danger", "message" => "Could not connect to the database.");
    echo json_encode($response);
    exit;
  }

  // Insert the message into the database
  $query = "INSERT INTO messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
  $result = mysqli_query($database, $query);
  header("location:index.php");
  if (!$result) {
    // Return an error message
    $response = array("type" => "danger", "message" => "Could not save the message to the database.");
    echo json_encode($response);
    exit;
  }

  // Send a confirmation email to the user
//   $to = $email;
//   $subject = "Thank you for contacting us";
//   $message = "Dear $name,\n\nThank you for contacting us. We will get back to you as soon as possible.\n\nBest regards,\nThe Website Team";
//   $headers = "From: webmaster@example.com\r\n";
//   $headers .= "Reply-To: webmaster@example.com\r\n";
//   $headers .= "X-Mailer: PHP/" . phpversion();
//   mail($to, $subject, $message, $headers);

//   // Return a success message
//   $response = array("type" => "success", "message" => "Thank you for contacting us. We will get back to you as soon as possible.");
//   echo json_encode($response);
//   exit;
}

?>
