<?php
session_start();
        if($_SESSION['loggedIn']==true){
                //allow processing
        }
        else{

        echo "<script> window.location.assign('../login/login.php'); </script>";
        }


if(isset($_POST['submit']))	{	// if Add button is pressed
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		die("Connection failed: " . $connection->connect_error);
	}

	$sName = mysqli_real_escape_string($connection, $_POST['sName']);
	$sAddr = mysqli_real_escape_string($connection, $_POST['sAddr']);
	$sPhoneNum = mysqli_real_escape_string($connection, $_POST['phoneNum']);
	$email = mysqli_real_escape_string($connection, $_POST['email']);
	$shippingDays = mysqli_real_escape_string($connection, $_POST['shippingDays']);

	$query="INSERT INTO Supplier (sName, sAddr, sPhoneNum, email, shippingDays) 
			VALUES ('$sName', '$sAddr','$sPhoneNum','$email', '$shippingDays')";

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
<body style="background: #7BCC70;">
	<button style="color: white;background: black; margin-bottom:10px" onclick="location.href = 'manager.php';" type="button" id="loginbutton">Go Back</button>

	<h3>Supplier information</h3>
	<?php
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		die("Connection failed: " . $connection->connect_error);
	}

	$query="SELECT * FROM Supplier";
	$t=mysqli_query($connection, $query);
	echo '<table border="1" class="center">
		<thead><tr>
			<th>Name</th> 
			<th>Address</th> 
			<th>Phone</th> 
			<th>Email</th> 
			<th>ShippingDays</th>
		</tr></thead>';
	while($row=mysqli_fetch_array($t)) {
		echo '<tr> <td>'. $row['sName'] .'</td>';
		echo '<td>'. $row['sAddr'] .'</td>';
		echo '<td>'. $row['sPhoneNum'] .'</td>';
		echo '<td>'. $row['email'] .'</td>';
		echo '<td>'. $row['shippingDays'] .'</td> </tr>';
	}
	echo '</table>';
	mysqli_close($connection);
	?>

	<form action="?" method="post">
		<input type="text" name="sName" placeholder="Supplier Name">
		<input type="text" name="sAddr" placeholder="Address">
		<input type="text" name="phoneNum" placeholder="Supplier Phone Number">
		<input type="text" name="email" placeholder="Email">
		<input type="text" name="shippingDays" placeholder="ShippingDays">
		<input type="submit" name="submit" value="Add">
	</form>
</body>

<html>
