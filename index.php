<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Grocery Store</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">
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
			<h1>STORE.COM</h1>
			<p id="addr">Store address goes here...</p>
			<select id="storeNumb">
				<option value="Store1" selected>Store 1</option>
				<option value="Store2">Store 2</option> 
			</select>
		</div>
		<div class="header-login">
			<button type="button" id="loginbutton">Manager<br>Login</button>
		</div>
	</div>
	
	<?php
		$_SESSION["username"] = "user_name";
		$_SESSION["password"] - "pass_word";
	?>

	<div class="search">
		<form>
			<input type="text" name="search" id="searchbar-1" placeholder="search...">
		</form>
	</div>

	<div class="gallery-slider" style="float:left;">
		<div class="gallery-container" style="float:left;"> </div>
		<script>
		/* Insert data from DB into html to be styled inta a gallery view  */
		for(let i=0; i < food_array.length; i++) {
			if( food_array[i][0] == $("#storeNumb").val()) {
				$("#addr").html(food_array[i][2]);
				$(".gallery-container" ).append(
					"<div class=\"item\"> <div class=\"foodinfo\" >" +
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
</body>
</html>
