$(document).ready(function() {
   $("form").on("submit", function() {
      //event.defaultPrevented();
      
      if ($(this).prop('action') == "http://bernie/records") {
	     
	      var objects = $(this).serializeArray();

		  	var val = $(this).find("input[type='submit']:focus");
	     	var submitType = val[0].value;



		  	var data = [objects[1].name, objects[2].name, objects[3].name];


		  	alert("Success!");
		  	$.post(
		  		$(this).prop('action'), 
		  		{
		  			action : submitType,
		  			name : objects[1].name, 
		  			course : objects[2].name, 
		  			time : objects[3].name
		  		}
		  	);
		  	if (submitType != 'Cancel Next Week') {
		  		$(this).remove();
		  	}
		  	return false;
		  
		}

     //console.log(data);
	});
});