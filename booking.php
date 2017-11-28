<?php
session_start();

require_once "includes/connect.php";

if(!isset($_SESSION['login']) && !($_SESSION['login'])) {
		//echo $_SESSION['notLogged'];
		//display logged in modal
		header("Location: person/login.php?notLogged=1");
		exit();
}
$_SESSION['bookedDoctor'] = $_GET['doctorID'];
?>

<html>
<head><title>Book my appointment - Booking</title>
	<link rel="shortcut icon" type="image/x-icon" href="logo.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../scripts/jquery.min.js"></script>
<script src="../scripts/bootstrap.min.js"></script>
<script src="../scripts/validate.js"></script>
</head>
<style media="screen">
body{
	scroll-behavior: smooth;
	overflow-x: hidden;
}
</style>
<body>

<br>
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-danger" style="border-color: #d9534f;">
			<div class="panel-heading" style="color: #ffffff; border-color: #d9534f; background-color: #d9534f;">
				<h4 style="text-align: center;">Select Time Slot</h4>
			</div>
			<div class="panel-body">
				<br>
				<form class="form-horizontal" name="myForm" action="includes/booking.php" method="POST">
					<div class="form-group">
						<label class="control-label col-md-3"><?php echo date('d/m/Y', strtotime("+1 days")); ?> :</label>
						<div class="col-md-9">
							<input type="radio" name="slot" value="slot1" checked> 09:00&nbsp;&nbsp;
  							<input type="radio" name="slot" value="slot2"> 10:00&nbsp;&nbsp;
  							<input type="radio" name="slot" value="slot3"> 11:00&nbsp;&nbsp;
							<input type="radio" name="slot" value="slot4"> 12:00&nbsp;&nbsp;
							<input type="radio" name="slot" value="slot5"> 17:00&nbsp;&nbsp;
  							<input type="radio" name="slot" value="slot6"> 18:00&nbsp;
  							<input type="radio" name="slot" value="slot7"> 19:00&nbsp;
							<input type="radio" name="slot" value="slot8"> 20:00
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3"><?php echo date('d/m/Y', strtotime("+2 days")); ?> :</label>
						<div class="col-md-9">
							<input type="radio" name="slot" value="slot9"> 09:00&nbsp;&nbsp;
  							<input type="radio" name="slot" value="slot10"> 10:00&nbsp;&nbsp;
  							<input type="radio" name="slot" value="slot11"> 11:00&nbsp;&nbsp;
							<input type="radio" name="slot" value="slot12"> 12:00&nbsp;&nbsp;
							<input type="radio" name="slot" value="slot13"> 17:00&nbsp;&nbsp;
  							<input type="radio" name="slot" value="slot14"> 18:00&nbsp;
  							<input type="radio" name="slot" value="slot15"> 19:00&nbsp;
							<input type="radio" name="slot" value="slot16"> 20:00
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3"><?php echo date('d/m/Y', strtotime("+3 days")); ?> :</label>
						<div class="col-md-9">
							<input type="radio" name="slot" value="slot17"> 09:00&nbsp;&nbsp;
  							<input type="radio" name="slot" value="slot18"> 10:00&nbsp;&nbsp;
  							<input type="radio" name="slot" value="slot19"> 11:00&nbsp;&nbsp;
							<input type="radio" name="slot" value="slot20"> 12:00&nbsp;&nbsp;
							<input type="radio" name="slot" value="slot21"> 17:00&nbsp;&nbsp;
  							<input type="radio" name="slot" value="slot22"> 18:00&nbsp;
  							<input type="radio" name="slot" value="slot23"> 19:00&nbsp;
							<input type="radio" name="slot" value="slot24"> 20:00
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3"></label>
						<div class="col-md-9">
							<button type="submit" class="btn btn-danger" name="bookedSlot">Confirm</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</body>
</html>
