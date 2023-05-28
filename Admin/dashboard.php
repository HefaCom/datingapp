<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
	// Redirect to the login page
	header('Location: index.php');
	exit();
}

// Include the database configuration file
include('../connection.php');

// Get the user's information from the database
$username = $_SESSION['user'];
$sql = "SELECT * FROM wusers WHERE email='$username'";
$result = mysqli_query($database, $sql);
$row = mysqli_fetch_assoc($result);
$dob = $row["dob"];
$date = date('Y-m-d');
$age = (strtotime($date) - strtotime($dob)) / (60 * 60 * 24 * 365);
$age = floor($age);



// Count all users
$result = $database->query("SELECT COUNT(*) FROM wusers");
$total_users = $result->fetch_row()[0];

// Count new users (assuming you have a "created_at" timestamp column)
$start_date = date('Y-m-d', strtotime('-1 days')); // count new users for the past 7 days
$result = $database->query("SELECT COUNT(*) FROM wusers WHERE reg_date >= '$start_date'");
$new_users = $result->fetch_row()[0];

//Count active users (assuming you have a "last_login" timestamp column)
$start_date = date('Y-m-d', strtotime('-1 days')); // count active users for the past 30 days
$result = $database->query("SELECT COUNT(*) FROM wusers WHERE last_login >= '$start_date'");
$active_users = $result->fetch_row()[0];


//Male users
$result = $database->query("SELECT COUNT(*) FROM wusers WHERE gender = 'male'");
$male_users = $result->fetch_row()[0];

//female users
$result = $database->query("SELECT COUNT(*) FROM wusers WHERE gender = 'female'");
$female_users = $result->fetch_row()[0];


//kenyan users
$result = $database->query("SELECT COUNT(*) FROM wusers WHERE location like '%Kenya%'");
$local_users = $result->fetch_row()[0];
// Close the database connection
$database->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
	<!-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> -->
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<style>
	.user-stats {
		display: flex;
		justify-content: space-between;
		margin: 50px 0;
	}

	.stat {
		flex: 1;
		margin: 0 20px;
		text-align: center;
	}

	.stat h3 {
		font-size: 24px;
		margin-bottom: 10px;
	}

	.stat .count {
		font-size: 36px;
		font-weight: bold;
	}
</style>

<body>
	<div class="d-flex" id="wrapper">
		<!-- Sidebar -->
		<div class="bg-light border-right" id="sidebar-wrapper">
			<div class="sidebar-heading">Dating App Admin</div>
			<div class="list-group list-group-flush">
				<a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
				<a href="users.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-users"></i> Users</a>
				<a href="find.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-heart"></i> Find</a>
				<a href="messages.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-comments fa-spin"></i> Messages</a>
				<a href="#" class="list-group-item list-group-item-action bg-light"><i class="fas fa-cog fa-pulse"></i> Settings</a>
				<a href="action.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-cog fa-pulse"></i> Action</a>
			</div>
		</div>
		<!-- /#sidebar-wrapper -->
		<!-- Page Content -->
		<div id="page-content-wrapper">
			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<button class="btn btn-primary" id="menu-toggle"><i class="fas fa-bars"></i></button>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
						<li class="nav-item active">
							<strong><a class="nav-link" href="#" style="color:purple ;"><i class="fas fa-user"></i> <?php echo "Welcome " . $row['name'] ?></a></strong>
						</li>
						<li class="nav-item">
							<strong><a class="nav-link" href="logout.php" style="color:red ;"><i class="fas fa-sign-out-alt"></i> Logout</a></strong>
						</li>
					</ul>
				</div>
			</nav>
			<div class="container">
				<h2 class="mb-3">Dashboard</h2>
				<div class="row mt-3">
					<a href="users.php" style="text-decoration:none">
					<div class="col-lg-2">
						<div class="card bg-primary">
							<div class="card-body text-center">
								<h5 class="card-title text-white fs-6">All Users</h5>
								<h5 class="card-title text-white fs-6">(All time)</h5>
								<p class="card-text display-4 text-white"><?php echo $total_users; ?></p>
							</div>
						</div>
						</a>
					</div>
					<div class="col-lg-2">
						<div class="card bg-success">
							<div class="card-body text-center">
							<h5 class="card-title text-white fs-6">New Users</h5>
								<h5 class="card-title text-white fs-6">(past 30 days)</h5>
								<p class="card-text display-4 text-white"><?php echo $new_users; ?></p>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="card bg-info">
							<div class="card-body text-center">
							<h5 class="card-title text-white fs-6">Active Users</h5>
								<h5 class="card-title text-white fs-6">(past 30 days)</h5>
								<p class="card-text display-4 text-white"><?php echo $active_users; ?></p>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="card bg-secondary">
							<div class="card-body text-center">
								<h5 class="card-title text-white fs-6">Male Users</h5>
								<h5 class="card-title text-white fs-6">(All time)</h5>
								<p class="card-text display-4 text-white"><?php echo $male_users; ?></p>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="card bg-dark">
							<div class="card-body text-center">
								<h5 class="card-title text-white fs-6">Female Users</h5>
								<h5 class="card-title text-white fs-6">(All time)</h5>
								<p class="card-text display-4 text-white"><?php echo $female_users; ?></p>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="card bg-danger">
							<div class="card-body text-center">
								<h5 class="card-title text-white fs-6">Local Users</h5>
								<h5 class="card-title text-white fs-6">(All time)</h5>
								<p class="card-text display-4 text-white"><?php echo $local_users; ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>


			<div class="container-fluid mt-3">

				<div class="row">
					<div class="user-stats">

						<div class="col-md-4 mb-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title"><i class="fas fa-users"></i> Active Users</h5>
									<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
								</div>
								<ul class="list-group list-group-flush">
									<li class="list-group-item"><strong>Today
											<span class="badge badge-primary float-right">100</span></strong></li>
									<li class="list-group-item"><strong>This week<span class="badge badge-primary float-right">500</span></strong></li>
									<li class="list-group-item"><strong>This month<span class="badge badge-primary float-right">1500</span></strong></li>
								</ul>
							</div>
						</div>
						<div class="col-md-4 mb-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title"><i class="fas fa-users"></i> New Users</h5>
									<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
								</div>
								<ul class="list-group list-group-flush">
									<li class="list-group-item"><strong>Today<span class="badge badge-primary float-right">50</span></strong></li>
									<li class="list-group-item"><strong>This week<span class="badge badge-primary float-right">250</span></strong></li>
									<li class="list-group-item"><strong>This month<span class="badge badge-primary float-right">750</span></strong></li>
								</ul>
							</div>
						</div>
						<div class="col-md-4 mb-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title"><i class="fas fa-list-alt"></i> Total Inventory</h5>
									<p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
								</div>
								<ul class="list-group list-group-flush">
									<li class="list-group-item"><strong>Today<span class="badge badge-primary float-right">1000</span></strong></li>
									<li class="list-group-item"><strong>This week<span class="badge badge-primary float-right">5000</span></strong></li>
									<li class="list-group-item"><strong>This month<span class="badge badge-primary float-right">15000</span></strong></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-md-6 mb-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title"><i class="fas fa-chart-line"></i> Sales Statistics</h5>
									<canvas id="salesChart" width="400" height="200"></canvas>
								</div>
							</div>
						</div>
						<div class="col-md-6 mb-4">
							<div class="card">
								<div class="card-body">
									<h5 class="card-title"><i class="fas fa-chart-pie"></i> Website Traffic</h5>
									<canvas id="trafficChart" width="400" height="200"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /#page-content-wrapper -->
		</div>
		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-XXXXXXXXXXXXXXXXXXXXXXXXXXXXX" crossorigin="anonymous"></script>

		<!-- Bootstrap core JavaScript -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

		<!-- Chart.js -->
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

		<script>
			$(document).ready(function() {
				// Sidebar toggle behavior
				$('#sidebarCollapse').on('click', function() {
					$('#sidebar, #content').toggleClass('active');
				});

				// Sales chart
				var salesChart = new Chart(document.getElementById("salesChart"), {
					type: 'line',
					data: {
						labels: ["January", "February", "March", "April", "May", "June", "July"],
						datasets: [{
							label: "Sales",
							data: [32, 14, 56, 23, 30, 18, 45],
							fill: false,
							borderColor: 'rgb(75, 192, 192)',
							lineTension: 0.1
						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true
								}
							}]
						}
					}
				});

				// Traffic chart
				var trafficChart = new Chart(document.getElementById("trafficChart"), {
					type: 'pie',
					data: {
						labels: ["Organic Search", "Social Media", "Email", "Referral", "Direct"],
						datasets: [{
							label: "Website Traffic",
							data: [56, 10, 12, 17, 5],
							backgroundColor: [
								'rgb(255, 99, 132)',
								'rgb(54, 162, 235)',
								'rgb(255, 205, 86)',
								'rgb(75, 192, 192)',
								'rgb(153, 102, 255)'
							]
						}]
					}
				});
			});
		</script>
</body>

</html>