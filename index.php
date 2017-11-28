<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Book My Appointment</title>
	<link rel="shortcut icon" type="image/x-icon" href="logo.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="scripts/jquery.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(redirectToPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function redirectToPosition(position) {
            window.location='result.php?latitude='+position.coords.latitude+'&longitude='+position.coords.longitude+'&searchText='+document.forms["search1"]["searchText"].value;
        }
  </script>
	<?php

	if(isset($_GET['booking']) && $_GET['booking'] == 'error') {
		echo '
			<script>
				$(document).ready(function(){
					$("#bookingFailModal").modal();
				});
			</script>';
	}

    if(isset($_GET['booking']) && $_GET['booking'] == 'success') {
		echo '
			<script>
				$(document).ready(function(){
					$("#bookingSuccessModal").modal();
				});
			</script>';
	}

	if (isset($_SESSION['login']) && $_SESSION['login']) {

//display after login modal
		echo '
			<script>
				$(document).ready(function(){
					$("#loggedInModal").modal();
				});
			</script>';
		$_SESSION['login'] = 0;
	}
	if (isset($_SESSION['logout']) && $_SESSION['logout']) {

		//display after log out modal
		echo '
			<script>
				$(document).ready(function(){
					$("#loggedOutModal").modal();
				});
			</script>';
		$_SESSION['logout'] = 0;
	}
	?>
</head>
<style>
body{
	scroll-behavior: smooth;
	overflow-x: hidden;
}
</style>
<body>
	<!-- Failed Booking Modal -->
	<div id="bookingFailModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Failed!</h3>
				</div>
				<div class="modal-body">
					<h4>Appointment not booked!</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<!-- Successful Booking Modal -->
	<div id="bookingSuccessModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Successful!</h3>
				</div>
				<div class="modal-body">
					<h4>You have booked an appointment!</h4>
                    <h4>Your booking ID is <?php echo $_SESSION['bookingID']; ?></h4>
					<h4>Appointment date is <?php echo $_SESSION['appointmentdate']; ?></h4>
					<h4>Timing : <?php echo $_SESSION['appointmenttime']; ?></h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Logged In Modal -->
	<div id="loggedInModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Welcome!</h3>
				</div>
				<div class="modal-body">
					<h4>You are logged in!</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Logged Out Modal -->
	<div id="loggedOutModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Bye!</h3>
				</div>
				<div class="modal-body">
					<h4>You are logged out!</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Navigation Bar Fixed Top -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbarTop">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><strong>Book my Appointment</strong></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbarTop">
				<ul class="nav navbar-nav navbar-right">
					<li class="active"><a href="index.php">Home</a></li>

					<?php

					if (isset($_SESSION['personID'])) {

						// if logged in
						echo '
							<li><a href="person/profile.php">My Profile</a></li>
							<li><a href="includes/person-logout.php">Log Out</a></li>';
					}
                    else {

						//if not logged in
						echo '
							<li><a href="doctor.php">Doctor</a></li>
							<li><a href="person/login.php">Log In</a></li>
							<li><a href="person/signup.php">Register</a></li>';
					}

					?>
				</ul>
			</div>
		</div>
	</nav>
	<nav class="navbar navbar-inverse" style="margin-bottom: 0;"></nav>

	<!-- Bootstrap Carousel -->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>
		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<div class="item active">
				<img src="images/1.jpg" alt="Slide 1">
			</div>
			<div class="item">
				<img src="images/2.jpeg" alt="Slide 2">
			</div>
			<div class="item">
				<img src="images/3.jpg" alt="Slide 3">
			</div>
		</div>
		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<!-- Search -->
	<div class="container-fluid" style="background-color: #28328c;">
		<br>
		<h1 style="color: White; text-align: center;">Search for your Doctor</h1>
		<br>
		<!--<form name="search1" action="result.php">-->
			<div class="container-fluid">
				<div class="col-md-2"></div>
				<div class="col-md-2">
					<div class="input-group input-group-lg">
						<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
						<select class="form-control" id="selectCity">
							<option>Mysuru</option>
							<option>Bengaluru</option>
							<option>Mandya</option>
							<option>Ramanagara</option>
							<option>Tumkuru</option>
						</select>
					</div>
					<br>
				</div>
				<div class="col-md-6">
					<div class="input-group input-group-lg">
						<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
						<form name="search1">
						<select type="text" class="form-control input-lg" name="searchText" placeholder="Search by Department...">
							<option value="Ayurveda">Ayurveda</option>
	 						<option value="Dentist">Dental</option>
	 						<option value="General Physician">General Physician</option>
	 						<option value="Gynecologist">Gynecologist</option>
							<option value="Neurosurgeon">Neurosurgeon</option>
						</select>
						</form>
						<div class="input-group-btn">
							<button type="submit" class="btn btn-default" onclick="getLocation()">
								<i class="glyphicon glyphicon-search"></i>
							</button>
						</div>
					</div>
					<br>
				</div>
				<div class="col-md-2"></div>
			</div>
		<!--</form>-->
	</div>
	<!-- Search Image -->
	<div class="carousel-inner">
		<div class="item active">
			<img src="images/search.png" alt="Search Image">
		</div>
	</div>

	<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-6">
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<h1>Book your prefered doctors at your finger tips.<br>
		<b>100% Guaranteed.</b></h1>
		<br>
		<h1>Instant appointment with your specialist.<br>
		<b>Register now.</b></h1>
	</div>
	<div class="col-md-3">
		<img src="images/5.png" height="498" width="325">
	</div>
	<div class="col-md-2"></div>
	</div>
</body>
</html>
