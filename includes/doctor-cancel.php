<?php

session_start();
require_once "connect.php";
$bookingID = $_GET['bookingID'];

$sql = "update booking set bookingStatus = 'Cancelled' where bookingID = $bookingID;";
if ($conn->query($sql) !== TRUE) {
        
		header("Location: ../doctor.php?cancel=error");
		exit();
}

header("Location: ../doctor.php?cancel=success");
exit();
?>


