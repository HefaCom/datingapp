<?php
session_start();

// Include the database configuration file
include('../connection.php');

// Get the user's information from the database
$username = $_SESSION['user'];
$sql = "SELECT * FROM wusers WHERE email='$username'";
$result = mysqli_query($database, $sql);
$row = mysqli_fetch_assoc($result);
$date = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Action Panel</title>
</head>

<body >
    <!-- Finding the best matches based on the users profiles -->
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header">
                <h4>Manage users</h4>
            </div>
            <form method="GET">
                <div class="form-group">
                    <label for="keyword">Keyword:</label>
                    <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search matches using hobbies,phone and country of interest...">
                </div>
                <button type="submit" class="btn btn-primary mr-3">Search</button><span><a href="dashboard.php" class="btn btn-danger ">Back</a></span>
            </form>
            <?php
            include('../connection.php');
            if (isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                if ($keyword == "") {
                    // Query the database for users matching the keyword
                    $sql = "SELECT * FROM wusers  ";
                    $result = mysqli_query($database, $sql);
                    
                    } 
                    else {
                        // Query the database for users matching the keyword
                        $sql = "SELECT * FROM wusers WHERE hobbie LIKE '%$keyword%'  OR name LIKE '%$keyword%' or location LIKE '%$keyword%' or phone like '%$keyword%' or email like '%$keyword%'";
                        $result = mysqli_query($database, $sql);
                    }
                    // rest of your code here






                    // Display the results in a table
                    echo '<div class="card-body">';
                    echo '<table class="table table-bordered table-responsive-xl table-hover">';
                    echo '<thead class="table-dark">';
                    echo '<tr>';
                    echo '<th>Name</th>';
                    #echo '<th>Email</th>';
                    #echo '<th>Phone</th>';
                    # echo '<th>DOB</th>';
                    echo '<th>Country</th>';
                    echo '<th>Gender</th>';
                    echo '<th>Hobbies</th>';
                    echo '<th>View</th>';
                    echo '<th>Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id1 = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $dob = $row['dob'];
                        $country = $row['location'];
                        $gender = $row['gender'];
                        $status = $row['status'];
                        $id = $row['id'];

                        $hob = $row['hobbie'];
                        $desc = $row['about'];
                        $age1 = (strtotime($date) - strtotime($dob)) / (60 * 60 * 24 * 365);
                        $age1 = floor($age1);
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        #echo '<td>' . $row['email'] . '</td>';
                        #echo '<td>' . $row['phone'] . '</td>';
                        #echo '<td>' . $row['dob'] . '</td>';
                        echo '<td>' . $row['location'] . '</td>';
                        echo '<td>' . $row['gender'] . '</td>';
                        echo '<td>' . $row['hobbie'] . '</td>';
                        echo '<td>
                    <button class="btn btn-success" data-toggle="modal" data-target="#viewMatch1' . $id1 . '">View</button>
                    <td>';
                
                    if ($status == 1) {
                        echo '<form method="post" action="update_status.php">
                                  <button class="btn btn-danger" name="submit" type="submit">Deactivate</button>
                                  <input type="hidden" name="id" value="' . $id . '">
                                  <input type="hidden" name="status" value="' . $status . '">
                              </form>';
                    } else {
                        echo '<form method="post" action="update_status.php">
                                  <button class="btn btn-primary" name="submit" type="submit">Activate</button>
                                  <input type="hidden" name="id" value="' . $id . '">
                                  <input type="hidden" name="status" value="' . $status . '">
                              </form>';
                    }
    
                    echo '</td></tr>';
                    
                  
                        echo '</tr>';

                        // Modal form
                        echo '
                <div class="modal fade" id="viewMatch1' . $id1 . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel' . $id1 . '">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel style="color:pink"'  . $id1 . '">' . $name . '</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                      <p><strong>Name:</strong>' .  $name . '</p>
                      <p> <strong>Age:</strong>' . $dob . '</p>
                      <p> <strong>Age:</strong>' . $age1 . '</p>
                        
                      <p><strong>Gender:</strong>' . $gender . '</p>
                        
                      <p> <strong>Location:</strong>' . $country . '</p>
                        
                      <p> <strong>Phone:</strong>' . $phone . '</p>
                        
                      <p> <strong>Email:</strong>' . $email . '</p>
                        
                      <p> <strong>Interests:</strong>' . $hob . '</p>
                        
                       <strong>About ' . $name . '</strong>
                       <p> ' . $desc . '</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>';
                        // Close the database connection

                    }
                }else {
                    echo "<tr><td colspan='4'>No such user found!</td></tr>";
                }
                
            }else {
                echo "<tr><td colspan='4' >Enter key word to search!</td></tr>";
            }
            




            ?>
        </div>

    </div>
    
    <!-- jQuery and Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.view-user').on('click', function() {
                var userid = $(this).data('id');
                $.ajax({
                    url: "fetch_user.php",
                    type: "POST",
                    data: {
                        userid: userid
                    },
                    success: function(data) {
                        $(".modal-body").html(data);
                    }
                });
            });
        });
            // Activate user button click event
            $(document).on('click', '.activate-user', function() {
                var user_id = $(this).data('userid');
                $.ajax({
                    url: 'update_status.php',
                    method: 'POST',
                    data: {
                        id: id,
                        status: 1
                    },
                    success: function(response) {
                        alert('User activated successfully');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while activating the user: ' + error);
                    }
                });
            });

            // Deactivate user button click event
            $(document).on('click', '.deactivate-user', function() {
                var user_id = $(this).data('userid');
                $.ajax({
                    url: 'update_status.php',
                    method: 'POST',
                    data: {
                        id: id,
                        status: 0
                    },
                    success: function(response) {
                        alert('User deactivated successfully');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred while deactivating the user: ' + error);
                    }
                });
            });











        
    </script>

</body>

</html>