$(document).ready(function() {
   $("form").on("submit", function() {
      //event.defaultPrevented();

      if ($(this).prop('action') == "http://bernie/tutors") {
	     
	     //var val = $("input[type=submit][clicked=true]").val();

	     var val = $(this).find("input[type='submit']:focus");
	     var submitType = val[0].value;
	     //alert(submitClass);
	     //return false;
	     var objects = $(this).serializeArray();
	     var data = [objects[1].name, objects[2].name, objects[3].name];
		 
	     if (submitType == "Delete" || submitType == "Cancel") {
  	
		  	$.post(
		  		$(this).prop('action'), 
		  		{
		  			action: submitType,
		  			name : objects[1].name, 
		  			course : objects[2].name, 
		  			time : objects[3].name
		  		}
		  	);
		  	alert("Success!\n" + "You have deleted: " + data);
		  	$(this).remove();

		  	return false;
		  } else {
		  	//confirm
		  	//return true;
		  	$.post(
		  		$(this).prop('action'), 
		  		{
		  			action: "confirm",
		  			name : objects[1].name, 
		  			course : objects[2].name, 
		  			time : objects[3].name
		  		},
		  		function(data) {
		  			if (data == 'ok') {
		  				alert("It has been confirmed!");
		  			}
		  			if (data == 'fail1') {
		  				alert("time conflict");
		  			}
		  			if (data == 'fail2') {
		  				alert("not available");
		  			}
		  			if (data == 'fail3') {
		  				alert("course not available anymore");
		  			}
		  		}
		  	);
		  	$(this).remove();
		  	return false;
		  }
		  
		}

     //console.log(data);
	});
});