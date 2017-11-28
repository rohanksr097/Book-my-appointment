<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Book my Appointment - Doctor Log In</title>
	<link rel="shortcut icon" type="image/x-icon" href="../logo.png">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../scripts/jquery.min.js"></script>
	<script src="../scripts/bootstrap.min.js"></script>
	<script src="../scripts/validate.js"></script>

	<?php

	if (isset($_SESSION['doctorSignup']) && $_SESSION['doctorSignup']) {

		//display doctor sign up success modal
		echo '
			<script>
				$(document).ready(function(){
					$("#doctorSignUpSuccessModal").modal();
				});
			</script>';
		$_SESSION['doctorSignup'] = 0;
	}

	if (isset($_SESSION['doctor_already_registered']) && $_SESSION['doctor_already_registered']) {

		//display doctor already registered modal
		echo '
			<script>
				$(document).ready(function(){
					$("#doctorAlreadyRegisteredModal").modal();
				});
			</script>';
		$_SESSION['doctor_already_registered'] = 0;
	}

	if (isset($_SESSION['doctor_invalid_login']) && $_SESSION['doctor_invalid_login']) {

		//display doctor invalid log in modal
		echo '
			<script>
				$(document).ready(function(){
					$("#doctorInvalidLogInModal").modal();
				});
			</script>';
		$_SESSION['doctor_invalid_login'] = 0;
	}

	if (isset($_SESSION['doctorReset']) && $_SESSION['doctorReset']) {

		//display doctor reset success modal
		echo '
			<script>
				$(document).ready(function(){
					$("#doctorResetSuccessModal").modal();
				});
			</script>';
		$_SESSION['doctorReset'] = 0;
	}

	?>

</head>
<body>
	<!-- Doctor Sign Up Success Modal -->
	<div id="doctorSignUpSuccessModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal Content -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Sign Up Successful!</h3>
				</div>
				<div class="modal-body">
					<h4>Please log in to continue...</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

	<!-- Doctor Already Registered Modal -->
	<div id="doctorAlreadyRegisteredModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal Content -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Already Registered!</h3>
				</div>
				<div class="modal-body">
					<h4>Please log in to continue...</h4>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>

	<!-- Doctor Invalid Log In Modal -->
	<div id="doctorInvalidLogInModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal Content -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Invalid Email or Password!</h3>
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

	<!-- Doctor Reset Success Modal -->
	<div id="doctorResetSuccessModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal Content -->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Password Reset Successful!</h3>
				</div>
				<div class="modal-body">
					<h4>Please log in to continue...</h4>
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
		<div class="panel panel-danger" style="border-color: #808080;">
			<div class="panel-heading" style="color: black; border-color: #8080; background-color: #cccccc;">
				<h4 style="text-align: center;">Doctor's Login <br> <img src="../images/logo.png" alt="logo" style="height:100px; width:100px;border-radius: 50%;margin: 24px 0 12px 0;"> </h4>

			</div>
			<div class="panel-body">
				<br>
				<form class="form-horizontal" name="myForm" action="../includes/doctor-login.php" onsubmit="return validateFormEmail()" method="POST">
					<div class="form-group">
						<label class="control-label col-md-3">Email:</label>
						<div class="col-md-9">
							<input type="email" class="form-control" name="email" placeholder="Enter Email" onblur="return validateEmail(this)" required>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Password:</label>
						<div class="col-md-9">
							<input type="password" class="form-control" name="password" placeholder="Enter Password" required>
						</div>
					</div>
					<br>
					<div class="form-group">
						<label class="control-label col-md-3"></label>
						<div class="col-md-9">
							<button type="submit"  name="submitDoctorLogin">Submit</button>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3"></label>
						<div class="col-md-9">
							<p>Not a member? <a href="signup.php">Register</a></p>
							<p><a href="forgot-password.php">Forgot Password?</a></p>
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
