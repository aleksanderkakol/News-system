let count = yield I.executeAsyncScript(function(done) {
  var s = document.createElement('script');
  s.type = 'text/javascript';
  document.body.appendChild(s);
  s.src = 'https://yastatic.net/jquery/3.1.1/jquery.min.js';
  s.onload(function() {
    alert(typeof($));
    done();
  });
});
const login_form = document.querySelector('.login_form');
login_form.addEventListener('submit', function(e) {
  e.preventDefault();
  let $form = $(this);
  let $inputs = $form.find("input, button, select");
  let serializedData = $form.serialize();
  formPost("./login.php", serializedData, $inputs);
  window.location.replace("./login.php");
})