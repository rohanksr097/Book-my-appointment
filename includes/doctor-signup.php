<?php

session_start();

if (isset($_POST['submitDoctorSignup'])) {

	require_once "connect.php";

	$first = $conn->real_escape_string($_POST['first']);
	$last = $conn->real_escape_string($_POST['last']);
	$gender = $conn->real_escape_string($_POST['gender']);
	$dob = $conn->real_escape_string($_POST['dob']);
	$phone = $conn->real_escape_string($_POST['phone']);
	$qualification = $conn->real_escape_string($_POST['qualification']);
	$department = $conn->real_escape_string($_POST['department']);
	$building = $conn->real_escape_string($_POST['building']);
	$experience = $conn->real_escape_string($_POST['experience']);
	$fee = $conn->real_escape_string($_POST['fee']);
	$email = $conn->real_escape_string($_POST['email']);
	$password = $conn->real_escape_string($_POST['password']);
	$question = $conn->real_escape_string($_POST['question']);
	$answer = $conn->real_escape_string($_POST['answer']);

	//error handlers
	//check for empty fields
	if (empty($first) || empty($gender) || empty($dob) || empty($phone) || empty($qualification) || empty($department) || empty($building) || empty($experience) || empty($fee) || empty($email) || empty($password) || empty($question) || empty($answer)) {

		header("Location: ../doctor/signup.php?signup=empty");
		exit();
	}

	//check for valid inputs
	if (!preg_match("/^[a-zA-Z ]*$/", $first) || !preg_match("/^[a-zA-Z ]*$/", $last) || !preg_match("/^[1-9][0-9]{9}$/", $phone) || !preg_match("/^[0-9]{1,2}$/", $experience) || !preg_match("/^[0-9]{1,4}$/", $fee)) {

		header("Location: ../doctor/signup.php?signup=invalid");
		exit();
	}

	//check for valid email
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

		header("Location: ../doctor/signup.php?signup=invalid");
		exit();
	}

	//check for already registered
	$sql = "select * from doctorLogin where email = '$email';";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

		$_SESSION['doctor_already_registered'] = 1;

		header("Location: ../doctor/login.php?signup=already_registered");
		exit();
	}

	//hashing the password
	$hashedPassword = md5($password);

	//hashing the answer
	$hashedAnswer = md5($answer);

	//start transaction
	$conn->autocommit(FALSE);

	//insert data into doctor table
	$sql = "insert into doctor (firstName, lastName, gender, dob, phoneNumber, registerDate, qualification, departmentID, buildingID, experience, fee) values ('$first', '$last', '$gender', '$dob', '$phone', curdate(), '$qualification', '$department', '$building', '$experience', '$fee');";

	if ($conn->query($sql) !== TRUE) {

		//echo "Error: " . $conn->error;
		$conn->rollback();
		header("Location: ../doctor/signup.php?signup=error");
		exit();
	}

	//insert data into doctorLogin table
	$sql = "insert into doctorLogin (doctorID, email, password, question, answer, lastLogin) values (last_insert_id(), '$email', '$hashedPassword', '$question', '$hashedAnswer', now());";

	if ($conn->query($sql) !== TRUE) {

		//echo "Error: " . $conn->error;
		$conn->rollback();
		header("Location: ../doctor/signup.php?signup=error");
		exit();
	}

	//commit transaction
	$conn->commit();

	//enable autocommit
	$conn->autocommit(TRUE);

	$_SESSION['doctorSignup'] = 1;

	header("Location: ../doctor/login.php?signup=success");
	exit();

} else {
	header("Location: ../doctor.php");
	exit();
}
