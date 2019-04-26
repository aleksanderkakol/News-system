window.onload = function() {
  const login_form = document.querySelector('.login_form');
  login_form.addEventListener('submit', function(e) {
    e.preventDefault();
    let $form = $(this);
    let $inputs = $form.find("input, button, select");
    let serializedData = $form.serialize();
    formPost("./login.php", serializedData, $inputs);
    window.location.href = "./menu.html";
  })
}