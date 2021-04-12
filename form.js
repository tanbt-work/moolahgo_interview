$(document).ready(function () {
    $("form").submit(function (event) {
      $(".form-group").removeClass("has-error");
      $(".help-block").remove();   
      
      var formData = {
        referal: $("#referal").val(),
      };
  
      $.ajax({
        type: "POST",
        url: "api/referal",
        data: formData,
        dataType: "json",
        encode: true,
      }).done(function (data) {
        console.log(data);

        if (!data.success) {
            if (data.errors) {
              $("#name-group").addClass("has-error");
              $("#name-group").append(
                '<div class="help-block">' + data.errors + "</div>"
              );
            }
          } else {
            console.log(data);
            $("form").html(
              '<div class="alert alert-success">' + data.msg + "</div>"
            );
          }
      }).fail(function (data){

      });
  
      event.preventDefault();
    });
  });