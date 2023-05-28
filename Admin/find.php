<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=<table class=" table table-bordered">
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

<body>
    <div class="col-lg-12">

        <div class="card">
            <div class="card-header" style="text-align: center;">
                <h4>Find users</h4>
            </div>
            <div class="card-body">
                <form method="GET">
                    <div class="form-group">
                        <label for="keyword">Keyword:</label>
                        <input type="text" name="keyword" id="keyword" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary mr-3">Search</button><span><a href="dashboard.php" class="btn btn-danger ">Back</a></span>
                </form>
                <?php
                include('../connection.php');
                if (isset($_GET['keyword'])) {
                    $keyword = $_GET['keyword'];
                    if ($keyword == "") {
                        // Query the database for users matching the keyword
                        $sql = "SELECT * FROM wusers ";
                        $result = mysqli_query($database, $sql);
                    } else {
                        // Query the database for users matching the keyword
                        $sql = "SELECT * FROM wusers WHERE name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR phone LIKE '%$keyword%' OR location LIKE '%$keyword%'";
                        $result = mysqli_query($database, $sql);
                    }
                    // rest of your code here






                    // Display the results in a table
                    echo '<div class="card-body">';
                    echo '<table class="table table-bordered table-responsive-xl table-hover">';
                    echo '<thead class="table-dark">';
                    echo '<tr>';
                    echo '<th>Name</th>';
                    echo '<th>Email</th>';
                    echo '<th>Phone</th>';
                    echo '<th>DOB</th>';
                    echo '<th>Country</th>';
                    echo '<th>Gender</th>';
                    echo '<th>Password</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        echo '<td>' . $row['phone'] . '</td>';
                        echo '<td>' . $row['dob'] . '</td>';
                        echo '<td>' . $row['location'] . '</td>';
                        echo '<td>' . $row['gender'] . '</td>';
                        echo '<td>' . $row['passwrd'] . '</td>';

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
    <!-- jQuery and Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>


</body>

</html>