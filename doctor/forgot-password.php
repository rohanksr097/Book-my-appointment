<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Book my Appointment - Doctor Forgot Password</title>
	<link rel="shortcut icon" type="image/x-icon" href="../logo.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../scripts/jquery.min.js"></script>
	<script src="../scripts/bootstrap.min.js"></script>
	<script src="../scripts/validate.js"></script>

	<?php

	if (isset($_SESSION['doctor_invalid_email']) && $_SESSION['doctor_invalid_email']) {

		//display doctor invalid email modal
		echo '
			<script>
				$(document).ready(function(){
					$("#doctorInvalidEmailModal").modal();
				});
			</script>';
		$_SESSION['doctor_invalid_email'] = 0;
	}

	if (isset($_SESSION['doctor_invalid_answer']) && $_SESSION['doctor_invalid_answer']) {

		//display doctor invalid answer modal
		echo '
			<script>
				$(document).ready(function(){
					$("#doctorInvalidAnswerModal").modal();
				});
			</script>';
		$_SESSION['doctor_invalid_answer'] = 0;
	}

	?>

</head>
<body>
	<!-- Doctor Invalid Email Modal -->
	<div id="doctorInvalidEmailModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal Content -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Invalid Email!</h3>
				</div>
				<div class="modal-body">
					<h4>Please try again...</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

	<!-- Doctor Invalid Answer Modal -->
	<div id="doctorInvalidAnswerModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal Content -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Invalid Answer!</h3>
				</div>
				<div class="modal-body">
					<h4>Please try again...</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

	<br>
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-danger" style="border-color:Black;">
			<div class="panel-heading" style="color: #ffffff; border-color: #cccccc; background-color: #cccccc;">
				<h4 style="text-align: center;">Forgot Password?</h4>
			</div>
			<div class="panel-body">
				<br>
				<form class="form-horizontal" name="myForm" action="reset-password.php" onsubmit="return validateFormEmail()" method="POST">
					<div class="form-group">
						<label class="control-label col-md-3">Email:</label>
						<div class="col-md-9">
							<input type="email" class="form-control" name="email" placeholder="Enter Email" onblur="return validateEmail(this)" required>
						</div>
					</div>
					<br>
					<div class="form-group">
						<label class="control-label col-md-3"></label>
						<div class="col-md-9">
							<button type="submit" name="submitDoctorForgotPassword">Submit</button>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3"></label>
						<div class="col-md-9">
							<p>Not a member? <a href="signup.php">Sign Up</a></p>
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
