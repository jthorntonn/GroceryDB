
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

if(isset($_POST['submit']))	{	// if Add button is pressed
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		die("Connection failed: " . $connection->connect_error);
	}

	$pName = mysqli_real_escape_string($connection, $_POST['product_name']);
	$id = mysqli_real_escape_string($connection, $_POST['product_id']);
	$amountSold = mysqli_real_escape_string($connection, $_POST['amountSold']);
	//$date = mysqli_real_escape_string($connection, $_POST['dateSold']);
	$date=$_POST['dateSold'];
	$query="UPDATE Sells SET amountSold='$amountSold',date='$date' 
		WHERE pName='$pName' && id='$id'";

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
	<button style="color: white;background: black; margin-bottom:10px" onclick="location.href = 'manager.php';" type="button" id="loginbutton">Go Back</button>

	<p>Store Products</p>

	<?php
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		die("Connection failed: " . $connection->connect_error);
	}
//	$phoneN="1234567890";
	$query= "SELECT * FROM Sells NATURAL JOIN Store WHERE Store.phoneNum = $phoneN";
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
	<form action="?" method="post">
		<input type="text" name="product_name" placeholder="Product Name">
		<input type="text" name="product_id" placeholder="Product id">
		<input type="text" name="amountSold" placeholder="Amount Sold">
		<input type="date" name="dateSold" placeholder="Date Sold">
		<input type="submit" name="submit" value="Update">
	</form>
</body>

<html>
