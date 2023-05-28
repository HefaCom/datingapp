<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dating App</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">

</head>
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

		setInterval(changeBackground, 5000); // Change image every 5 seconds
	});
</script>
<style>
	.nav-link{
		font-weight: 700;
	}
	.nav-link :hover{
		transition: 1.5s ease-in-out;
		color: purple;
	}
</style>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<svg width="200" height="35">
			<text x="0" y="35" font-size="35" font-weight="bold" fill="#ff69b4" font-family="arial">LoveMaters</text>
		</svg><span style="font-weight:600;color:purple"><sup>Find Love</sup></span>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="#">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#about">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#pricing">Pricing</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#contact">Contact</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="login.php">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="reg.php">Register</a>
				</li>
			</ul>
		</div>

	</nav>
	<!-- Main Section -->

	<section class="main-section" style='padding-top:50px;background-color: #d63384'>
		<div class="container">
			<div class="row">
				<div class="col-md-6">

					<h1 class="display-4 animate-text">Find your perfect match</h1>

					<p class="lead">LoveMatters helps you find the love of your life. Sign up now to get started.</p>
					<a href="reg.php" class="btn btn-primary btn-lg">Sign Up Now</a>
				</div>
				<div class="col-md-6" style="border-radius: 30px;padding:3px">
					<div class="carousel slide" data-ride="carousel" style="border-radius: 30px;">
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img src="https://source.unsplash.com/1600x900/?couple,love" class="d-block w-100" alt="Couple in love">
							</div>
							<div class="carousel-item">
								<img src="https://source.unsplash.com/1600x900/?dating,romance" class="d-block w-100" alt="Romantic date">
							</div>
							<div class="carousel-item">
								<img src="https://source.unsplash.com/1600x900/?relationship,happiness" class="d-block w-100" alt="Happy couple">
							</div>


						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 text-center">
				<h1>Welcome to LoveMatters</h1>
				<p>Find your perfect match today</p>
			</div>
		</div>
	</div>
	<section id="about" class="card shadow mb-4">
		<div class="container">
			<div class="card-body">
				<div class="col-lg-12">
					<h2 class="card-title" style="text-align:center;">About Our Dating App</h2>
					<strong class="card-text">Our dating app is designed to help singles find their perfect match in a fun, easy, and safe way. We understand that finding love can be challenging, especially in today's fast-paced world. That's why we created our app to make the process of finding your soulmate as effortless as possible. With our intuitive interface and advanced matchmaking algorithms, you can connect with like-minded individuals who share your interests and values. </strong>
					<p class="card-text">Whether you're looking for a casual date or a long-term relationship, our app has everything you need to make a meaningful connection. So why wait? Sign up today and start your journey to finding true love!</p>
				</div>
			</div>
			<div class="container" style="padding:10px">
				<div class="row">
					<div class="col-sm-4">
						<h2>Search</h2>
						<p>Search for people based on location, interests, and other criteria.</p>
					</div>
					<div class="col-sm-4">
						<h2>Match</h2>
						<p>Our algorithm matches you with people who share your interests and preferences.</p>
					</div>
					<div class="col-sm-4">
						<h2>Connect</h2>
						<p>Connect with your matches and start chatting.</p>
					</div>
				</div>
			</div>
		</div>
		<!-- Call to Action -->
		<section class="cta" style="padding:10px">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h3>Join LoveMatters today</h3>
					</div>
					<div class="col-md-6">
						<a href="reg.php" class="btn btn-primary btn-lg">Sign Up Now</a>
					</div>
				</div>
			</div>
		</section>
	</section>
	<!-- Testimonials -->
	<section class="testimonials" ,style="background-color:#6f42c1; padding:2px">
		<div class="container">
			<h2>What Our Users Say</h2>
			<div class="row">
				<div class="col-md-4">
					<div class="testimonial">
						<div class="testimonial-content">
							<p>"LoveMatters is the best thing that ever happened to me! I found my soulmate and we are
								now happily married."</p>
							<div class="testimonial-author">
								<img src="https://randomuser.me/api/portraits/women/85.jpg" alt="Author">
								<p><span>Emma Smith</span><br>Teacher | recently</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="testimonial">
						<div class="testimonial-content">
							<p>"I never thought I'd find love online, but LoveMatters proved me wrong. I am now in a
								happy and fulfilling relationship."</p>
							<div class="testimonial-author">
								<img src="https://randomuser.me/api/portraits/men/58.jpg" alt="Author">
								<p><span>John Doe</span><br>IT Consultant | recently</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="testimonial">
						<div class="testimonial-content">
							<p>"LoveMatters made it easy for me to find someone who shares my interests and values. I
								am so grateful for this platform."</p>
							<div class="testimonial-author">
								<img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Author">
								<p><span>Jane Smith</span><br>Graphic Designer | recently</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="testimonial">
						<div class="testimonial-content">
							<p>"LoveMatters is the best thing that ever happened to me! I found my soulmate and we are
								now happily married."</p>
							<div class="testimonial-author">
								<img src="https://randomuser.me/api/portraits/women/87.jpg" alt="Author">
								<p><span>Emma Smith</span><br>Teacher | recently</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="testimonial">
						<div class="testimonial-content">
							<p>"I never thought I'd find love online, but LoveMatters proved me wrong. I am now in a
								happy and fulfilling relationship."</p>
							<div class="testimonial-author">
								<img src="https://randomuser.me/api/portraits/men/56.jpg" alt="Author">
								<p><span>John Doe</span><br>IT Consultant | recently</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="testimonial">
						<div class="testimonial-content">
							<p>"LoveMatters made it easy for me to find someone who shares my interests and values. I
								am so grateful for this platform."</p>
							<div class="testimonial-author">
								<img src="https://randomuser.me/api/portraits/women/78.jpg" alt="Author">
								<p><span>Jane Smith</span><br>Graphic Designer | recently</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="testimonial">
						<div class="testimonial-content">
							<p>"LoveMatters is the best thing that ever happened to me! I found my soulmate and we are
								now happily married."</p>
							<div class="testimonial-author">
								<img src="https://randomuser.me/api/portraits/women/86.jpg" alt="Author">
								<p><span>Emma Smith</span><br>Teacher | recently</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="testimonial">
						<div class="testimonial-content">
							<p>"I never thought I'd find love online, but LoveMatters proved me wrong. I am now in a
								happy and fulfilling relationship."</p>
							<div class="testimonial-author">
								<img src="https://randomuser.me/api/portraits/men/53.jpg" alt="Author">
								<p><span>John Doe</span><br>IT Consultant | recently</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="testimonial">
						<div class="testimonial-content">
							<p>"LoveMatters made it easy for me to find someone who shares my interests and values. I
								am so grateful for this platform."</p>
							<div class="testimonial-author">
								<img src="https://randomuser.me/api/portraits/women/66.jpg" alt="Author">
								<p><span>Jane Smith</span><br>Graphic Designer | recently</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="pricing" class="pricing section-bg">
		<div class="container">

			<div class="section-title">
				<h2>Pricing</h2>
				<p>Choose a plan that suits you best</p>
			</div>

			<div class="row">

				<div class="col-lg-4 col-md-6">
					<div class="box">
						<h3>Basic</h3>
						<h4><sup>$</sup>1.49<span> / month</span></h4>
						<ul>
							<li><i class="bx bx-check"></i> Access to all profiles</li>
							<li><i class="bx bx-check"></i> Limited messaging</li>
							<li><i class="bx bx-check"></i> 5 matches per month</li>
							<li class="na"><i class="bx bx-x"></i> <span>Profile Boost</span></li>
							<li class="na"><i class="bx bx-x"></i> <span>Advanced search filters</span></li>
						</ul>
						<a href="reg.php" class="get-started-btn">Get Started</a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="box recommended">
						<span class="recommended-badge">Recommended</span>
						<h3>Premium</h3>
						<h4><sup>$</sup>2.49<span> / month</span></h4>
						<ul>
							<li><i class="bx bx-check"></i> Access to all profiles</li>
							<li><i class="bx bx-check"></i> Unlimited messaging</li>
							<li><i class="bx bx-check"></i> 15 matches per month</li>
							<li><i class="bx bx-check"></i> Profile Boost</li>
							<li class="na"><i class="bx bx-x"></i> <span>Advanced search filters</span></li>
						</ul>
						<a href="reg.php" class="get-started-btn">Get Started</a>
					</div>
				</div>

				<div class="col-lg-4 col-md-6">
					<div class="box">
						<h3>Ultimate</h3>
						<h4><sup>$</sup>4.99<span> / month</span></h4>
						<ul>
							<li><i class="bx bx-check"></i> Access to all profiles</li>
							<li><i class="bx bx-check"></i> Unlimited messaging</li>
							<li><i class="bx bx-check"></i> Unlimited matches</li>
							<li><i class="bx bx-check"></i> Profile Boost</li>
							<li><i class="bx bx-check"></i> Advanced search filters</li>
						</ul>
						<a href="reg.php" class="get-started-btn">Get Started</a>
					</div>
				</div>

			</div>

		</div>
	</section>

	<section id="contact" class="p-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h2>Contact Us</h2>
					<hr class="star-primary">
				</div>
			</div>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<form id="contact-form" method="post" action="sendmail.php" role="form">
						<div class="messages"></div>
						<div class="controls">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="form_name">Name *</label>
										<input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your name *" required="required" data-error="Name is required.">
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="form_email">Email *</label>
										<input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="subject">Subject *</label>
										<select class="form-control" id="subject" name="subject">
											<option value="">Select the subject matter</option>
											<option value="payment">Payment query</option>
											<option value="general">General query</option>
											<option value="match">Matches query</option>
											<option value="other">Other</option>
											<!-- Add more options here -->
										</select>
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label for="form_message">Message *</label>
										<textarea id="form_message" name="message" class="form-control" placeholder="Please enter your message..." rows="3" required="required" data-error="Message is required."></textarea>
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="col-md-12">
									<input type="submit" class="btn  btn-send " style="background-color: #d63384;color:aliceblue;font-weight:500" value="Send message">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>



	<footer class="bg-dark text-white">
		<div class="container py-5">
			<div class="row">
				<div class="col-md-3">
					<h5 class="mb-3">About Us</h5>
					<strong>We created our app to make the process of finding your soulmate as effortless as possible. With our intuitive interface and advanced matchmaking algorithms, you can connect with like-minded individuals who share your interests and values.</strong>
				</div>
				<div class="col-md-3">
					<h5 class="mb-3">Contact Us</h5>
					<ul class="list-unstyled">
						<li><i class="fa fa-envelope mr-2"></i> hefatech1t@gmail.com</li>
						<li><i class="fa fa-phone mr-2"></i> +254 (707) 615-535</li>
						<li><i class="fa fa-map-marker mr-2"></i> 123 Main St, New York, NY 10001</li>
					</ul>
				</div>
				<div class="col-md-3">
					<h5 class="mb-3">Connect with Us</h5>
					<ul class="list-unstyled">
						<li><a href="#"><i class="fa fa-facebook mr-2"></i> Facebook</a></li>
						<li><a href="#"><i class="fa fa-twitter mr-2"></i> Twitter</a></li>
						<li><a href="#"><i class="fa fa-instagram mr-2"></i> Instagram</a></li>
					</ul>
				</div>
				<div class="col-md-3">
					<h5 class="mb-3">Partners</h5>
					<ul class="list-unstyled">
						<li><a href="#"><i class="fa fa-facebook mr-2"></i> Assignment Help</a></li>
						<li><a href="#"><i class="fa fa-twitter mr-2"></i> Nerd Experts</a></li>
						<li><a href="https://hezron-okoko.netlify.app/"><i class="fa fa-instagram mr-2"></i> Experts</a></li>
					</ul>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-md-12 text-center">
					<?php
					$y = Date("Y")
					?>
					<p>&copy; <?php echo $y ?> LoveMatters. All rights reserved.</p>
					<svg width="200" height="35">
						<text x="0" y="35" font-size="35" font-weight="bold" fill="#ff69b4" font-family="arial">LoveMaters</text>
					</svg><span ><sup style="font-weight:600;color:white;font-weight:900">Find Love</sup></span>
				</div>
			</div>
		</div>
	</footer>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>