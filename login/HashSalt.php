
	<?php
		
		$password = "Qwerty12";

		$oldhashPassword = password_hash($password, PASSWORD_BCRYPT);
		$hashPassword = '$2y$10$SFedgZU6R/lLplucjk9EeOOzZhjqtLb9o6eM8WH3DGi.GQ5APyqS.';
		echo $oldhashPassword;
		//echo $hashPassword;
		if(password_verify($password, $hashPassword) == true){
			echo "its good.";
		}
		else{
			echo "its not good.";
		}



		//incase I forget Password.
		//Username: AwesomeGuy1
		//password: Password1
		//phoneNum: 1234567890 - store 1
		//
		//Username: Test1
		//Password: Password2
		//phoneNum: 9876543210 - store 2
		//
		//Username: rkern3
		//Username: rkern3
		//phoneNum: 4445556677 - store 3
?>

