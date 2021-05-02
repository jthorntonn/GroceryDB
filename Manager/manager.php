<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>
	<?php
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		//die prints message then ends script
		die("Connection failed: " . $connection->connect_error);
	}
	$phoneN = "1234567890";

	$query="SELECT * FROM Sells NATURAL JOIN Store WHERE Store.phoneNum = $phoneN";
	$t = mysqli_query($connection, $query);

	echo '<table border="1" class="center">
		<thead><tr>
			<th>Product Name</th> 
			<th>Product ID</th> 
			<th>Amount Sold</th> 
			<th>Date Sold</th>
		</tr></thead>';
	while($row=mysqli_fetch_array($t)) {
		echo '<tr> <td>'. $row['pName'] .'</td>';
		echo '<td>'. $row['id'] .'</td>';
		echo '<td>'. $row['amountSold'] .'</td>';
		echo '<td>'. $row['date'] .'</td> </tr>';
	}
	
	echo '</table>';
	?>

	<form action="" method="post"> <input type="submit" value="Update"> </form>
	<form action="addProduct.php" method="post"> <input type="submit" value="Add"> </form>
	<form action="removeProduct.php" method="post"> <input type="submit" value="Remove"> </form>

	<?php

	$query="SELECT * FROM Supplier";
	$t=mysqli_query($connection, $query);

	echo '<table border="1" class="center">
		<thead><tr>
			<th>Supplier Name</th> 
			<th>Address</th> 
			<th>PhoneNumber</th> 
			<th>email</th> 
			<th>Shipping Days</th>
		</tr></thead>';
	while($row=mysqli_fetch_array($t)) {
		echo '<tr> <td>'. $row['sName'] .'</td>';
		echo '<td>'. $row['sAddr'] .'</td>';
		echo '<td>'. $row['sPhoneNum'] .'</td>';
		echo '<td>'. $row['email'] .'</td>';
		echo '<td>'. $row['shippingDays'] .'</td> </tr>';
	}
	echo '</table>';
	?>

	<form action="" method="post"> <input type="submit" value="Update"> </form>
	<form action="" method="post"> <input type="submit" value="Add"> </form>
	<form action="" method="post"> <input type="submit" value="Remove"> </form>
	
	<?php
	$phoneN = "1234567890";

	$query="SELECT Supplies.sName, Supplies.pName, Supplies.id, Supplies.amountReceived, Supplies.date 
			FROM Supplies RIGHT JOIN Sells ON Supplies.pName = Sells.pName 
			WHERE Sells.phoneNum = $phoneN";
	$t = mysqli_query($connection, $query);

	echo '<table border="1" class="center">
		<thead><tr>
			<th>Supplier Name</th> 
			<th>Product Name</th> 
			<th>Product ID</th> 
			<th>Amount Received</th> 
			<th>Date Recceived</th>
		</tr></thead>';
	while($row=mysqli_fetch_array($t)) {
		echo '<tr> <td>'. $row['sName'] .'</td>';
		echo '<td>'. $row['pName'] .'</td>';
		echo '<td>'. $row['id'] .'</td>';
		echo '<td>'. $row['amountReceived'] .'</td>';
		echo '<td>'. $row['date'] .'</td> </tr>';
	}
	echo '</table>';
	mysqli_close($connection);
	?>

	<form action="" method="post"> <input type="submit" value="Add"> </form>
	<form action="" method="post"> <input type="submit" value="Remove"> </form>

</body>
</html>
