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
   	<button  class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" style="float:right" onclick="location.href = '../login/logout.php';" type="button" id="loginbutton">Logout</button>
	<button  class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" style="float:right" onclick="location.href = '../login/createAccount.php';" type="button" id="loginbutton">Create Account</button> 
</div>
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Store 1</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Store 2</a>
	<a href="#" class="w3-bar-item w3-button w3-padding-large">Store 3</a>       
  </div>

 </div>
</head>
	
<body style="background: #7BCC70;">

	<h3>Store's products</h3>
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
	<!--form action="updateProduct.php" method="post"> <input type="submit" value="Update Product"> </form-->
	<!--form action="addProduct.php" method="post"> <input type="submit" value="Add Product"> </form-->
	<!--form action="removeProduct.php" method="post"> <input type="submit" value="Remove Product"> </form-->
	<button onclick="showHideForm('updateProduct')" style="color: white;background: black;margin-top: 10px;">Update Product</button>
	<button onclick="showHideForm('addProduct')" style="color: white;background: black;margin-top: 10px;">Add Product</button>
	<button onclick="showHideForm('removeProduct')" style="color: white;background: black;margin-top: 10px;">Remove Product</button>

	<div id="updateProduct" style="outline: 2px dashed black; width:70%; margin:auto; padding:10px">
		<h5>Update a product</h5>
		<form action="updateProduct.php" method="post">
			<div style="display:inline-block;">
			<label for="product_name">Name</label><br>
			<input type="text" name="product_name" placeholder="Product Name" required>
			</div>

			<div style="display:inline-block;">
			<label for="product_id">ID</label><br>
			<input type="text" name="product_id" placeholder="Product id" required>
			</div>

			<div style="display:inline-block;">
			<label for="amountSold">Amount Sold</label><br>
			<input type="text" name="amountSold" placeholder="Amount Sold">
			</div>

			<div style="display:inline-block;">
			<label for="dateSold">Date Sold</label><br>
			<input type="date" name="dateSold" placeholder="Date Sold">
			</div>

			<input type="submit" name="submit" value="Update">
		</form>
	</div>

	<div id="addProduct" style="outline: 2px dashed black; width:70%; margin:auto; padding:10px">
		<h3>Available Products that can be added</h3>
		<p>**If desired product is not listed, go to <u>New Product From Supplier</u> button**</p>
		<?php

		$query="SELECT * FROM Product WHERE Product.pName NOT IN 
				(SELECT Product.pName FROM Product NATURAL JOIN Sells NATURAL JOIN Store 
				WHERE Store.phoneNum = \"$phoneN\")";
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
		?>

		<form action="addProduct.php" method="post">
			<div style="display:inline-block;">
			<label for="product_name">Name</label><br>
			<input type="text" name="product_name" placeholder="Product Name" required>
			</div>

			<div style="display:inline-block;">
			<label for="product_id">ID</label><br>
			<input type="text" name="product_id" placeholder="Product id" required>
			</div>

			<div style="display:inline-block;">
			<label for="phoneNum">Phone Number</label><br>
			<input type="text" name="phoneNum" placeholder="Store Phone Number" required>
			</div>

			<div style="display:inline-block;">
			<label for="addr">Address</label><br>
			<input type="text" name="addr" placeholder="Store Address" required>
			</div>

			<div style="display:inline-block;">
			<label for="date">Date Sold</label><br>
			<input type="date" name="date">
			</div>

			<input type="submit" name="submit" value="Add">
		</form>
	</div>

	<div id="removeProduct" style="outline: 2px dashed black; width:70%; margin:auto; padding:10px">
		<h5>Remove a product</h5>
		<form action="removeProduct.php" method="post">
			<div style="display:inline-block;">
			<label for="product_name">Name</label><br>
			<input type="text" name="product_name" placeholder="pName" required>
			</div>
			<div style="display:inline-block;">
			<label for="phoneNum">Phone Number</label><br>
			<input type="text" name="phoneNum" placeholder="store phone Number" required>
			</div>
			<div style="display:inline-block;">
			<label for="addr">Address</label><br>
			<input type="text" name="addr" placeholder="store address" required>
			</div>
			<input type="submit" name="submit" value="Remove">
		</form>
	</div>

	<br><br>

	<h3>Suppliers Informations</h3>

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

	<!--form action="updateSupplier.php" method="post"> <input type="submit" value="Update Supplier"> </form>
	<form action="addSupplier.php" method="post"> <input type="submit" value="Add New Supplier"> </form>
	<form action="removeSupplier.php" method="post"> <input type="submit" value="Remove Supplier"> </form-->

	<button onclick="showHideForm('updateSupplier')" style="color: white;background: black;margin-top: 10px;">Update Supplier</button>
	<button onclick="showHideForm('addSupplier')" style="color: white;background: black;margin-top: 10px;">Add Supplier</button>
	<button onclick="showHideForm('removeSupplier')" style="color: white;background: black;margin-top: 10px;">Remove Supplier</button>

	<div id="updateSupplier" style="outline: 2px dashed black; width:70%; margin:auto; padding:10px">
		<h5>Update a supplier</h5>
		<form action="updateSupplier.php" method="post">
			<div style="display:inline-block;">
			<label for="sName">Name</label><br>
			<input type="text" name="sName" placeholder="Supplier Name" required>
			</div>

			<div style="display:inline-block;">
			<label for="sPhone">Phone Number</label><br>
			<input type="text" name="sPhone" placeholder="Supplier Phone">
			</div>

			<div style="display:inline-block;">
			<label for="shippingDays">Shipping Days</label><br>
			<input type="text" name="shippingDays" placeholder="Shipping Days">
			</div>

			<input type="submit" name="submit" value="Update">
        </form>
	</div>

	<div id="addSupplier" style="outline: 2px dashed black; width:70%; margin:auto; padding:10px">
		<h5>Add a new supplier</h5>
		<form action="addSupplier.php" method="post">
			<div style="display:inline-block;">
			<label for="sName">Name</label><br>
			<input type="text" name="sName" placeholder="Supplier Name" required>
			</div>

			<div style="display:inline-block;">
			<label for="sAddr">Address</label><br>
			<input type="text" name="sAddr" placeholder="Supplier Address" required>
			</div>

			<div style="display:inline-block;">
			<label for="phoneNum">Phone Number</label><br>
			<input type="text" name="phoneNum" placeholder="Supplier Phone Number">
			</div>

			<div style="display:inline-block;">
			<label for="email">Email</label><br>
			<input type="text" name="email" placeholder="Email">
			</div>

			<div style="display:inline-block;">
			<label for="shippingDays">Shipping Days</label><br>
			<input type="text" name="shippingDays" placeholder="ShippingDays">
			</div>
			
			<input type="submit" name="submit" value="Add">
		</form>
	</div>

	<div id="removeSupplier" style="outline: 2px dashed black; width:70%; margin:auto; padding:10px">
		<h5>Remove a supplier</h5>
		<form action="removeSupplier.php" method="post">
			<div style="display:inline-block;">
			<label for="sName">Name</label><br>
			<input type="text" name="sName" placeholder="Supplier Name" required>
			</div>

			<div style="display:inline-block;">
			<label for="sAddr">Address</label><br>
			<input type="text" name="sAddr" placeholder="Supplier Address" required>
			</div>

			<div style="display:inline-block;">
			<label for="sPhoneNum">Phone Number</label><br>
			<input type="text" name="sPhoneNum" placeholder="Supplier Phone Number">
			</div>
		
			<input type="submit" name="submit" value="Remove">
	</form>
	</div>
	
	<br>

	<button onclick="showHideForm('addNewProduct')" style="color: white;background: black;margin-top: 10px;">New Product From Supplier</button>
	<div id="addNewProduct" style="outline: 2px dashed black; width:70%; margin:auto; padding:10px">
	<form action="addNewProduct.php" method="post">
		<p><b>**Please use (or add) a Supplier from <u>Suppliers informations</u> Table**</b></p>
		<div style="display:inline-block;">
		<label for="supplier_name">Supplier Name</label><br>
		<input type="text" name="supplier_name" placeholder="Supplier Name" required>
		</div>

		<div style="display:inline-block;">
		<label for="supplier_addr">Address</label><br>
		<input type="text" name="supplier_addr" placeholder="Supplier Address" required>
		</div><br>

		<div style="display:inline-block;">
		<label for="product_name">Product Name</label><br>
		<input type="text" name="product_name" placeholder="Product Name" required>
		</div>

		<div style="display:inline-block;">
		<label for="product_id">Product Id</label><br>
		<input type="text" name="product_id" placeholder="Product id" required>
		</div>

		<div style="display:inline-block;">
		<label for="description">Product Description</label><br>
		<input type="text" name="description" placeholder="description">
		</div>

		<div style="display:inline-block;">
		<label for="buyP">Buying Price</label><br>
		<input type="text" name="buyP" placeholder="Buy Price">
		</div>

		<div style="display:inline-block;">
		<label for="sellP">Selling Price</label><br>
		<input type="text" name="sellP" placeholder="Sell Price">
		</div><br>

		<div style="display:inline-block;">
		<label for="amount">Amount Supplied</label><br>
		<input type="text" name="amount" placeholder="amount received">
		</div>

		<div style="display:inline-block;">
		<label for="date">Supplied Date</label><br>
		<input type="date" name="date" placeholder="date">
		</div><br>

		<input style="margin-top: 10px;" type="submit" name="prodsubmit" value="Add">
	</form>
	</div>
	
	<br><br><br>
	<h3>Store's Relevant Information</h3>

	<?php
	$phoneN = $_SESSION['phoneNum'];
	$query="SELECT * FROM Store WHERE phoneNum = $phoneN";
	$t = mysqli_query($connection, $query);
	echo '<table border="1" class="center">
		<thead><tr>
		</tr></thead>';
		while($row=mysqli_fetch_array($t)) {
			echo '<tr> <td> Phone  :  '. $row['phoneNum'] .'</td>';
			echo '<td> Address  :  '. $row['addr'] .'</td> </tr>';
		}
		close($connection);
	?>

	<script>
	var x = document.getElementById("updateProduct").style.display = "none";
	var x = document.getElementById("addProduct").style.display = "none";
	var x = document.getElementById("removeProduct").style.display = "none";

	var x = document.getElementById("updateSupplier").style.display = "none";
	var x = document.getElementById("addSupplier").style.display = "none";
	var x = document.getElementById("removeSupplier").style.display = "none";

	var x = document.getElementById("addNewProduct").style.display = "none";
	ids = ["updateProduct", "addProduct", "removeProduct", "updateSupplier", 
				"addSupplier", "removeSupplier", "addNewProduct"];

	function showHideForm(id) {
		var x = document.getElementById(id);
		
		for(let i=0; i < ids.length; i++) {
			if(id != ids[i]) {
				document.getElementById(ids[i]).style.display = "none";
			}
		}

		if (x.style.display === "none") {
				x.style.display = "block";
			} else {
				x.style.display = "none";
			}
		}
	</script>

</body>
</html>
