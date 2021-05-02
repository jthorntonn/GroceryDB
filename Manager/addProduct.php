<?php

if(isset($_POST['submit']))	{	// if Add button is pressed
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		die("Connection failed: " . $connection->connect_error);
	}

	$pName = mysqli_real_escape_string($connection, $_POST['product_name']);
	$id = mysqli_real_escape_string($connection, $_POST['product_id']);
	$phoneNum = mysqli_real_escape_string($connection, $_POST['phoneNum']);
	$addr = mysqli_real_escape_string($connection, $_POST['addr']);
	$date = mysqli_real_escape_string($connection, $_POST['date']);

	$query="INSERT INTO Sells (pName, id, phoneNum, addr, amountSold, date) 
			VALUES ('$pName', $id,'$phoneNum','$addr', 0, '$date')";

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
	<?php
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		die("Connection failed: " . $connection->connect_error);
	}

	$query="SELECT * FROM Product WHERE Product.pName NOT IN 
			(SELECT Product.pName FROM Product NATURAL JOIN Sells NATURAL JOIN Store 
			WHERE Store.phoneNum = \"1234567890\")";
	$t=mysqli_query($connection, $query);
	echo '<table border="1" class="center">
		<thead><tr>
			<th>Name</th> 
			<th>id</th> 
			<th>Description</th> 
			<th>buyPrice</th> 
			<th>sellPrice</th>
		</tr></thead>';
	while($row=mysqli_fetch_array($t)) {
		echo '<tr> <td>'. $row['pName'] .'</td>';
		echo '<td>'. $row['id'] .'</td>';
		echo '<td>'. $row['description'] .'</td>';
		echo '<td>'. $row['buyPrice'] .'</td>';
		echo '<td>'. $row['sellPrice'] .'</td> </tr>';
	}
	echo '</table>';
	mysqli_close($connection);
	?>

	<form action="?" method="post">
		<input type="text" name="product_name" placeholder="Product Name">
		<input type="text" name="product_id" placeholder="Product id">
		<input type="text" name="phoneNum" placeholder="Store Phone Number" value="1234567890">
		<input type="text" name="addr" placeholder="Store Address">
		<input type="date" name="date">
		<input type="submit" name="submit" value="Add">
	</form>
</body>

<html>
