//logout if session expired, checks when clicking the idioma text in the upper left corner


$("#refreshButton").on("click", function(event){
	console.log("refreshbutton works");

	let sessionAction = {
				 "action" : "SESSION"
				};

	$.ajax({
		url : "./data/applicationLayer.php",
		type : "GET",
		data : sessionAction,
		dataType : "json",
		success : function(data){
			console.log(data);
		},
		error : function(err){
			console.log(err);
			//alert(err.responseText);
			$(location).attr('href', './index.html');
		}
	});
});