<!DOCTYPE html>    
<html>    
<head>    
    <title>Login Form</title>    
    <link rel="stylesheet" type="text/css" href="./example.css"> 
        
   
</head>    
<body>    
    <h2>Login Page</h2><br>    
    <div class="login">    
    <form id="login" method="post" action="login.php">    
        <label><b>User Name     
        </b>    
        </label>    
        <input type="text" name="Uname" id="Uname" placeholder="Username">    
        <br><br>    
        <label><b>Password     
        </b>    
        </label>    
        <input type="Password" name="Pass" id="Pass" placeholder="Password">    
        <br><br>    
        <input type="button" name="log" id="log" value="Log In Here">       
        <br><br>    
        <input type="checkbox" id="check">    
        <span>Remember me</span>    
        <br><br>    
        Forgot <a href="#">Password</a>    
    </form>     
</div>    
<?php

	session_start();
        $_SESSION['loggedIn'] = NULL;
        $PASSWORD = $_POST['Pass'];
        $USERNAME = $_POST['Uname'];

	$query="SELECT * FROM LoginInfo where username = '$USERNAME'";


                include '../functions.php';
                $connection= connect();
                if(!$connection){
                        die("Connection failed: " . $connection->connect_error);
                }
                $r=mysqli_query($connection, $query);


                $loginInfo = array();
                while($row=mysqli_fetch_array($r)){
                        array_push($loginInfo, array($row['username'], $row['password']) );
                }
                $testUser = $loginInfo[0][0];
                $testPass = $loginInfo[0][1];
                echo $testUser;

                echo "";
        //password_verify($password, $hashPassword) == true
        if($USERNAME == $testUser && password_verify($PASSWORD, $testPass) == true){
                $_SESSION['loggedIn'] = true;
                echo "<script> window.location.assign('../logs.php'); </script>";
        }
        else if($USERNAME != NULL && $PASSWORD != NUll){

                echo "<p><center>Username/Password is incorrect.</center></p>";
	}
?>
</body>
</html>    
