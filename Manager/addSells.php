<?php
session_start();
        if($_SESSION['loggedIn']==true){
                //allow processing
        }
        else{

        echo "<script> window.location.assign('../login/login.php'); </script>";
        }

        $phoneN = $_SESSION['phoneNum'];
                //"1234567890";

if(isset($_POST['submit']))	{
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		die("Connection failed: " . $connection->connect_error);
	}


	//Store values for the new data point 
	$pName = mysqli_real_escape_string($connection, $_POST['pName']);
	$pID = mysqli_real_escape_string($connection, $_POST['id']);
	$descrip = mysqli_real_escape_string($connection, $_POST['description']);
  	$buyP = mysqli_real_escape_string($connection, $_POST['buyPrice']);
  	$sellP = mysqli_real_escape_string($connection, $_POST['sellPrice']);
	$sName = mysqli_real_escape_string($connection, $_POST['sName']);
	$sAddr = mysqli_real_escape_string($connection, $_POST['sAddr']);
	$amount = mysqli_real_escape_string($connection, $_POST['amountReceived']);
	$date = mysqli_real_escape_string($connection, $_POST['date']);

        	
	//Query to add new data
	$query="INSERT INTO Product (pName, id, description, buyPrice,sellPrice
				VALUES('$pName', '$pID', '$descrip', '$buyP', '$sellP') ";
	$query2="INSERT INTO Supplies (pName, id, sName, sAddr, amountReceived, date)
				VALUES('$pName', '$pID', '$sName', '$sAddr', '$amount', '$date')";


	if( mysqli_query($connection, $query) && mysqli_query($connection, $query2) {
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

<!--Form for attributes needed-->
	<form action="?" method="post">
		<input type="text" name="pName" placeholder="Product Name">
		<input type="text" name="id" placeholder="Product ID">
		<input type="text" name="description" placeholder="Description">
		<input type="text" name="buyPrice" placeholder="Buy Price">
		<input type="text" name="sellPrice" placeholder="Sell Price">
		<input type="text" name="sName" placeholder="Supplier Name">
		<input type="text" name="sAddr" placeholder="Supplier Address">
		<input type="text" name="amountReceived" placeholder="Amount Received">
		<input type="date" name="date" placeholder="Date">
		<input type="submit" name="submit" value="Add">
		</form>
</body>

</html>
