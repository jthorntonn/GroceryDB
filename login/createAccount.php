




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

<link rel="stylesheet" href="./example.css">
</head>
<body>

<!--
        <p align = 'center' style = 'color: black;'>Create Account</p>
 <form method = post >

       <p align = 'center' style = 'color: black;'> Username:<br> <input type="text" name="USERNAME" placeholder='search'>

        <br>Password:<br> <input type = "text" name = "PASSWORD" placeholder ='search'>
	<br>
	PhoneNum: <br> <input type = "text" name = "PHONENUM" placeholder ='search'>
	<br>
        <input type ="submit">
        </p>
</form>
--!>



<br><br><br><br><br><br><br>
<div class="login">
        <p align = 'center' style = 'color: #7BCC70;'>Create Account</p>
 <form id="login" method = post >

    <!--   <p align = 'center' style = 'color: black;'>--!><label><b>Username:</b></label><br> <input type="text" id="USERNAME"  name="USERNAME" placeholder='search'>

        <br><label><b>Password:<b></label><br> <input type = "password" id = "PASSWORD" name = "PASSWORD" placeholder ='search'>
	<br>
	<label><b>PhoneNum:<b></label><br><input type = "text" id = "PHONENUM" name= "PHONENUM" placeholder='search'><br><br>
        <input type ="submit" id="submit" name="Enter">
<!--    </p>     --!>
</form>
</div>



<?php
session_start();
        session_start();
        if($_SESSION['loggedIn']==true){
        	//allow processing
        }
        else{

        echo "<script> window.location.assign('login.php'); </script>";
        }

        $PASSWORD = $_POST['PASSWORD'];
	$USERNAME = $_POST['USERNAME'];
	$PHONENUM = $_POST['PHONENUM'];
	echo $USERNAME;
	echo $PASSWORD;
if($PASSWORD != NULL && $USERNAME != NULL && $PHONENUM != NULL){
	$hashPassword = password_hash($PASSWORD, PASSWORD_BCRYPT);
                //$hashPassword = '$2y$10$MtCWoSIqAEzSrmW6GIJdjuUHXZEcN3AUb3B7kR3xCi4WkvZrrRsKK';
	echo $hashPassword;
	if(password_verify($PASSWORD, $hashPassword) == true){
                        echo "its good.";
                }
 

	
		 $query="INSERT INTO LoginInfo VALUES('$USERNAME','$hashPassword', '$PHONENUM')";


                include '../functions.php';
                $connection= connect();
                if(!$connection){
                        die("Connection failed: " . $connection->connect_error);
                }
                $r=mysqli_query($connection, $query);
		echo "<script> window.location.assign('../Manager/manager.php'); </script>";
}
               // $loginInfo = array();
               // while($row=mysqli_fetch_array($r)){
               //         array_push($loginInfo, array($row['username'], $row['password']) );
               // }
               // $testUser = $loginInfo[0][0];
               // $testPass = $loginInfo[0][1];
                //echo $testUser;
                //echo $testPass;

        //password_verify($password, $hashPassword) == true
       // if($USERNAME == $testUser && password_verify($PASSWORD, $testPass) == true){
        //        $_SESSION['loggedIn'] = true;
          //      echo "<script> window.location.assign('logs.php'); </script>";
       // }
       // else if($USERNAME != NULL && $PASSWORD != NUll){

         //       echo "<p><center>Username/Password is incorrect.</center></p>";


       // }

?>

