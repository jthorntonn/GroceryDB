<!DOCTYPE html>
<html>
<head>
	<title>Grocery Store</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
	body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
	.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
	.fa-anchor,.fa-coffee {font-size:200px}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/galleryScript.js"></script>
	<?php
	include 'functions.php';
	$connection = connect();
	if (!$connection) {
		//die prints message then ends script
		die("Connection failed: " . $connection->connect_error);
	}

	$query="SELECT * FROM Sells NATURAL JOIN Product NATURAL JOIN Store";
	$t =mysqli_query($connection, $query);
	$food_array = array();
	while($row=mysqli_fetch_array($t)) {
		//a double array of each stores with relevant data
		array_push($food_array, array($row['name'],$row['phoneNum'],$row['addr'],$row['pName'],$row['description'],$row['sellPrice']) );
	}
	// turn php array into js array
	echo '<script> var food_array = ' . json_encode($food_array) . '; </script>' ;
	close($connection);
	?>	
</head>
<body>
	<div class="header">
		<div class="header-middle"> 
			<h1><a href="index.php" style="color:white"</a>STORE.COM</h1>
			<a href="https://www.google.com/maps/place/409+N+Fruitland+Blvd,+Fruitland,+MD+21826/@38.3282466,-75.6126314,17z/data=!3m1!4b1!4m5!3m4!1s0x89b90419c85f14af:0x86eed8df71b325f4!8m2!3d38.3282424!4d-75.6104427" style="color:white"<p id="addr">Store address goes here...</p></a>
			<select id="storeNumb">
				<option value="Store1">Store 1</option>
				<option value="Store2" selected >Store 2</option> 
			</select>	
		</div>
	<div class="w3-top">
  <div class="w3-bar w3-green w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="homepage.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Store 1</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Store 2</a>
	<a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Store 3</a>
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
		<div class="gallery-container"> </div>
		<script>
		/* Insert data from DB into html to be styled inta a gallery view  */
		for(let i=0; i < food_array.length; i++) {
			if( food_array[i][0] == $("#storeNumb").val()) {
				var image = "'GroceryDB-Images/" + food_array[i][3] + ".jpg'"; 
				$("#addr").html(food_array[i][2]);
				$(".gallery-container" ).append(
					"<div class=\"item\"> <img src="+ image +" style=\"width:100%; height:250px;\"/> <div class=\"foodinfo\" >" +
					food_array[i][3] + "<br>" + 
					food_array[i][4] + "<br>$" +
					food_array[i][5] + "</div></div>");
			}	
		}
		</script>
		<div class="gallery-controls">
			<ul>
				<li id="<"><</li>
				<li id=">">></li>
			</ul>
		</div>
	</div>
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
		<p class="w3-text-black">Footer</p>
 </div>
</footer>
</body>
</html>

<!--
	say wee have a folder name "Pictures" that has images.
	The images are named after each products from the database
	e.g Bread.png, Kale.png, Ground Beef.png

	To kind of automatically call them, we could do something like:

	if( food_array[i][0] == $("#storeNumb").val()) {
		

***		$picture_location = "Pictures\" + food_array[i][3] + ".png";
						//the folder	the food name	 the extention
		
						
		$("#addr").html(food_array[i][2]);
		$(".gallery-container" ).append(
***			"<div class=\"item\"> <img src=" + $picture_location + "> <div class=\"foodinfo\" >" +
			food_array[i][3] + "<br>" +
			food_array[i][4] + "<br>$" +
			food_array[i][5] + "</div></div>");
	}

	just double check the quotes when adding it to the script
	-->
