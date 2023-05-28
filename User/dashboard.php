<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    header('Location: ../login.php');
    exit();
}

// Include the database configuration file
include('../connection.php');
include('editprofile.php');
#include('setting.php');
// Get the user's information from the database
$username = $_SESSION['user'];
$sql = "SELECT * FROM wusers WHERE email='$username'";
$result = mysqli_query($database, $sql);
$row = mysqli_fetch_assoc($result);
$dob = $row["dob"];
$name = $row["name"];
$g = $row['gender'];
$date = date('Y-m-d');
$age = (strtotime($date) - strtotime($dob)) / (60 * 60 * 24 * 365);
$age = floor($age);
$hobby = $row['hobbie'];
$picture = $row['profile_picture'];


// Retrieve the image from the database
$s = "SELECT profile_picture FROM wusers WHERE email='$username'";
$q=mysqli_query($database,$s);
$ress = mysqli_fetch_array($q);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Dashboard| <?php echo $name ?></title>
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
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Dating App</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target='#passwordModal'>Settings</a>
                </li>
                <input type="checkbox" id="switch-mode" hidden>
                <label for="switch-mode" class="switch-mode"></label>
                <li class="nav-item">
                    <a class="nav-link" href='logout.php'>Log Out</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                            <img src="data:image;charset=utf8; based64,<?php echo $ress['profile_picture']?>" class="img-fluid rounded-circle mb-3" alt="me"  />
                            
                                
                            </div>


                            <div class="col-sm-12 sm:hidden">
                                <p><strong>Name:</strong> <?php echo $row['name'] ?></p>
                                <p><strong>Age:</strong> <?php echo $age ?></p>
                                <p><strong>Gender:</strong> <?php echo $row['gender'] ?></p>
                                <p><strong>Location:</strong> <?php echo $row['location'] ?></p>
                                <p><strong>Phone:</strong> <?php echo $row['phone'] ?></p>
                                <p><strong>Email:</strong> <?php echo $row['email'] ?></p>

                                <h5>Interests</h5>
                                <p><?php echo $row['hobbie'] ?></p>
                                <h5>About Me</h5>
                                <p><?php echo $row['about'] ?></p>
                                <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#updateProfileModal">
                                    Update Profile
                                </button><span><i class="fa fa-pencil fa-fw"></i> Edit</a></span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Finding the best matches based on the users profiles -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Available Matches for you</h4><span style="font-weight:900; color:darkorchid"><?php echo $row['name'] ?></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive-xl table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Location</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $sql = "SELECT * FROM wusers WHERE (email!='$username' or hobbie LIKE '%$hobby%') and  gender!='$g' ";
                                $res = mysqli_query($database, $sql);

                                if ($res) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $name = $row['name'];
                                        $email = $row['email'];
                                        $phone = $row['phone'];
                                        $dob = $row['dob'];
                                        $country = $row['location'];
                                        $gender = $row['gender'];
                                        $id = $row['id'];
                                        $hob = $row['hobbie'];
                                        $desc = $row['about'];
                                        $age1 = (strtotime($date) - strtotime($dob)) / (60 * 60 * 24 * 365);
                                        $age1 = floor($age1);

                                        // Modal form
                                        echo '
                <div class="modal fade" id="viewMatch' . $id . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel' . $id . '">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel' . $id . '">' . $name . '</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-body">
                        <h5>Name</h5>
                        <p>' . $name . '</p>
                        <h5>Age</h5>
                        <p>' . $age1 . '</p>
                        <h5>Gender</h5>
                        <p>' . $gender . '</p>
                        <h5>Location</h5>
                        <p>' . $country . '</p>
                        <h5>Phone</h5>
                        <p>' . $phone . '</p>
                        <h5>Email</h5>
                        <p>' . $email . '</p>
                        <h5>Interests</h5>
                        <p>' . $hob . '</p>
                        <h5>About ' . $name . '</h5>
                        <p>' . $desc . '</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>';

                                        // Table row
                                        echo '
                <tr>
                  <td>' . $name . '</td>
                  <td>' . $age1 . '</td>
                  <td>' . $gender . '</td>
                  <td>' . $country . '</td>
                  <td>
                    <button class="btn btn-success" data-toggle="modal" data-target="#viewMatch' . $id . '">View</button>
                  </td>
                </tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- <tr>
                                    <td>John Smith</td>
                                    <td>28</td>
                                    <td>Male</td>
                                    <td>Los Angeles, CA</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#matchModal2">
                                            View
                                        </button>
                                    </td>
                                </tr> -->
                        </tbody>
                        </table>



                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Search for users</h4>
                    </div>
                    <form method="GET">
                        <div class="form-group">
                            <label for="keyword">Keyword:</label>
                            <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search matches using hobbies and country of interest...">
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                    <?php
                    include('../connection.php');
                    if (isset($_GET['keyword'])) {
                        $keyword = $_GET['keyword'];
                        if ($keyword == "") {
                            // Query the database for users matching the keyword
                            $sql = "SELECT * FROM wusers where email!='$username'  ";
                            $result = mysqli_query($database, $sql);
                        } else {
                            // Query the database for users matching the keyword
                            $sql = "SELECT * FROM wusers WHERE email!='$username'  and( hobbie LIKE '%$keyword%'  OR location LIKE '%$keyword%' )";
                            $result = mysqli_query($database, $sql);
                        }
                        // rest of your code here






                        // Display the results in a table
                        echo '<div class="card-body">';
                        echo '<table class="table table-bordered table-responsive-xl table-hover">';
                        echo '<thead class= "table-dark">';
                        echo '<tr>';
                        echo '<th>Name</th>';
                        #echo '<th>Email</th>';
                        #echo '<th>Phone</th>';
                        # echo '<th>DOB</th>';
                        echo '<th>Country</th>';
                        echo '<th>Gender</th>';
                        echo '<th>Hobbies</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            echo '<td>' . $row['name'] . '</td>';
                            #echo '<td>' . $row['email'] . '</td>';
                            #echo '<td>' . $row['phone'] . '</td>';
                            #echo '<td>' . $row['dob'] . '</td>';
                            echo '<td>' . $row['location'] . '</td>';
                            echo '<td>' . $row['gender'] . '</td>';
                            echo '<td>' . $row['hobbie'] . '</td>';
                            echo '</tr>';
                        }
                        echo '</tbody>';
                        echo '</table>';
                        echo '</div>';

                        // Close the database connection
                        mysqli_close($database);
                    }




                    ?>
                </div>

            </div>


        </div>
    </div>


    <script src="../script.js"></script>

    <!-- jQuery and Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            $('.view-button').click(function() {
                $('#matches-modal').modal('show');
            });
        });
    </script>
    <!-- getting the countries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'https://restcountries.com/v3.1/all',
                dataType: 'json',

                success: function(data) {
                    $.each(data, function(index, value) {
                        $('#country').append($('<option>').text(value.name.common).attr('value', value.name.common));
                    });
                }
            });
        });
    </script>
</body>

</html>