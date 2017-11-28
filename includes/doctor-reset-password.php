<?php

session_start();

if (isset($_POST['submitDoctorResetPassword'])) {

	require_once "connect.php";

	$email = $_SESSION['email'];
	$answer = $conn->real_escape_string($_POST['answer']);
	$password = $conn->real_escape_string($_POST['password']);

	//error handlers
	//check for empty fields
	if (empty($answer) || empty($password)) {

		header("Location: ../doctor/forgot-password.php?reset=empty");
		exit();
	}

	//verify answer
	//hashing the answer
	$hashedAnswer = md5($answer);

	if ($hashedAnswer !== $_SESSION['answer']) {

		$_SESSION['doctor_invalid_answer'] = 1;

		header("Location: ../doctor/forgot-password.php?reset=invalid_answer");
		exit();
	}

	//hashing the password
	$hashedPassword = md5($password);

	//update password
	$sql = "update doctorLogin set password = '$hashedPassword' where email = '$email';";

	if ($conn->query($sql) !== TRUE) {

		//echo "Error: " . $conn->error;
		header("Location: ../doctor/forgot-password.php?reset=error");
		exit();
	}

	session_unset();
	session_destroy();

} else {
	header("Location: ../doctor.php");
	exit();
}

?>

<?php

session_start();

$_SESSION['doctorReset'] = 1;

header("Location: ../doctor/login.php?reset=success");
exit();
