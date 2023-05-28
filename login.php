<?php
session_start();
include("connection.php");
include("timezone.php");

if (isset($_SESSION['user'])) {
  header("Location:User/dashboard.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Check if user exists in the database

  if ($database->connect_error) {
    die("Connection failed: " . $database->connect_error);
  }
  $stmt = $database->prepare("SELECT * FROM wusers WHERE email = ? ");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows === 0) {
    echo "<p class='alert alert-danger'>User not found.</p>";
  } else {
    $user = $result->fetch_assoc();



    $checker = $database->query("select * from wusers where email='$email' and (passwrd='$password')");
    if ($checker->num_rows == 1) {

-
      //   Patient dashbord
      $_SESSION['user'] = $email;
      #$_SESSION['usertype']='p';
      // Get the current date and time in a MySQL-compatible format
      $current_datetime = date('Y-m-d H:i:s');

      // Update the `last_login` field in the `users` table
      $sql = "UPDATE wusers SET last_login='$current_datetime' WHERE email='$email'";
      $result = $database->query($sql);
      header('location: User/dashboard.php');
    } else {
      echo "<p class='alert alert-danger'>Email or password is incorrect</p>";
    }
  }







  $stmt->close();
  $database->close();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>User Registration</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      background-repeat: no-repeat;
      background-size: cover;
      transition: background 5s ease-in-out;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6 col-lg-4">
        <div class="card">
          <div class="card-header bg-primary text-white" style="text-align: center;">
            <h4>User Login</h4>
          </div>
          <div class="card-body">
            <form method="POST">
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="remember" name="remember">
                  <label class="form-check-label" for="remember">
                    Remember me
                  </label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function() {
      var images = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg'];
      var currentIndex = 0;

      function changeBackground() {
        $('body').css('background-image', 'url(images/' + images[currentIndex] + ')');
        currentIndex++;
        if (currentIndex == images.length) {
          currentIndex = 0;
        }
      }

      setInterval(changeBackground, 10000); // Change image every 5 seconds
    });
  </script>
</body>

</html>