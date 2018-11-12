//functionality to the logout button, ending session on logout etc...

$(document).on("click", "#logoutButton", function(event){
	console.log("logout funkar");

	let logoutAction = {
						"action" : "LOGOUT"
						};

	$.ajax({
		url : "./data/applicationLayer.php",
		type : "GET",
		data : logoutAction,
		ContentType : "application/json",
		dataType : "json",
		success : function(data){
			console.log(data);
			$(location).attr("href", "./index.html");
		},
		error : function(err){
			console.log(err);
		}

	});
});