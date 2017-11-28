<?php

session_start();

if (isset($_POST['submitPersonSignup'])) {

	require_once "connect.php";

	$first = $conn->real_escape_string($_POST['first']);
	$last = $conn->real_escape_string($_POST['last']);
	$gender = $conn->real_escape_string($_POST['gender']);
	$dob = $conn->real_escape_string($_POST['dob']);
	$phone = $conn->real_escape_string($_POST['phone']);
	$email = $conn->real_escape_string($_POST['email']);
	$password = $conn->real_escape_string($_POST['password']);
	$question = $conn->real_escape_string($_POST['question']);
	$answer = $conn->real_escape_string($_POST['answer']);

	//error handlers
	//check for empty fields
	if (empty($first) || empty($gender) || empty($dob) || empty($phone) || empty($email) || empty($password) || empty($question) || empty($answer)) {

		header("Location: ../person/signup.php?signup=empty");
		exit();
	}

	//check for valid inputs
	if (!preg_match("/^[a-zA-Z ]*$/", $first) || !preg_match("/^[a-zA-Z ]*$/", $last) || !preg_match("/^[1-9][0-9]{9}$/", $phone)) {

		header("Location: ../person/signup.php?signup=invalid");
		exit();
	}

	//check for valid email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

		header("Location: ../person/signup.php?signup=invalid");
		exit();
	}

	//check for already registered
	$sql = "select * from personLogin where email = '$email';";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

		$_SESSION['already_registered'] = 1;

		header("Location: ../person/login.php?signup=already_registered");
		exit();
	}

	//hashing the password
	$hashedPassword = md5($password);

	//hashing the answer
	$hashedAnswer = md5($answer);

	//start transaction
	$conn->autocommit(FALSE);

	//insert data into person table
	$sql = "insert into person (firstName, lastName, gender, dob, phoneNumber, registerDate) values ('$first', '$last', '$gender', '$dob', '$phone', curdate());";

	if ($conn->query($sql) !== TRUE) {

		//echo "Error: " . $conn->error;
		$conn->rollback();
		header("Location: ../person/signup.php?signup=error");
		exit();
	}

	//insert data into personLogin table
	$sql = "insert into personLogin (personID, email, password, question, answer, lastLogin) values (last_insert_id(), '$email', '$hashedPassword', '$question', '$hashedAnswer', now());";

	if ($conn->query($sql) !== TRUE) {

		//echo "Error: " . $conn->error;
		$conn->rollback();
		header("Location: ../person/signup.php?signup=error");
		exit();
	}

	//commit transaction
	$conn->commit();

	//enable autocommit
	$conn->autocommit(TRUE);

	$_SESSION['signup'] = 1;

	header("Location: ../person/login.php?signup=success");
	exit();

} else {
	header("Location: ../index.php");
	exit();
}
