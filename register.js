const register_form = document.querySelector('.register_form');
register_form.addEventListener('submit', function (e) {
  e.preventDefault();
  let $form = $(this);
  let $inputs = $form.find("input, button, select");
  let serializedData = $form.serialize();
  formPost("register.php", serializedData, $inputs);
})