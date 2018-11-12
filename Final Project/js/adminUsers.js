//displaying the users to the admin

let handleUserAction = {
						"action" : "HANDLE_USERS"
						};

$.ajax({
	url : "./data/applicationLayer.php",
	type : "GET",
	data : handleUserAction,
	ContentType : "application/json",
	dataType : "json",
	success : function(data){
		console.log(data);
		let addHtml = "";

		$.each(data.users, function(index, element)
		{
			addHtml = `<tr>
							<td class="admUsername">${element.uname}</td>
    	
							<td>
								<div class="input-group-btn">
		  							<button type="button" class="btn btn-danger deleteButton">Delete</button>
								</div>
							</td>
						</tr>`;
			$("#admUserList").append(addHtml);
		});
	},
	error : function(err){
		console.log(err);
	}
});

//giving functionality to the delete user button

$(document).on("click", ".deleteButton", function(event){
	console.log("delete button funkear");
	console.log($(this).parent().parent().parent().find(".admUsername").text());

	let admUserAction = {
						  "action" : "DELETE_USER",
						  "username": $(this).parent().parent().parent().find(".admUsername").text()
						};

	$.ajax({
		url: './data/applicationLayer.php',
		type: 'GET',
		data : admUserAction,
		ContentType: 'application/json',
		dataType: 'json',
		context: this,
		success: function(data){
			console.log(data);
			$(this).parent().parent().parent().html(`<td colspan="2">Deleted user ${$(this).parent().parent().parent().find(".admUsername").text()}</td>`);

		},
		error: function(err){
			console.log(err);
		}
	});

});