const register_form = document.querySelector('.register_form');

$(document).ready(function() {
  $('.register_form').validate({
    errorPlacement: function(label, element) {
      label.addClass('arrow');
      label.insertAfter(element);
      return false;
    },
    wrapper: 'span',
    rules: {
      first_name: {
        required: true,
        minlength: 3
      },
      last_name: {
        required: true,
        minlength: 3
      },
      email: {
        required: true,
        email: true
      },
      gender: {
        required: true
      },
      password: {
        required: true,
        minlength: 3
      },
      password_check: {
        minlength: 3,
        equalTo: '#pass'
      },
      register_btn: {
        required: true
      }
    },
    messages: {
      first_name: {
        minlength: "Name should be at least 3 characters!"
      },
      last_name: {
        minlength: "Last Name should be at least 3 characters!"
      },
      email: {
        email: "The email should be in format: example@gmail.com!"
      },
      passwrod: {
        minlength: "Password should be at least 3 characters!"
      },
      password_check: {
        equalTo: "Passwords are not the same!"
      }
    }
  });

  register_form.addEventListener('submit', function(e) {
    let $form = $(this);
    let $inputs = $form.find("input, button, select");
    e.preventDefault();
    if ($(this).validate().successList.length == $inputs.length - 1) {
      let serializedData = $form.serialize();
      $inputs.prop("disabled", true);
      let request = $.ajax({
        url: "./register.php",
        type: "post",
        data: serializedData,
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
      return false;
    } else {
      return false;
    }
  });
})