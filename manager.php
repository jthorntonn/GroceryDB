<!--Add php session var-->


<!DOCTYPE html>

<html>

<head>
	<title>ManagerEditSoftware</title>
	<!--Link css style sheet-->
	<link rel="stylesheet" type="text/css" href="css/manager-home.css">
</head>

<body>

	<!--Header div-->
	<div class ="header">
	<div class ="header-logo">
		<h1>STORE.COM<h1>
	</div>
	

	<div class="header-logout">
		<button type="button" id="logoutbutton">Manager<br>Logout</button>
	</div>
	
	<div class="editing button">
		<button type="button" id="addbutton">Add<br>Items</button>
		<button type="button" id="deletebutton">Delete<br>Items</button>
		<button type="button" id="editbutton">Edit<br>Items</button>
	</div>

	</div>

		
	<!--Display Tables-->
	<div class = "products"> 

<?php
	echo"<table class = table><tr><th> Name </th> <th> ID </th> <th> phoneNum </th><th> Amount Sold</th> <th> Date </th></tr>";
	
	$connection = mysqli_connect('localhost', 'slefever1', 'slefever1', 'GroceryDB');
	$query = "SELECT * FROM Sells LEFT JOIN Store ON Store.phoneNum = Sells.phoneNum";
	$result = mysqli_query($connection, $query);

	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td class= table-entry>" . $row['pName'] . "</td>";
		echo "<td class= table-entry>" . $row['id'] . "</td>";
		echo "<td class= table-entry>" . $row['phoneNum'] . "</td>";
	        echo "<td class= table-entry>" . $row['amountSold'] . "</td>";
	        echo "<td class= table-entry>" . $row['date'] . "</td></tr>";
	}

	echo"</table>";

	mysqli_close($connection);
?>

	<!-- Display the rest of the table using php and sql query -->
	</div>
 <div class = "suppliers">

<?php
	//Create the header for the supplier table
	echo "<table><tr>";
	echo "<th> Name </th>";
	echo "<th> Address </th>";
	echo "<th> PhoneNum </th>";
	echo "<th> Email </th>";
	echo "<th> Shipping Days </th></tr>";

	//Establish sql connection
	$connection = mysqli_connect('localhost', 'slefever1', 'slefever1', 'GroceryDB');

	$query = "SELECT * FROM Supplier";
	$result = mysqli_query($connection, $query);

	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td class= table-entry>" . $row['sName'] . "</td>";
		echo "<td class= table-entry>" . $row['sAddr'] . "</td>";
		echo "<td class= table-entry>" . $row['sPhoneNum'] . "</td>";
		echo "<td class= table-entry>" . $row['email'] . "</td>";
		echo "<td class= table-entry>" . $row['shippingDays'] . "</td></tr>";
	}

	echo"</table>";
	mysqli_close($connection);


?>
</body>

</html>
