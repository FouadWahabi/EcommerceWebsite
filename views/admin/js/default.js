var error = false;
$(function() {
    var sign_in = $("#sign-btn");
    
    // listen for input focusing
    $(document).on('focus', 'input', function () {
      $(this).siblings('label, i').addClass('active');
    });
    
    // listen for input bluring to enable validation
    $(document).on('blur', 'input', function () {
      if ($(this).val().length === 0) {
        $(this).siblings('label, i').removeClass('active');
        $(this).removeClass('valid');
        $(this).removeClass('invalid');
      }
    });

    // validate signing forms
    $('#email-sign, #password-sign').keyup(validate_sign);
    
    function validate_sign() {
        if($('#email-sign').val().length > 0 &&
          $('#password-sign').val().length > 0) {
            $("#submit-sign").prop("disabled", false);
        } else {
            $("#submit-sign").prop("disabled", true);
        }
    }
    
    // sign in
    sign_in.on('click', function(object) {
        if(!$('#submit-sign').is(':disabled')) {
            $("#sign-form").submit();
        }
    });

    
    
});