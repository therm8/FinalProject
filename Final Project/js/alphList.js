//loading the alphabetical list to the list section

let listAction = {
					"action" : "LIST"
				 };

$.ajax({
	url: './data/applicationLayer.php',
	type: 'GET',
	data: listAction,
	ContentType: 'application/json',
	dataType: 'json',
	success: function(data){
		console.log(data);
		let addHtml = "";

		$.each(data.expr, function(index, element)
		{
			addHtml = `<tr>
							<td>${element.expression}</td>
    						<td>${element.explanation}</td>
						</tr>`;
			$("#alphList").append(addHtml);
		});
	},
	error: function(err){
		console.log(err);
	}
});