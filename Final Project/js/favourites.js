//displaying the current users favourite expressions

$("#favButton").on("click", function(event){
	console.log("fav button funkar");

	let favAction = {
					  "action" : "FAVOURITES"
					};

	$.ajax({
		url: './data/applicationLayer.php',
		type: 'GET',
		data: favAction,
		ContentType: 'application/json',
		dataType: 'json',
		success: function(data){
			console.log(data);
			$("#favs").remove();
			$("#favList").html(`<table class="table" id="favouritesList">
        							<tr>
          								<th id="thead" colspan="2">Favourite Expressions</th>
        							</tr>
      							</table>`);

			let addHtml = "";

			$.each(data.expr, function(index, element)
			{
				addHtml = `<tr>
							<td class="favExpr">${element.expression}</td>
							<td>
								<div class="input-group-btn">
		  							<button type="button" class="btn btn-danger deleteFavButton">Delete</button>
								</div>
							</td>
						   </tr>`;
				$("#favouritesList").append(addHtml);
			});
		},
		error: function(err){
			console.log(err);
			if(err.responseText == "Your session has expired.")
			{
				$("#favList").html(`<div>
										<h4>Login to use this service</h4>
									</div>`);
			}
			else
			{
				$("#favList").html(`<div>
										<h4>Your list of favourites is empty</h4>
									</div>`);
			}
		}
	});
});