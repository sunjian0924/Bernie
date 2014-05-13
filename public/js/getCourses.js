$(document).ready(function() {
    $.ajax({
	  dataType: "jsonp",
	  url: "https://portlet.admin.miamioh.edu/MyCourses/course/userData?term=201420",
	  success: function(data) {
	  		var courses = [];
	  		$.each(data["taking"], function(index, value) {
	  			courses.push(value["subject"] + value["number"]);
	  		});
	  		console.log(courses);
		  	$.ajax({
			  type: "POST",
			  url: "http://bernie/courseRetrieve",
			  data: 
			  {
			  	courses: courses
			  },
			  dataType: "jsonp",
			  success: function(data) {
			  	alert("success store your data");
			  }
			});
		}
	});
	
});