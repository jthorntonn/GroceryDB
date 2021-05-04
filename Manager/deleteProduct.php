<?php
session_start();
if($_SESSION['loggedIn']==true){
		//allow processing
}
else{
	echo "<script> window.location.assign('../login/login.php'); </script>";
}

if(isset($_POST['delsubmit'])) {
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		die("Connection failed: " . $connection->connect_error);
	}

	$pName = mysqli_real_escape_string($connection, $_POST['product_name']);
	$id = mysqli_real_escape_string($connection, $_POST['product_id']);

	$query="SELECT pName FROM Sells WHERE pName='$pName' && id=$id";
	$t = mysqli_query($connection, $query);
	$row=mysqli_fetch_array($t);

	if(empty($row)) {
		//echo "empty";
		$query="DELETE FROM Supplies WHERE pName = '$pName' AND id = $id";
		$query2="DELETE FROM Product WHERE pName = '$pName' AND id = $id";

		if( mysqli_query($connection, $query) && mysqli_query($connection, $query2)) {
			header('Location: manager.php');
			mysqli_close($connection);
		}
		else {
			echo 'query error: ' . mysqli_error($connection);
			echo '<script>alert("error!"); window.location.assign("manager.php");</script>';
		}
	}
	else {
		echo '<script>alert("Product cannot be deleted!"); window.location.assign("manager.php");</script>';
	}

	close($connection);
}


?>
