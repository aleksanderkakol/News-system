const register_form = document.querySelector('.register_form');
register_form.addEventListener('submit', function(e) {
  e.preventDefault();
  let $form = $(this);
  let $inputs = $form.find("input, button, select");
  let serializedData = $form.serialize();
  console.log(serializedData)
  $inputs.prop("disabled", true);
  let request = $.ajax({
    url: "./register.php",
    type: "post",
    data: serializedData
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
})