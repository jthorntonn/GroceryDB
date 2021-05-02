<!DOCTYPE html>
<html lang="en">
<title>Store.com</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-green w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="homepage.php" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <form action="" method="POST"><input class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" type="submit" value="Store 1"></form>
    <form action="" method="POST"><input class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" type="submit" value="Store 2"></form>
    <form action="" method="POST"><input class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" type="submit" value="Store 3"></form>
	
  </div>

  <!-- Navigation Bar 2 -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Store 1</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Store 2</a>
	<a href="#" class="w3-bar-item w3-button w3-padding-large">Store 3</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-green w3-center" style="padding:128px 16px">
  <h1 class="w3-margin w3-jumbo">Store.com</h1>
</header>

<!-- First Section -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>Store Information</h1>
      <h5 class="w3-padding-32">Store Information</h5>

      <p class="w3-text-grey">Store Information</p>
    </div>

    <div class="w3-third w3-center">
    </div>
  </div>
</div>

<!-- Second Section -->
<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
    </div>

    <div class="w3-twothird">
      <h1>Store.com</h1>
      <h5 class="w3-padding-32">Store Information</h5>

      <p class="w3-text-grey">Store Information</p>
    </div>
  </div>
</div>

<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Fresh Food</h1>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
		<p class="w3-text-black">Footer</p>
 </div>
</footer>

<script>

function myFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>
