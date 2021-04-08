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

	// event function for when the value in store dropdown is changed
	$("#storeNumb").change(function() {
		$(".gallery-container").empty();
		for(let i=0; i < food_array.length; i++) {
			if( food_array[i][0] == $("#storeNumb").val()) {
				$("#addr").html(food_array[i][2]);
				$(".gallery-container" ).append(
				'<div class="item"> <div class="foodinfo" >'  +
					food_array[i][3] + '<br>' +
					food_array[i][4] + '<br>$' +
					food_array[i][5] +
				'</div></div>');
			}
		}
		// apply styling so that the width of each item stay consistant
		$(".gallery-container > .item").css("width", (CW/numbItemsDisplaped)-M + "px" );
		$(".gallery-container > .item").css("margin", (M/2) +"px");
	});

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
			// 							(total width - width of one item)
			if (jump < ((CW / numbItemsDisplaped) * n) - (CW / numbItemsDisplaped)*2 ) {
				jump = jump + (CW);
				$(".gallery-container").css("margin-left", -jump + "px");
			}
		}
		//console.log("jump: "+jump);
		//console.log((CW / numbItemsDisplaped) * n);
	});

});
