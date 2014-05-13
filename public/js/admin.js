$(document).ready(function() {
    $("form").on("submit", function() {


    	if ($(this).prop('action') == "http://bernie/admin") {

	      	var val = $(this).find("input[type='submit']:focus");
		    var submitType = val[0].value;
		    var objects = $(this).serializeArray();
		    if (submitType == "Update") {
		    	var val = [];
			    $(":checked").each(function(i) {
			    	val[i] = $(this).val();
			    	
			    });
			    //console.log(val);
			    $.post(
			  		$(this).prop('action'),
			  		{
			  			action: submitType,
			  			Delete : val
			  		},
			  		function(data) {
			  			if (data == 'ok') {
			  				//delete data
			  				$(":checked").parent().parent().remove();
			  				alert("Success!");
			  			}
			  		}  	
			  	);
			} else {
				//Add
				$.post(
		  			$(this).prop('action'), 
			  		{
			  			action : submitType,
			  			MUid : objects[1].value, 
			  			expertise : objects[2].value
			  		},
			  		function(data) {
			  			if (data == 'ok') {
			  				//append data
			  				$("#updateTable").append('<tr><td>' + objects[1].value + '</td><td>' 
			  								+ objects[2].value + '</td><td><input type="checkbox" name="checkbox[]"</td></tr>'); 
			  				alert("Success!");
			  			}
			  		} 
		  		);
			}

			return false;
		}
	});
});