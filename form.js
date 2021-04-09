$(document).ready(function () {
    $("form").submit(function (event) {
      $(".form-group").removeClass("has-error");
      $(".help-block").remove();   
      
      var formData = {
        referalCode: $("#referalCode").val(),
      };
  
      $.ajax({
        type: "POST",
        url: "process.php",
        data: formData,
        dataType: "json",
        encode: true,
      }).done(function (data) {
        console.log(data);

        if (!data.success) {
            if (data.errors.referalCode) {
              $("#name-group").addClass("has-error");
              $("#name-group").append(
                '<div class="help-block">' + data.errors.referalCode + "</div>"
              );
            }

          } else {
            $("form").html(
              '<div class="alert alert-success">' + data.message + "</div>"
            );
          }
      }).fail(function (data){

      });
  
      event.preventDefault();
    });
  });