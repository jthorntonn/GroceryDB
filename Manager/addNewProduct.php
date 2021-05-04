<?php
session_start();
if($_SESSION['loggedIn']==true){
		//allow processing
}
else{
	echo "<script> window.location.assign('../login/login.php'); </script>";
}

if(isset($_POST['prodsubmit'])) {
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		die("Connection failed: " . $connection->connect_error);
	}

	$sName = mysqli_real_escape_string($connection, $_POST['supplier_name']);
	$sAddr = mysqli_real_escape_string($connection, $_POST['supplier_addr']);
	$amount = mysqli_real_escape_string($connection, $_POST['amount']);
	$date = mysqli_real_escape_string($connection, $_POST['date']);

	$pName = mysqli_real_escape_string($connection, $_POST['product_name']);
	$id = mysqli_real_escape_string($connection, $_POST['product_id']);

	$description = mysqli_real_escape_string($connection, $_POST['description']);
	$buyPrice = mysqli_real_escape_string($connection, $_POST['buyP']);
	$sellPrice = mysqli_real_escape_string($connection, $_POST['sellP']);

	$query="INSERT INTO Product (pName, id, description, buyPrice, sellPrice) 
	VALUES ('$pName', $id, '$description', $buyPrice, $sellPrice)";

	$query2="INSERT INTO Supplies (pName, id, sName, sAddr, amountReceived, date) 
	VALUES ('$pName', $id, '$sName', '$sAddr', $amount, '$date')";

	if( mysqli_query($connection, $query) && mysqli_query($connection, $query2)) {
		mysqli_close($connection);
		header('Location: manager.php');
	}
	else {
		echo 'alert(query error: ' . mysqli_error($connection) .')';
	}

	close($connection);
}
?>
