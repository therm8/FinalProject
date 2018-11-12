//display search results to the user by fetching it from the database


$("#searchButton").on("click", function(event){
	console.log("sökknapp funkar");
	console.log($("#searchExpression").val());
	
	let searchAction = {
						"search" : $("#searchExpression").val(),
						"action" : "SEARCH"
						};

	$.ajax({
		url : "./data/applicationLayer.php",
		type : "GET",
		data : searchAction,
		ContentType : "application/json",
		dataType : "json",
		success : function(data){
			console.log(data);
			$("#searchResults").html(`<table class="table" id="searchList">
        							<tr>
          								<th>Expression</th>
          								<th colspan="2">Explanation</th>
        							</tr>
      							</table>`);

			let addHtml = "";

			$.each(data.expr, function(index, element)
			{
				addHtml = `<tr>
							<td class="searchExpr">${element.expression}</td>
							<td>${element.explanation}</td>
							<td><div class="input-group-btn">
		  							<button type="button" class="btn btn-default addFavButton">Add to favourites  <span class="glyphicon glyphicon-plus"></span></button>
								</div></td>
						   </tr>`;
				$("#searchList").append(addHtml);
			});
		},
		error : function(err){
			console.log(err);
			let newHtml = "";

			newHtml = `<div class="noResults">
							<p>This expression does not exist in our database, do you want to add it with an explanation? <br> (Only for logged in users)</p>
							<input type="text" class="form-control" id="explanationField" size="25" placeholder="Explanation">
							<div class="input-group-btn">
	        					<button type="button" class="btn btn-default" id="addExprButton">Add to database</button>
	      					</div>
						</div>`;
			$("#searchResults").html(newHtml);
		}
	});
});

