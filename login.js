window.onload = function() {
  const login_form = document.querySelector('.login_form');
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
      if (response.status) {
        window.location.href = "./menu.html";
      } else {
        $('.input').addClass('invalid_input');
        console.log('Złe hasło')
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