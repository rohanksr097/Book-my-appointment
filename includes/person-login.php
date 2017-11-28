<?php

session_start();

if (isset($_POST['submitPersonLogin'])) {

	require_once "connect.php";

	$email = $conn->real_escape_string($_POST['email']);
	$password = $conn->real_escape_string($_POST['password']);

	//error handlers
	//check for empty fields
	if (empty($email) || empty($password)) {

		header("Location: ../person/login.php?login=empty");
		exit();
	}

	//check for valid email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

		header("Location: ../person/login.php?login=invalid");
		exit();
	}

	//verify email
	$sql = "select * from personLogin where email = '$email';";
	$result = $conn->query($sql);

	if ($result->num_rows < 1) {

		$_SESSION['invalid_login'] = 1;

		header("Location: ../person/login.php?login=invalid_login");
		exit();
	}

	if ($row = $result->fetch_assoc()) {

		//hashing the password
		$hashedPassword = md5($password);

		//verify password
		if ($hashedPassword !== $row['password']) {

			$_SESSION['invalid_login'] = 1;

			header("Location: ../person/login.php?login=invalid_login");
			exit();
		}

		$pid = $row['personID'];
		$sql = "update personLogin set lastLogin = now() where personID = '$pid';";
		$result = $conn->query($sql);

		$_SESSION['personID'] = $row['personID'];
		$_SESSION['email'] = $row['email'];
		$_SESSION['lastLogin'] = $row['lastLogin'];
		$_SESSION['login'] = 1;

		header("Location: ../index.php?login=success");
		exit();
	}

} else {
	header("Location: ../index.php");
	exit();
}
