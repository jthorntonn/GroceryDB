<?php

session_start();
        if($_SESSION['loggedIn']==true){
                //allow processing
        }
        else{

        echo "<script> window.location.assign('../login/login.php'); </script>";
        }

if(isset($_POST['submit']))	{
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		die("Connection failed: " . $connection->connect_error);
	}

	$sName = mysqli_real_escape_string($connection, $_POST['sName']);
	$sAddr = mysqli_real_escape_string($connection, $_POST['sAddr']);
	$phoneNum = mysqli_real_escape_string($connection, $_POST['sPhoneNum']);

	$query="DELETE FROM Supplier WHERE sName = '$sName' AND sPhoneNum = '$phoneNum' AND sAddr = '$sAddr'";

	if( mysqli_query($connection, $query) ) {
		header('Location: manager.php');
		mysqli_close($connection);
	}
	else {
		echo 'query error: ' . mysqli_error($connection);
	}
}
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>

	<form action="?" method="post">
		<input type="text" name="sName" placeholder="Supplier Name">
		<input type="text" name="sAddr" placeholder="Supplier Address">
		<input type="text" name="sPhoneNum" placeholder="Supplier Phone Number">
		<input type="submit" name="submit" value="Remove">
	</form>
</body>

<html>
