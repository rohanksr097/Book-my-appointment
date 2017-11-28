<?php

require_once "../includes/connect.php";

$sql1 = "select departmentID, name from department;";
$result1 = $conn->query($sql1);

$sql2 = "select buildingID, name from building;";
$result2 = $conn->query($sql2);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Book my Appointment - Doctor Sign Up</title>
	<link rel="shortcut icon" type="image/x-icon" href="../logo.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../scripts/jquery.min.js"></script>
	<script src="../scripts/bootstrap.min.js"></script>
	<script src="../scripts/validate.js"></script>
</head>
<body>
	<br>
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-danger" style="border-color: #cccccc;">
			<div class="panel-heading" style="color: #ffffff; border-color: #cccccc; background-color: #cccccc;">
				<h4 style="text-align: center;">Doctor's Registration</h4>
			</div>
			<div class="panel-body">
				<br>
				<form class="form-horizontal" name="myForm" action="../includes/doctor-signup.php" onsubmit="return validateFormDoctorSignup()" method="POST">
					<div class="form-group">
						<label class="control-label col-md-3">First Name:</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="first" placeholder="Enter First Name" onblur="return validateName(this)" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Last Name:</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="last" placeholder="Enter Last Name" onblur="return validateName(this)">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Gender:</label>
						<div class="col-md-9">
							<select class="form-control" name="gender">
								<option value="female">Female</option>
								<option value="male">Male</option>
								<option value="other">Other</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Date of Birth:</label>
						<div class="col-md-9">
							<input type="date" class="form-control" name="dob" value="<?php echo date("Y-m-d"); ?>" min="1900-01-01" max="<?php echo date("Y-m-d"); ?>" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Phone Number:</label>
						<div class="col-md-9">
							<input type="number" class="form-control" name="phone" placeholder="Enter Phone Number" min="1000000000" max="9999999999" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Qualifications:</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="qualification" placeholder="Enter Educational Qualifications" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Department:</label>
						<div class="col-md-9">
							<select class="form-control" name="department">
								<?php
									while ($row = $result1->fetch_assoc()) {

										echo "<option value='" . $row['departmentID'] . "'>" . $row['name'] . "</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Hospital / Clinic:</label>
						<div class="col-md-9">
							<select class="form-control" name="building">
								<?php
									while ($row = $result2->fetch_assoc()) {

										echo "<option value='" . $row['buildingID'] . "'>" . $row['name'] . "</option>";
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Experience:</label>
						<div class="col-md-9">
							<input type="number" class="form-control" name="experience" placeholder="Enter Experience (in years)" min="0" max="99" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Fee:</label>
						<div class="col-md-9">
							<input type="number" class="form-control" name="fee" placeholder="Enter Fee Amount" min="0" max="9999" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Email:</label>
						<div class="col-md-9">
							<input type="email" class="form-control" name="email" placeholder="Enter Email" onblur="return validateEmail(this)" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Password:</label>
						<div class="col-md-9">
							<input type="password" class="form-control" name="password" placeholder="Create a Password" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Security Question:</label>
						<div class="col-md-9">
							<select class="form-control" name="question">
								<option value="In what city or town was your mother born?">In what city or town was your mother born?</option>
								<option value="What street did you live on when you were 8 years old?">What street did you live on when you were 8 years old?</option>
								<option value="What was the last name of your first grade teacher?">What was the last name of your first grade teacher?</option>
								<option value="What was your grandfather's occupation?">What was your grandfather's occupation?</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Security Answer:</label>
						<div class="col-md-9">
							<input type="password" class="form-control" name="answer" placeholder="Enter Security Answer" required>
						</div>
					</div>
					<br>
					<div class="form-group">
						<label class="control-label col-md-3"></label>
						<div class="col-md-9">
							<button type="submit" name="submitDoctorSignup">Submit</button>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3"></label>
						<div class="col-md-9">
							<p>Already a member? <a href="login.php">Log In</a></p>
							<p><a href="../doctor.php">Back to Home</a></p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</body>
</html>
