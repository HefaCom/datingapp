<?php
include("../connection.php");
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
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Find Users</title>
</head>

<body>

    <!-- Finding the best matches based on the users profiles -->
    <div class="col-lg-12 p-3" >

        <div class="card">
            <div class="card-header" style="text-align: center;">
                <h4>Search for users</h4>
            </div>
            <form method="GET">
                <div class="form-group">
                    <label for="keyword">Keyword:</label>
                    <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search users using hobbies,phone,email and country of interest...">
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
                        $sql = "SELECT * FROM wusers WHERE hobbie LIKE '%$keyword%'  OR name LIKE '%$keyword%' or location like '%$keyword%' or phone like '%$keyword%' or email like '%$keyword%'";
                        $result = mysqli_query($database, $sql);
                    }
                    // rest of your code here






                    // Display the results in a table
                    echo '<div class="card-body">';
                    echo '<table class="table table-bordered table-responsive-xl ">';
                    echo '<thead class="table-dark">';
                    echo '<tr>';
                    echo '<th>Name</th>';
                    #echo '<th>Email</th>';
                    #echo '<th>Phone</th>';
                    # echo '<th>DOB</th>';
                    echo '<th>Country</th>';
                    echo '<th>Gender</th>';
                    echo '<th>Hobbies</th>';
                    echo '<th>Action</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id1 = $row['id'];
                        $name = $row['name'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $dob = $row['dob'];
                        $country = $row['location'];
                        $gender = $row['gender'];

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
                  </td>';
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
                
            }




            ?>
        </div>

    </div>







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