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
echo '<script> var food_array = ' . json_encode($food_array) . '; </script>';
echo '<script> var storeNum = '. json_encode($_POST['STORE']) . '; </script>';
close($connection);
?>

<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
			$(document).ready(function () {
			// used to determine how many items will be displayed depending on window's width
			sizes = [
				{ breakPoint: { width: 0, item: 1 } },
				{ breakPoint: { width: 600, item: 2 } },
				{ breakPoint: { width: 1000, item: 4 } }
			]
			
			for(let i = 0; i < sizes.length; i++) {
				if (window.innerWidth >= sizes[i].breakPoint.width) {
					numbItemsDisplaped = sizes[i].breakPoint.item;
				}
			}

			var n = $(".gallery-container > .item").length;  // number of '.items'
			const CW = $(".gallery-container").width();  // container width
			const M = 15;  // margin

			/* Style  */
			$(".gallery-container > .item").css("width", (CW/numbItemsDisplaped)-M + "px" );
			$(".gallery-container > .item").css("margin", (M/2) +"px");
			$(".gallery-container").css("width", (CW/numbItemsDisplaped)*n + "px");

			/* controlers */
			var jump = 0;
			// parameter: element that was click
			$(".gallery-slider > .gallery-controls li").click(function(ele) {
				var target = $(ele.target);

				// applying a negative margin left allows for horizontal motion
				if (target.attr("id") == "<"){
					if(jump > 0 ) {
						jump = jump - (CW);
						$(".gallery-container").css("margin-left", -jump + "px");
					}
				}
				if (target.attr("id") == ">") {
					//(total width - width of item displayed item)
					if (jump < ((CW / numbItemsDisplaped) * n) - (CW / numbItemsDisplaped)*numbItemsDisplaped ) {
						jump = jump + (CW);
						$(".gallery-container").css("margin-left", -jump + "px");
					}
				}
				//console.log("jump: "+jump);
				//console.log((CW / numbItemsDisplaped) * n);
			});
		});
		</script>
		<style>
			.gallery-slider {
				/*border: 1px solid black;*/
				margin-top: 20px;
				height: 500px;
				width: 100%;
				float: left;
				overflow: hidden;
			}

			.gallery-slider .gallery-container {
				width: 100%;
				float: left;
				transition: margin 1s ease; /* for smooth animation */
			}

			.gallery-slider .item {
				height: 400px;
				border: 2px solid black;
				background-color: grey;
				line-height: 250px;
				text-align: center;
				font-size: 20px;
				line-height: 1.5;
				color: white;
				float: left;
				box-sizing: border-box;
			}

			.gallery-slidder .item .foodinfo {
				width: 100%;
			}

			.gallery-slider .gallery-controls {
				width: 100%;
				float: left;
				padding: 15px;
			}

			.gallery-slider .gallery-controls ul {
				display: block;
				text-align: center;
				padding:0;
				margin:0;
				list-style: none;
			}
			.gallery-slider .gallery-controls ul li {
				height: 35px;
				width: 35px;
				border:1px solid black;
				margin:4px;
				display: inline-block;
				line-height: 33px;
				cursor: pointer;
			}
		</style>
	</head>
<body>
	<div class="gallery-slider">
		<div class="gallery-container"> </div>
		<script>
		console.log(storeNum);
		/* Insert data from DB into html to be styled inta a gallery view  */
		for(let i=0; i < food_array.length; i++) {
			if( food_array[i][0] == storeNum ) {
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
</body>
</html>
