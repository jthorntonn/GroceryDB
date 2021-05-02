<?php

if(isset($_POST['submit']))	{
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		die("Connection failed: " . $connection->connect_error);
	}

	$pName = mysqli_real_escape_string($connection, $_POST['product_name']);
	$phoneNum = mysqli_real_escape_string($connection, $_POST['phoneNum']);
	$addr = mysqli_real_escape_string($connection, $_POST['addr']);

	$query="DELETE FROM Sells WHERE pName = '$pName' AND phoneNum = '$phoneNum' AND addr = '$addr'";

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
		<input type="text" name="product_name" placeholder="pName">
		<input type="text" name="phoneNum" placeholder="phone Number">
		<input type="text" name="addr" placeholder="address">
		<input type="submit" name="submit" value="Remove">
	</form>
</body>

<html>
