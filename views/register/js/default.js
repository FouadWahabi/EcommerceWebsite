var error = false;
$(function() {
    var registre = $("#register-btn");
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
    
    $("#email-reg").keyup(function() {
     if(!($(this).val().length === 0)) {
          if($(this).attr('id') === 'email-reg') {
              validate_field($(this));
          }
      }
    });
    
    // validate function
    validate_field = function(object) {
        if(isValidEmailAddress(object.val()))
        $.get('register/isUserExists' + '/' + object.val() ,function(o) {verif(object, o);
}, 'json');
    }
    // verfi input contents
    verif = function (object, exists) {
            if (object.val().length === 0) {
                if (object.hasClass('validate')) {
                  object.removeClass('valid');
                  object.removeClass('invalid');
                }
              } else {
                if (object.hasClass('validate')) {
                  if (!(exists)) {
                    error = false;
                    object.removeClass('invalid');
                    object.addClass('valid');
                    validate();
                  }
                else {
                    error = true;
                    object.removeClass('valid');
                    object.addClass('invalid');
                    validate();
                  }
                }
              }
        }
    
    // validate registration forms
    $('#first_name, #last_name, #email-reg, #password-reg, #phone, #city, #state, #zip, #adress').keyup(validate_reg);
    
    function validate_reg(){
        if ($('#first_name').val().length > 0 &&
            $('#last_name').val().length > 0 &&
            $('#email-reg').val().length > 0 &&
            $('#password-reg').val().length > 0 &&
            $('#phone').val().length > 0 &&
            $('#city').val().length > 0 &&
            $('#state').val().length > 0 &&
            $('#zip').val().length > 0 &&
            $('#adress').val().length > 0 && !error) {
            $("#submit-reg").prop("disabled", false);
        }
        else {
            $("#submit-reg").prop("disabled", true);
        }
    }
    
    // registre
    registre.on('click', 
                function(object) {
        if(!$('#submit-reg').is(':disabled')) {
            $("#reg-form").submit();
        }
    });  
    
    
    // validate signing forms
    $('#email-sign, #password-sign').keyup(validate_sign);
    
    function validate_sign() {
        if($('#email-sign').val().length > 0 &&
          $('#password-sign').val().length > 0 ) {
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
    
    // validate email
    function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};
    
    
});