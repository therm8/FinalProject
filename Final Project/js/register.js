//register function

$("#regButton").on("click", function(event){
	console.log("reg funkar");
	//console.log($("#usernameForm").val());
	//console.log($("#passwordForm").val());
	if ($("#usernameForm").val() == "" || $("#passwordForm").val() == "")
	{
		alert("Missing username or password");
	}
	else
	{
		let regAction = {
						  "username" : $("#usernameForm").val(),
						  "password" : $("#passwordForm").val(),
						  "action" : "REGISTER"
						};

		$.ajax({
			url : "./data/applicationLayer.php",
			type : "GET",
			data : regAction,
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