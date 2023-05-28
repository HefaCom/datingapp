<!DOCTYPE html>
<html lang="en">
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header  text-white" style="text-align: center;background-color:deeppink">
                        <h4>User Registration</h4>
                    </div>
                    <div class="card-body" >
                        <form action="register.php" method="POST" enctype="multipart/form-data">
                            <!-- Form fields here -->
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <label for="age">Age *</label>
                                <input type="date" class="form-control" id="date" name="dob" placeholder="Enter your age" required>
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender *</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">Select your gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                            <label for="country">Country *</label>
                            <select class="form-control" id="country" name="country" required>
                                <option value="">Select your country</option>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone *</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone no" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password *</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="form-group">
                                <label for="profile_picture">Profile Picture *</label>
                                <input type="file" class="form-control-file" id="profile_picture" name="profile_picture" required>
                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-primary btn-block">Register</button>
                            </div>
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
        $(document).ready(function(){
            var images = ['1.jpg', '2.jpg', '3.jpg','4.jpg', '5.jpg', '6.jpg'];
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

                        <!-- <form action="register.php" method="POST" enctype="multipart/form-data"> -->
                            
                        