<?php

session_start();
// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page
    header('Location: index.php');
    exit();
}

?>



<!DOCTYPE html>
<html>

<head>
    <title>Contact Messages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css" integrity="sha512-tnaVweDfRhFZvh+dtK2JYdX9zBzeo+olErMzaf3qTtcrGZ+0NlzrGcLEPns8EfmX9IeTwScyddxASw/8xnKvJw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
</head>

<body>
    <div class="col-lg-12 pt-3">
        <a href="dashboard.php" class="sticky-sm-top btn btn-danger" >Back</a>

        <div class="card">
            <div class="card-header" style="text-align: center;">
                <h3>Manage Messages</h3>
            </div>
            <div class="container mt-2">
                <table class="table table-bordered table-responsive-xxl table-hover   caption-top">
                <caption>Messages</caption>
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../connection.php");
                        // Create connection


                        // Check connection
                        if ($database->connect_error) {
                            die("Connection failed: " . $database->connect_error);
                        }

                        $query = "SELECT * FROM messages where status=0";
                        $result = $database->query($query);


                        if ($result->num_rows > 0) {
                            
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['message']; ?></td>
                                    <td>
                                        <?php if ($row['status'] == 0) { ?>
                                            <button type="button" class="btn btn-sm btn-success mark-read-btn" data-id="<?php echo $row['id']; ?>" data-toggle="modal" data-target="#mark-read-modal">Mark as read</button>
                                        <?php } else { ?>
                                            <button type="button" class="btn btn-sm btn-secondary">Read already</button>
                                        <?php } ?>

                                        <button type="button" class="btn btn-sm btn-primary reply-btn" data-id="<?php echo $row['id']; ?>" data-from="<?php echo $row['email']; ?>" data-to="<?php echo $row['recepient']; ?>" data-toggle="modal" data-target="#reply-modal">Reply</button>
                                        <a href="#" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $row['id']; ?>">Delete</a>

                                    </td>
                                </tr>


                        <?php
                                // Check if the mark as read form is submitted
                                if (isset($_POST['mark-read-submit'])) {
                                    // Get the message id from the form
                                    $message_id = $_POST['message-id'];

                                    // Update the message status to 'read'
                                    $query = "UPDATE messages SET status = 1 WHERE id = '$message_id'";
                                    mysqli_query($database, $query);

                                    // Redirect to the messages page
                                    header('Location: messages.php');
                                    exit;
                                }
                                // Check if the delete form is submitted
                                if (isset($_POST['delete'])) {
                                    $delete_id = $_POST['delete_id'];
                                    $sql = "DELETE FROM messages WHERE id = $delete_id";
                                    $result = mysqli_query($database, $sql);
                                    if ($result) {
                                        header('location: messages.php');
                                        exit;
                                    } else {
                                        echo "Error deleting record: " . mysqli_error($database);
                                    }
                                }

                                // Check if the reply form is submitted
                                if (isset($_POST['reply-submit'])) {
                                    // Get the message id, reply message, and recipient email from the form
                                    $message_id = $_POST['message_id'];
                                    $reply_message = $_POST['reply_message'];
                                    $recipient_email = $_POST['recipient_email'];


                                    // Get the sender's email from the session variable
                                    $sender_email = $_SESSION['user'];
                                    $sender_name = "Admin";

                                    // Insert the reply into the database
                                    $query = "INSERT INTO messages (name, email, recepient, message, status) VALUES ('$sender_name', '$sender_email', '$recipient_email', '$reply_message', 0)";
                                    mysqli_query($database, $query);

                                    // Redirect to the messages page
                                    header('Location: messages.php');
                                    exit;
                                }
                            }
                        } else {
                            echo "<tr><td colspan='4'>No unread messages found.</td></tr>";
                        }

                        $database->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Mark as read modal -->
    <div class="modal fade" id="mark-read-modal" tabindex="-1" aria-labelledby="mark-read-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mark-read-modal-label">Mark message as read</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to mark this message as read?</p>
                </div>
                <div class="modal-footer">
                    <form method="post">
                        <input type="hidden" name="message-id" id="mark-read-message-id" value="">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="mark-read-submit" class="btn btn-success">Mark as read</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form method="post" id="deleteForm">
                        <input type="hidden" name="delete_id" id="delete_id">
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- reply modal -->
    <div class="modal fade" id="reply-modal" tabindex="-1" role="dialog" aria-labelledby="reply-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reply-modal-label">Reply to message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="reply-message">Reply Message:</label>
                            <textarea class="form-control" id="reply-message" name="reply_message" required></textarea>
                        </div>
                        <input type="hidden" id="message-id" name="message_id">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {


            // mark as read button click
            $('.mark-read-btn').click(function() {
                var messageId = $(this).data('id');
                $('#mark-read-message-id').val(messageId);
                $('#mark-read-modal').modal('show');
            });

            // delete button click
            $(document).ready(function() {
                $('.delete-btn').click(function() {
                    var id = $(this).data('id');
                    $('#delete_id').val(id);
                });
            });


            // reply button click
            $('.reply-btn').click(function() {
                var messageId = $(this).data('id');
                var from = $(this).data('from');
                var to = $(this).data('to');
                $('#message-id').val(messageId);
                $('#reply-modal').modal('show');
            });

        });
    </script>
</body>

</html>