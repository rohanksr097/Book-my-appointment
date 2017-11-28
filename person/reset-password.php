<?php

session_start();

if (isset($_POST['submitPersonForgotPassword'])) {

	require_once "../includes/connect.php";

	$email = $conn->real_escape_string($_POST['email']);

	//error handlers
	//check for empty fields
	if (empty($email)) {

		header("Location: forgot-password.php?reset=empty");
		exit();
	}

	//check for valid email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

		header("Location: forgot-password.php?reset=invalid");
		exit();
	}

	//verify email
	$sql = "select * from personLogin where email = '$email';";
	$result = $conn->query($sql);

	if ($result->num_rows < 1) {

		$_SESSION['invalid_email'] = 1;

		header("Location: forgot-password.php?reset=invalid");
		exit();
	}

	//get security question
	if ($row = $result->fetch_assoc()) {

		$_SESSION['email'] = $row['email'];
		$_SESSION['answer'] = $row['answer'];
		$question = $row['question'];
	}

} else {
	header("Location: ../index.php");
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Book my Appointment - Reset Password</title>
	<link rel="shortcut icon" type="image/x-icon" href="../logo.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../scripts/jquery.min.js"></script>
	<script src="../scripts/bootstrap.min.js"></script>
</head>
<body>
	<br>
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 style="text-align: center;">Reset Password</h4>
			</div>
			<div class="panel-body">
				<br>
				<form class="form-horizontal" action="../includes/person-reset-password.php" method="POST">
					<div class="form-group">
						<label class="control-label col-md-3">Security Question:</label>
						<div class="col-md-9">
							<label class="control-label">
								<?php
									echo $question;
								?>
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Security Answer:</label>
						<div class="col-md-9">
							<input type="password" class="form-control" name="answer" placeholder="Enter Security Answer" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Password:</label>
						<div class="col-md-9">
							<input type="password" class="form-control" name="password" placeholder="Create a new Password" required>
						</div>
					</div>
					<br>
					<div class="form-group">
						<label class="control-label col-md-3"></label>
						<div class="col-md-9">
							<button type="submit" class="btn btn-primary" name="submitPersonResetPassword">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>
</body>
</html>
