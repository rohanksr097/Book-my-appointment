<?php
session_start();
require_once "includes/connect.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>LOGIN</title>
    <link rel="shortcut icon" type="image/x-icon" href="../logo.png">
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="scripts/jquery.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
</head>
<style>
body{
  scroll-behavior: smooth;
  overflow-x: hidden;
}

.b{padding-left:15px;
padding-top:10px;}

.c{padding:3px;}
.a{margin-top:55px;}

.thumb{margin-top:2px;
border:1px solid black;
background-color:rgb(240, 240, 240);
}
 #footer{ margin-top:3px;
padding:10px;
border-top:1px solid DodgerBlue;
color: #eeeeee;
background-color: #211f22;
text-allign:centre;
}
.btn-i{ margin-right:25px; margin-bottom: 25px;float:right;}

</style>
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
				<a class="navbar-brand" href="index.php">Book my Appointment</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbarTop">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="index.php">Patients</a></li>
					<li><a href="doctor.php">Doctors</a></li>

					<?php

					if (isset($_SESSION['personID'])) {

						//logged in
						echo '
							<li><a href="person/profile.php">My Profile</a></li>
							<li><a href="includes/person-logout.php">Log Out</a></li>';
					}
                    else {

						//not logged in
						echo '
							<li><a href="person/login.php">Log In</a></li>
							<li><a href="person/signup.php">Sign Up</a></li>';
					}

					?>

				</ul>
			</div>
		</div>
	</nav>
	<nav class="navbar navbar-inverse" style="margin-bottom: 0;"></nav>

	<div class="container-fluid">
	<div class="container a">
	<div class="row">

		<?php
			$doctorID = $_GET["doctorID"];
			$sql = "select * from doctor where doctorID = '$doctorID';";
			$result = $conn->query($sql);

			if($row = $result->fetch_assoc()) {

		        $firstName = $row["firstName"];
		        $lastName = $row["lastName"];
		        $gender = $row["gender"];
		        $phone = $row["phoneNumber"];
		        $qualification = $row["qualification"];
		        $departmentID = $row['departmentID'];
		        $buildingID = $row['buildingID'];
		        $experience = $row["experience"];
		        $fee = $row["fee"];
			}

			$sql = "select * from department where departmentID = '$departmentID';";
			$result = $conn->query($sql);

			if($row = $result->fetch_assoc()) {

		        $departmentName = $row['name'];
			}

			$sql = "select * from building where buildingID = '$buildingID';";
			$result = $conn->query($sql);

			if($row = $result->fetch_assoc()) {

		        $buildingName = $row['name'];
		        $buildingType = $row['type'];
		        $addressLine1 = $row['addressLine1'];
		        $addressLine2 = $row['addressLine2'];
		        $addressLine3 = $row['addressLine3'];
		        $city = $row['city'];
		        $pin = $row['pin'];
			}

			$conn->close();
		?>

		<div class="media thumb">
            <div class="media-body b">
                <div class="row"><div class="col-md-12">
                    <h3 class="media-heading">
                    <?php echo "Dr. ".$firstName." ".$lastName;?></h3>
                    <br>
                </div></div>
                <div class="row">

                <div class="col-md-5"><h4>
                <p>Gender:&nbsp;&nbsp;&nbsp;&nbsp; </p>
                <p>Phone Number:&nbsp;&nbsp;&nbsp;&nbsp; </p>
               	<p>Qualification:&nbsp;&nbsp;&nbsp;&nbsp; </p>
                <p>Department:&nbsp;&nbsp;&nbsp;&nbsp; </p>
                <p>Experience:&nbsp;&nbsp;&nbsp;&nbsp; </p>
                <p>Fee: </p>&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                </div>

                <div class="col-md-7"><h4>
                <p><?php echo $gender;?></p>
                <p><?php echo $phone;?></p>
                <p><?php echo $qualification;?></p>
                <p><?php echo $departmentName;?></p>
                <p><?php echo $experience." years";?></p>
                <p><?php echo "&#8377; ".$fee;?></p></h4>
                </div>
                </div>
                <br>
                <br>
                <div class="row">
                	<div class="col-md-12">
                    	<h4 class="media-heading"><?php echo $buildingType." Address: ";?></h4>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-1"></div>
                    <div class="col-md-9">
                    	<h3><?php echo $buildingName;?></h3>
                    	<h4><?php echo $addressLine1.", ".$addressLine2.",";?></h4>
                    	<h4><?php echo $addressLine3.", ".$city." - ".$pin;?></h4>
                	</div>
                	<div class="col-md-2">
                <br>
                <br>
                <br>
                <a href="booking.php?doctorID=<?php echo $doctorID; ?>"><span class="btn btn-i btn-danger">
                Book &rsaquo;&rsaquo;
                </span></a>
                </div>
                </div>

            </div>
        </div><br>
        </div></div>
    </div>
</body>
</html>
