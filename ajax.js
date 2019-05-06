function formPost(url, data, $inputs) {
  $inputs.prop("disabled", true);
  let request = $.ajax({
    url: url,
    type: "post",
    data: data,
  });
  request.done(function(response, textStatus, jqXHR) {
    $('.register_form').css("background-image", "linear-gradient(135deg,#66eade 0%,#764ba2 100%)");
    $('.register_form_title').text("Zarejestrowano!");
  });
  request.fail(function(jqXHR, textStatus, errorThrown) {
    console.error(
      "The following error occurred: " +
      textStatus, errorThrown
    );
  });
  request.always(function() {
    $inputs.prop("disabled", false);
  });
}