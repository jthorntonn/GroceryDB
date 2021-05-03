<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>


<div class="w3-top">
  <div class="w3-bar w3-green w3-card w3-left-align w3-large">
<<<<<<< HEAD
   	<button  class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" style="float:right" onclick="location.href = '../login/logout.php';" type="button" id="loginbutton">Logout</button>
	<button  class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" style="float:right" onclick="location.href = '../login/createAccount.php';" type="button" id="loginbutton">Create Account</button> 
</div>
=======
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="../homepage.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <form action="../gallery.php" method="get"><input class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" type="submit" value="Store 1" name="STORE"></form>
    <form action="../gallery.php" method="get"><input class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" type="submit" value="Store 2" name="STORE"></form>
    <form action="../gallery.php" method="get"><input class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" type="submit" value="Store 3" name="STORE"></form>

  </div>
>>>>>>> 269eaa3dcad7696379e05309a9eb6978aae96bb0

 
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Store 1</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Store 2</a>
	<a href="#" class="w3-bar-item w3-button w3-padding-large">Store 3</a>       
  </div>

 </div>
</head>
	

<body>
	<?php
	session_start();
        if($_SESSION['loggedIn']==true){
                //allow processing
        }
        else{

        echo "<script> window.location.assign('../login/login.php'); </script>";
        }

	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		//die prints message then ends script
		die("Connection failed: " . $connection->connect_error);
	}

	$phoneN = $_SESSION['phoneNum'];
		//"1234567890";

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
	<form action="updateProduct.php" method="post"> <input type="submit" value="Update"> </form>
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

	<form action="updateSupplier.php" method="post"> <input type="submit" value="Update"> </form>
	<form action="addSupplier.php" method="post"> <input type="submit" value="Add"> </form>
	<form action="removeSupplier.php" method="post"> <input type="submit" value="Remove"> </form>

</body>
</html>
