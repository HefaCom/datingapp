<?php
// Start the session
// session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    header('Location: ../login.php');
    exit();
}

// Include the database configuration file
include('../connection.php');

// Get the user's information from the database
$username = $_SESSION['user'];
$sql = "SELECT * FROM wusers WHERE email='$username'";
$result = mysqli_query($database, $sql);
$row = mysqli_fetch_assoc($result);

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the new password from the form
    $hobby = $_POST['hobby'];
    $about = $_POST['about'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];
    $new_password = $_POST['new_password'];
    // Update the user's password in the database
    $sql = "UPDATE wusers SET hobbie='$hobby', about='$about',location='$country',phone='$phone',passwrd='$new_password' WHERE email='$username'";
    mysqli_query($database, $sql);

    // Redirect to the user dashboard
    header('Location: dashboard.php');
    exit();
}
?>
<body>
    <!-- Modal update profile-->
    <div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProfileModalLabel">Update your Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-group">
                                                <label for="country">Country </label>
                                                <select class="form-control" id="country" name="country" required>
                                                    <option value="<?php echo $row['location'] ?>"><?php echo $row['location'] ?></option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone </label>
                                                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $row['phone'] ?>" placeholder="Enter your phone no" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="form_message">Hobbies </label>
                                                <textarea id="form_message" name="hobby" class="form-control" placeholder="Highlight your hobbies separating each by a comma..." rows="2" data-error="Message is required."><?php echo $row['hobbie'] ?></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="form_message">About Me </label>
                                                <textarea id="form_message" name="about" class="form-control" placeholder="Tell the world about yourself..." rows="4" data-error="Message is required."><?php echo $row['about'] ?></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password">New Password</label>
                                                <input type="password" name="new_password" id="new_password" value="<?php echo $row['passwrd'] ?>" class="form-control">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery and Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"></script>

    
</body>

</html>