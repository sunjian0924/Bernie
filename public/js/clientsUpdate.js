$(document).ready(function() {
  //choose courses
  $("#moveright").click(function() {
    $.each($("#availableCourse").val(), function(index, object) {
      $("#chosenCourse").append('<option value="' + object + '">' + object + '</option>');
      $("#availableCourse option:selected").remove();

    });

  });
  //delete courses
  $("#moveleft").click(function() {
    $.each($("#chosenCourse").val(), function(index, object) {
      $("#availableCourse").append('<option value="' + object + '">' + object + '</option>');
      $("#chosenCourse option:selected").remove();
    });
  });
    //choose times, have to make sure there is no time conflict
    $("#addtime").click(function() {
      var options = [];
      $("#chosenTime option").each(function() {
        options.push($(this).val());
      });
      $.each($("#availableTime").val(), function(index, object) {

        if ($.inArray(object, options) == -1) {
            $("#chosenTime").append('<option value="' + object + '">' + object + '</option>');
        } else {
            alert("Time conflict!");
        }

    });});
    //delete times
    $("#deletetime").click(function() {
      
      $("#chosenTime option:selected").remove();

    });
    
    
    $("form").on("submit", function() {

      if ($(this).prop('action') == "http://bernie/clients") {
        var chosenCourses = new Array();
          $.each($("#chosenCourse")[0], function(index, object) {

              chosenCourses.push(object.value);
          });

          var chosenTimes = new Array();
          $.each($("#chosenTime")[0], function(index, object) {
              chosenTimes.push(object.value);
          });

          //ajax
        $.post(
          $(this).prop('action'), 
          {
            courses : chosenCourses,            
            times : chosenTimes
          },
          function(data) {
            if (data == "ok") {
              alert("Update successful!"); 
            }
            if (data == "fail") {
              alert("Information not complete! Please choose at least one course and ten available times."); 
            }
          }
        ); 
 
        return false;
      }
        
    });


});