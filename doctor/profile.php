<?php

session_start();

require_once "../includes/connect.php";

if (!isset($_SESSION['doctorID'])) {

	header("Location: ../doctor.php");
	exit();
}

$sql_doctor = $_SESSION['doctorID'];
$sql = "select * from doctor where doctorID = '$sql_doctor';";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$first = $row['firstName'];
$last = $row['lastName'];
$phone = $row['phoneNumber'];

$sql2 = "select * from booking where doctorID = '$sql_doctor';";
$result2 = $conn->query($sql2);

$sql3="select * from history where doctorID = '$sql_doctor';";
$result3 = $conn->query($sql3);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Book my Appointment - Doctor Profile</title>
	<link rel="shortcut icon" type="image/x-icon" href="../logo.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../scripts/jquery.min.js"></script>
	<script src="../scripts/bootstrap.min.js"></script>
</head>
<body>


	<!-- Bootstrap Navigation Bar Top -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbarTop">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../index.php">Book my Appointment</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbarTop">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../doctor.php">Home</a></li>

					<?php

					if (isset($_SESSION['doctorID'])) {

						//logged in
						echo '
							<li class="active"><a href="profile.php">My Profile</a></li>
							<li><a href="../includes/doctor-logout.php">Log Out</a></li>';
					}
					else {
						echo '
						<li><a href="../index.php">Patients</a></li> ';
					}
					?>

				</ul>
			</div>
		</div>
	</nav>
	<nav class="navbar navbar-inverse" style="margin-bottom: 0;"></nav>

	<br>
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-danger" style="border-color: #cccccc;">
			<div class="panel-heading" style="color: #ffffff; border-color: #cccccc; background-color: #cccccc;">
				<h4 style="text-align: center;">Your Profile</h4>
			</div>
			<div class="panel-body">

				<p align="right"><?php echo "Last Login: ".$_SESSION['lastLogin'] ?></p>

				<h2><?php echo "Welcome Dr. ".$first." ".$last ?></h2>
				<div class="row">

				<div class="col-md-3">
				<h4>Email: </h4>
				<h4>Phone Number: </h4>
				</div>

				<div class="col-md-9">
				<h4><?php echo $_SESSION['email'] ?></h4>
				<h4><?php echo $phone ?></h4>
				</div>

				</div>
				<hr>
				<div>
				<?php
					if ($result2->num_rows < 1) {

						echo "<h2>No Upcoming Appointments!</h2>";
					}
					else {
						echo '
				  <h2>Your Upcoming Appointments</h2>

				  <table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Booking ID</th>
				        <th>Appointment Date</th>
				        <th>Time</th>
				        <th>Patient Name</th>
				        <th>Status</th>
				        <th>Manage</th>
				      </tr>
				    </thead>
				    <tbody>';

				    while ($row=$result2->fetch_assoc()) {
				    	$sql_person = $row['personID'];
				    	$sql4 = "select firstName, lastName from person where personID = '$sql_person';";
						$result4 = $conn->query($sql4);
						$row2 = $result4->fetch_assoc();

				    echo "<tr>
				        <td>".$row['bookingID']."</td>
				        <td>".$row['appointmentDate']."</td>
				        <td>".$row['slot']."</td>
				        <td>".$row2['firstName']." ".$row2['lastName']."</td>
				        <td>".$row['bookingStatus']."</td>
				        <td>";
				    if ($row['bookingStatus'] === 'Booked') {

				    echo "<a href='../includes/doctor-cancel.php?bookingID=".$row['bookingID']."'>
				    	<span>Cancel</span></a>";
				    }
				    else if ($row['bookingStatus'] === 'Cancelled') {

				    echo "<a>
				    	<span class='disabled'>Cancel</span></a>";
				    }
				    echo "</td>
				      </tr>";
				}
				}
				    ?>
				    </tbody>
				  </table>
				</div>

                <div>
                <?php
					if ($result3->num_rows < 1) {

						echo "<h2>No Past Appointments!</h2>";
					}
					else {
						echo '
				  <h2>Your Past Appointments</h2>

				  <table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Booking ID</th>
				        <th>Appointment Date</th>
				        <th>Time</th>
				        <th>Patient Name</th>
				        <th>Status</th>
				      </tr>
				    </thead>
				    <tbody>';

				    while ($row=$result3->fetch_assoc()) {
				    	$sql_person = $row['personID'];
				    	$sql5 = "select firstName, lastName from person where personID = '$sql_person';";
						$result5 = $conn->query($sql5);
						$row2 = $result5->fetch_assoc();

				    echo "<tr>
				        <td>".$row['bookingID']."</td>
				        <td>".$row['appointmentDate']."</td>
				        <td>".$row['slot']."</td>
				        <td>".$row2['firstName']." ".$row2['lastName']."</td>
				        <td>".$row['bookingStatus']."</td>
				      </tr>";
				    }
					}
				    ?>
				    </tbody>
				  </table>
				</div>



			</div>
		</div>
	</div>
	<div class="col-md-3"></div>

	</body>
	</html>
