window.onload = function() {
  const login_form = document.querySelector('.login_form');
  $('.input').change(function() {
    if ($(this).val().length > 0) {
      $(this).next('label').addClass('not_empty');
    } else {
      $(this).next('label').removeClass('not_empty');
    }
  })
  let url = './login.php';
  login_form.addEventListener('submit', function(e) {
    e.preventDefault();
    let $form = $(this);
    let $inputs = $form.find("input, button, select");
    let serializedData = $form.serialize();

    $inputs.prop("disabled", true);
    let request = $.ajax({
      url: url,
      type: "post",
      dataType: 'json',
      data: serializedData,
    });
    request.done(function(response, textStatus, jqXHR) {
      if (response.status === "true") {
        $inputs.removeClass('invalid_input');
        window.location.href = "./menu.html";
      } else {
        $('label').addClass('invalid_input');
        $('label:first').text('Błędny login lub hasło!')
      }
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
  });
}