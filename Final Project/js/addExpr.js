//adding expressions to the database

$(document).on("click", "#addExprButton", function(event){
	console.log("add expr button funkar");
	console.log($("#searchExpression").val());
	console.log($("#explanationField").val());

	let addExprAction = {
						  "expression" : $("#searchExpression").val(),
						  "explanation" : $("#explanationField").val(),
						  "action" : "ADD_EXPR"
						};

	$.ajax({
		url : "./data/applicationLayer.php",
		type : "GET",
		data : addExprAction,
		ContentType : "application/json",
		dataType : "json",
		success : function(data){
			console.log(data);
			let addHtml = "";

			addHtml = `<p>Your expression is waiting for supervision, Idioma thanks you for your contribution to the site</p>`;
			$(".noResults").append(addHtml);
		},
		error : function(err){
			console.log(err);
			alert("You need to be logged in to use this service");
		}
	});
});