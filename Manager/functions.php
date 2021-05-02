<?php

function connect() {
	$host = 'localhost';
	$user = 'fdondjeutschoufack1';
	$pwd = 'fdondjeutschoufack1';
	$dbname = 'GroceryDB';
	$conn=@mysqli_connect($host,$user,$pwd,$dbname);
	return $conn;
}

function close($conn) {
	mysqli_close($conn);
}

?>
