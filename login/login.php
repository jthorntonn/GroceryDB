
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
body{
                        background: #7BCC70


                        }

</style>


<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-green w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="../homepage.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <form action="../gallery.php" method="post"><input class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" type="submit" value="Store 1" name="STORE"></form>
    <form action="../gallery.php" method="post"><input class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" type="submit" value="Store 2" name="STORE"></form>
    <form action="../gallery.php" method="post"><input class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" type="submit" value="Store 3" name="STORE"></form>

  </div>

  <!-- Navigation Bar 2 -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Store 1</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Store 2</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">Store 3</a>
  </div>
</div>




<title>Grocery Store</title>
<!--        <link rel="stylesheet" type="text/css" href="../css/index.css"> --!>
   
<!--	<link rel="stylesheet" type="text/css" href="./login.css"> --!>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="../js/galleryScript.js"></script>
   
	<link rel="stylesheet" href="./example.css">	
</head>
<body>
<br><br><br><br><br><br><br>
<div class="login">
	<p align = 'center' style = 'color: #7BCC70;'>LOGIN</p>
 <form id="login" method = post >

    <!--   <p align = 'center' style = 'color: black;'>--!><label><b>Username:</b></label><br> <input type="text" id="USERNAME"  name="USERNAME" placeholder='search'>

        <br><label><b>Password:<b></label><br> <input type = "password" id = "PASSWORD" name = "PASSWORD" placeholder ='search'>
	<br><br><br>
	<input type ="submit" id="submit" name="Enter">
<!--	</p>     --!>
</form>
</div>

<!--
	<h2>LOGIN</h2><br>
	<div class="login">
	<form id="login" method="post">
		<label><b> Username:</b></label>
		<input type="text" name="USERNAME" id="USERNAME" placeholder="Username">
		<br><br>
		<label><b>Password</b></label>
		<input type="password" name="PASSWORD" placeholder="Password">
		<br><br>
		<input type = "button" name="submit">
		<br><br>
	</form>
	</div>

--!>
<?php
session_start();
	$_SESSION['loggedIn'] = NULL;
        $PASSWORD = $_POST['PASSWORD'];
	$USERNAME = $_POST['USERNAME'];


//	if(isset($_POST["Enter"])){

	$query="SELECT * FROM LoginInfo where username = '$USERNAME'";
	
                 
		include '../functions.php';
		$connection= connect();
		if(!$connection){
			die("Connection failed: " . $connection->connect_error);
		}
                $r=mysqli_query($connection, $query);

		
		$loginInfo = array();
		while($row=mysqli_fetch_array($r)){
			array_push($loginInfo, array($row['username'], $row['password'], $row['phoneNum']) );
		}
		$testUser = $loginInfo[0][0];
		$testPass = $loginInfo[0][1];
		$PHONENUM = $loginInfo[0][2];
	//	echo $testUser;
	
		echo "";
	//password_verify($password, $hashPassword) == true
	if($USERNAME == $testUser && password_verify($PASSWORD, $testPass) == true){
		$_SESSION['loggedIn'] = true;
		$_SESSION['phoneNum'] = $PHONENUM;
		echo "<script> window.location.assign('../Manager/manager.php'); </script>";
	}
	else if($USERNAME != NULL && $PASSWORD != NUll){

		echo "<p><center>Username/Password is incorrect.</center></p>";

			
//	}
	}
?>

</body>
</html>

