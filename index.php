<!DOCTYPE html>
<html>
<head>
	<title>Grocery Store</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/galleryScript.js"></script>
	<?php
		//	goal: get product name, price, total amount
		if($connection=@mysqli_connect('localhost','fdondjeutschoufack1','fdondjeutschoufack1','GroceryDB')) {
			$query="SELECT * FROM Sells NATURAL JOIN Product NATURAL JOIN Store";
			$t =mysqli_query($connection, $query);
			$food_array = array();
			while($row=mysqli_fetch_array($t)) {
				//echo $row['pName'];
				array_push($food_array, 
					array($row['name'],$row['phoneNum'],$row['addr'],$row['pName'],$row['description'],$row['sellPrice']) );
			}
			//print_r($food_array);

			// send array to js
			echo '<script> var food_array = ' . json_encode($food_array) . '; </script>' ;
		}
		else{
			echo 'not connected to DB!';
		}	
	?>	
</head>
<body>
	<div class="header">
		<div class="header-middle">
			<h1>STORE.COM</h1>
			<p id="addr">Store address goes here...</p>
			<p id="storeNumb">Store #</p>
		</div>
		<div class="header-login">
			<button type="button" id="loginbutton">Manager<br>Login</button>
		</div>
	</div>

	<div class="search">
		<form>
			<input type="text" name="search" id="searchbar-1" placeholder="search...">
		</form>
	</div>

	<div class="gallery-slider">
		<div class="gallery-container">	
			<!-- script fills class with product from db --!>
			<script src="js/foodData.js"> </script>
		</div>
		
		<div class="gallery-controls">
			<ul>
				<li id="<"><</li>
				<li id=">">></li>
			</ul>
		</div>
	</div>

</body>
</html>

