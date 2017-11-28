<?php
session_start();
require_once "includes/connect.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Book my Appointment - LOGIN</title>
    <link rel="shortcut icon" type="image/x-icon" href="logo.png">
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
		<div class="col-sm-9">

            <?php

                $x = $_GET["searchText"];

                $sql1 = "select departmentID, name from department where name like '$x';";
                $result1 = $conn->query($sql1);

                if($result1->num_rows > 0) {
                    while($row = $result1->fetch_assoc()) {
                        $departmentID = $row['departmentID'];
                        $departmentName = $row['name'];

                        $latitude_loc = $_GET['latitude'];
                        $longitude_loc = $_GET['longitude'];


                $sql2 = "   SELECT doctor.*, building.*, department.*,
                            sqrt((building.latitude-$latitude_loc)*(building.latitude-$latitude_loc)+(building.longitude-$longitude_loc)*(building.longitude-$longitude_loc))*100 AS distance
                            FROM doctor, building, department
                            WHERE doctor.buildingID = building.buildingID
                            AND doctor.departmentID = department.departmentID
                            AND department.departmentID = '$departmentID'
                            ORDER BY distance;
                        ";
                $result2 = mysqli_query($conn,$sql2);

                //$result = mysqli_query("select * from doctor where department = '$x';");

                //$sql = "select * from doctor where department = '$x';";

                //$result = mysqli_query($conn, $sql);

                if ($result2->num_rows > 0) {
                    // output data of each row
                    while($row = $result2->fetch_assoc()) {
                        $firstName = $row["firstName"];
                        $lastName = $row["lastName"];
                        $gender = $row["gender"];
                        $experience = $row["experience"];
                        $qualification = $row["qualification"];
                        $fee = $row["fee"];
                        $doctorID = $row["doctorID"];
                        $distance = $row["distance"];
                        $distance = floor($distance*10)/10;
                    ?>
                    <div class="media thumb">
                        <div class="media-body b">
                            <div class="row"><div class="col-md-12">
                                <h3 class="media-heading">
                                <?php echo "Dr. ".$firstName." ".$lastName;?></h3>
                                <br>
                            </div></div>
                            <div class="row">

                            <div class="col-md-3"><h4>
                            <p>Gender:&nbsp;&nbsp;&nbsp;&nbsp;</p>
                           	<p>Qualification:&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            <p>Department:&nbsp;&nbsp;&nbsp;&nbsp;</p>
		                    <p>Experience:&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            <p>Fee:&nbsp;&nbsp;&nbsp;&nbsp;</p>
                            <p>Distance:&nbsp;&nbsp;&nbsp;&nbsp;</p></h4>
                            </div>

                            <div class="col-md-7"><h4>
                            <p><?php echo $gender;?></p>
                            <p><?php echo $qualification;?></p>
                            <p><?php echo $departmentName;?></p>
                            <p><?php echo $experience." years";?></p>
                            <p><?php echo "&#8377; ".$fee;?></p>
                            <p><?php echo $distance." KM";?></p></h4>
                            </div>
                            <div class="col-md-2">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <a href="result2.php?doctorID=<?php echo $doctorID; ?>"><span class="btn btn-i btn-danger">
                            View &rsaquo;&rsaquo;
                            </span></a>
                            </div>
                            </div>
                        </div>
                    </div>
                    <br>
           <?php   }
               }
               }
                }
                else {
                    echo "<h4>Your search - '$x' - did not match any doctors.</h4>";
                }

                $conn->close();
           ?>
           </div></div></div></div>
</body>
</html>
