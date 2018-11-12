//displaying list of new expressions to the admin

let handleExprAction = {
						"action" : "HANDLE_EXPR"
						};

$.ajax({
	url : "./data/applicationLayer.php",
	type : "GET",
	data : handleExprAction,
	ContentType : "application/json",
	dataType : "json",
	success : function(data){
		console.log(data);
		let addHtml = "";

		$.each(data.expr, function(index, element)
		{
			addHtml = `<tr>
							<td class="admExpression">${element.expression}</td>
    						<td>${element.explanation}</td>
    						<td>
								<div class="input-group-btn">
		  							<button type="button" class="btn btn-primary approveButton">Approve</button>
								</div>
							</td>
							<td>
								<div class="input-group-btn">
		  							<button type="button" class="btn btn-danger declineButton">Decline</button>
								</div>
							</td>
						</tr>`;
			$("#admExprList").append(addHtml);
		});
	},
	error : function(err){
		console.log(err);
	}
});

//giving funtionality to the admin buttons for expressions

$(document).on("click", ".approveButton", function(event){
	console.log("approve funkar");
	console.log($(this).parent().parent().parent().find(".admExpression").text());
	
	let approveAction = {
						 "action" : "APPROVE",
						 "expression" : $(this).parent().parent().parent().find(".admExpression").text()
						};

	$.ajax({
		url: './data/applicationLayer.php',
		type: 'GET',
		data : approveAction,
		ContentType: 'application/json',
		dataType: 'json',
		context: this,
		success: function(data){
			console.log(data);
			$(this).parent().parent().parent().html(`<td colspan="4">Expression "${$(this).parent().parent().parent().find(".admExpression").text()}" approved</td>`);
		},
		error: function(err){
			console.log(err);
		}
	});

});


$(document).on("click", ".declineButton", function(event){
	console.log("decline funkar");
	console.log($(this).parent().parent().parent().find(".admExpression").text());

	let declineAction = {
						 "action" : "DECLINE",
						 "expression" : $(this).parent().parent().parent().find(".admExpression").text()
						};

	$.ajax({
		url: './data/applicationLayer.php',
		type: 'GET',
		data : declineAction,
		ContentType: 'application/json',
		dataType: 'json',
		context: this,
		success: function(data){
			console.log(data);
			$(this).parent().parent().parent().html(`<td colspan="4">Expression "${$(this).parent().parent().parent().find(".admExpression").text()}" declined</td>`);
		},
		error: function(err){
			console.log(err);
		}
	});

});