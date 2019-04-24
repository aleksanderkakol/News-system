function formPost(url, data, $inputs) {
  $inputs.prop("disabled", true);
  let request = $.ajax({
    url: url,
    type: "post",
    data: data
  });
  request.done(function(response, textStatus, jqXHR) {
    console.log("Registred!");
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