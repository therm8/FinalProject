//adding new favourites from the search results
//also deleting favourites from the favourite list of the active user

$(document).on("click", ".addFavButton", function(event){
	console.log("add fav button works");
	//console.log($("#searchExpression").val());
	console.log($(this).parent().parent().parent().find(".searchExpr").text());

	let addFavAction = {
						//"expression" : $("#searchExpression").val(),
						"expression" : $(this).parent().parent().parent().find(".searchExpr").text(),
						"action" : "ADD_FAV"
						};

	$.ajax({
		url : "./data/applicationLayer.php",
		type : "GET",
		data : addFavAction,
		ContentType : "application/json",
		dataType : "json",
		context : this,
		success : function(data){
			console.log(data);
			$(this).parent().parent().parent().html(`<td colspan="3">Added to favourites successfully  <span class="glyphicon glyphicon-ok"></span></td>`);

			/*$("#searchResults").html(`<div id="addedFav">
										<p>Added to favourites succesfully!</p>
									</div>`);*/
		},
		error : function(err){
			console.log(err);
			alert("Login to use the favourite service");
		}
	});
});


$(document).on("click", ".deleteFavButton", function(event){
	console.log("delete fav button works");
	console.log($(this).parent().parent().parent().find(".favExpr").text());

	let deleteFavAction = {
							"expression" : $(this).parent().parent().parent().find(".favExpr").text(),
							"action" : "DELETE_FAV"
						   };

	$.ajax({
		url : "./data/applicationLayer.php",
		type : "GET",
		data : deleteFavAction,
		ContentType : "application/json",
		dataType : "json",
		context : this,
		success : function(data){
			console.log(data);
			$(this).parent().parent().parent().html(`<td colspan="2">Deleted from favourites successfully  <span class="glyphicon glyphicon-remove"></span></td>`);

			/*$("#searchResults").html(`<div id="addedFav">
										<p>Added to favourites succesfully!</p>
									</div>`);*/
		},
		error : function(err){
			console.log(err);
		}
	});
});









