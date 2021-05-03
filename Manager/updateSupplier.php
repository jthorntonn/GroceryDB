

<?php

session_start();
        if($_SESSION['loggedIn']==true){
                //allow processing
        }
        else{

        echo "<script> window.location.assign('../login/login.php'); </script>";
        }


if(isset($_POST['submit']))     {       // if Add button is pressed
        include 'functions.php';
        $connection = connect();
        if (!$connection) {
                die("Connection failed: " . $connection->connect_error);
        }

        $sName = mysqli_real_escape_string($connection, $_POST['sName']);
        $sPhone = mysqli_real_escape_string($connection, $_POST['sPhone']);
        $shipDay = mysqli_real_escape_string($connection, $_POST['shippingDays']);

        $query="UPDATE Supplier SET shippingDays='$shipDay'
                WHERE sName='$sName' && sPhoneNum='$sPhone'";

        if( mysqli_query($connection, $query) ) {
                header('Location: manager.php');
                mysqli_close($connection);
        }
        else {
                echo 'query error: ' . mysqli_error($connection);
        }
}
?>

<html>
        <head>
                <link rel="stylesheet" type="text/css" href="style.css">
        </head>
<body>
	<button style="color: white;background: black; margin-bottom:10px" onclick="location.href = 'manager.php';" type="button" id="loginbutton">Go Back</button>

	<p>Supplier Information</p>
        <?php
        include 'functions.php';
        $connection = connect();
        if (!$connection) {
                die("Connection failed: " . $connection->connect_error);
        }
        $query= "SELECT * FROM Supplier";
        $t = mysqli_query($connection, $query);

        echo '<table border="1" class="center">
                <thead><tr>
                        <th>Supplier Name</th>
                        <th>Supplier Phone</th>
                        <th>Shipping Days</th>
                </tr></thead>';
        while($row=mysqli_fetch_array($t)) {
                echo '<tr> <td>'. $row['sName'] .'</td>';
                echo '<td>'. $row['sPhoneNum'] .'</td>';
                echo '<td>'. $row['shippingDays'] .'</td></tr>';
        }

        echo '</table>';
        ?>
  <form action="?" method="post">
                <input type="text" name="sName" placeholder="Supplier Name">
                <input type="text" name="sPhone" placeholder="Supplier Phone">
                <input type="text" name="shippingDays" placeholder="Shipping Days">
                <input type="submit" name="submit" value="Update">
        </form>
</body>

<html>
