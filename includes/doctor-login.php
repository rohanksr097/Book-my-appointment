<?php

session_start();

if (isset($_POST['submitDoctorLogin'])) {

	require_once "connect.php";

	$email = $conn->real_escape_string($_POST['email']);
	$password = $conn->real_escape_string($_POST['password']);

	//error handlers
	//check for empty fields
	if (empty($email) || empty($password)) {

		header("Location: ../doctor/login.php?login=empty");
		exit();
	}

	//check for valid email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

		header("Location: ../doctor/login.php?login=invalid");
		exit();
	}

	//verify email
	$sql = "select * from doctorLogin where email = '$email';";
	$result = $conn->query($sql);

	if ($result->num_rows < 1) {

		$_SESSION['doctor_invalid_login'] = 1;

		header("Location: ../doctor/login.php?login=invalid_login");
		exit();
	}

	if ($row = $result->fetch_assoc()) {

		//hashing the password
		$hashedPassword = md5($password);

		//verify password
		if ($hashedPassword !== $row['password']) {

			$_SESSION['doctor_invalid_login'] = 1;

			header("Location: ../doctor/login.php?login=invalid_login");
			exit();
		}

		$did = $row['doctorID'];
		$sql = "update doctorLogin set lastLogin = now() where doctorID = '$did';";
		$result = $conn->query($sql);

		$_SESSION['doctorID'] = $row['doctorID'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['lastLogin'] = $row['lastLogin'];
		$_SESSION['doctorLogin'] = 1;

		header("Location: ../doctor.php?login=success");
		exit();
	}

} else {
	header("Location: ../doctor.php");
	exit();
}
