$(document).ready(function() {
  $("#moveright").click(function() {
    $.each($("#availableCourse").val(), function(index, object) {
      $("#chosenCourse").append('<option value="' + object + '">' + object + '</option>');
      $(":selected").remove();

    });

  });

  $("#moveleft").click(function() {
    $.each($("#chosenCourse").val(), function(index, object) {
      $("#availableCourse").append('<option value="' + object + '">' + object + '</option>');
      $(":selected").remove();

    });

  });

});