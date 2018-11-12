//login

//generating the loginform dynamically depending on whether the session is set or not

//on page refresh the loginform doesn't show if the session is already set
let loginFormAction = {
						"action" : "LOGINFORM"
					  };
$.ajax({
		url : "./data/applicationLayer.php",
		type : "GET",
		data : loginFormAction,
		dataType : "json",
		success : function(data){
			console.log(data);
			$("#loginForm").remove();
			let addHtml = "";

			addHtml = `<p id="currUser">Active user: <br> ${data.uName}</p>
						<div class="input-group-btn">
  							<button type="button" class="btn btn-danger" id="logoutButton">Logout</button>
						</div>`;
			$("#currentUser").append(addHtml);
		},
		error : function(err){
			console.log(err);
		}
	});


$("#loginButton").on("click", function(event){
	console.log("login knapp funkar");
	//console.log($("#usernameForm").val());
	//console.log($("#passwordForm").val());
	if ($("#usernameForm").val() == "" || $("#passwordForm").val() == "")
	{
		alert("Missing username or password");
	}
	else
	{
		let loginAction = {
							"username" : $("#usernameForm").val(),
							"password" : $("#passwordForm").val(),
							"action" : "LOGIN"
							};

		$.ajax({
			url : "./data/applicationLayer.php",
			type : "GET",
			data : loginAction,
			ContentType : "application/json",
			dataType : "json",
			success : function(data){
				console.log(data);
				$("#loginForm").remove();
				let addHtml = "";

				addHtml = `<p id="currUser">Active user: <br> ${data.uName}</p>
							<div class="input-group-btn">
      							<button type="button" class="btn btn-danger" id="logoutButton">Logout</button>
    						</div>`;
				$("#currentUser").append(addHtml);

			},
			error : function(err){
				console.log(err);
				alert(err.responseText);
			}
		});
	}
});