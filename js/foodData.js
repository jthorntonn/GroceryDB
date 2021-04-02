
// insert food into gallery
for(let i = 0; i < food_array.length; i++) {
	if( food_array[i][0] == "Store1") {
		$("#addr").html(food_array[i][2]);
		$("#storeNumb").html(food_array[i][0]);
		$(".gallery-container" ).append(
			'<div class="item"> <div class="foodinfo" >'  + 
					food_array[i][3] + '<br>' +
					food_array[i][4] + '<br>$ ' +
					food_array[i][5] +
			'</div></div>');
	}
}
//console.log($(".item").css("height"));

// css file isnt working for some reason
//$(".item").css("height", "400px");
//$(".gallery-slider").css("height", "500px");

console.log( food_array.length );
