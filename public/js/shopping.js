$(document).ready(function() {
   $("form").on("submit", function() {
      //event.defaultPrevented();

      //alert($(this).prop('action'));
      if ($(this).prop('action') == "http://bernie/shopping") {

	      var objects = $(this).serializeArray();


		  if (objects.length == 4 && objects[3].value != "default") {

		  	var data = [objects[1].name, objects[2].value, objects[3].value];
		  	

		  	$.post(
		  		$(this).prop('action'),
		  		{
		  			customer : objects[1].name, 
		  			course : objects[2].value, 
		  			time : objects[3].value
		  		},
		  		function(data) {
		  			if (data == 'ok') {
		  				alert("OK");
		  			}
		  			if (data == 'fail1') {
		  				alert("not competent");
		  			}
		  			if (data == 'fail2') {
		  				alert("already in the wishlist");
		  			}
		  			if (data == 'fail3') {
		  				alert("course not available anymore");
		  			}
		  		}  	
		  	);

		  	//$(":checked", this).remove();
		  	
		  	return false;
		  } else {
		  	alert("Please choose one course and one time!");
		  	return false;
		  }
		}


     //console.log(data);
	});
});