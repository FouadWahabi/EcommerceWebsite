var url = '/ecommerce-project/';

$(function () {
    var filter = $('.filter');
    var container = $('.container');
    var ghostFilter = $('#filter-ghost');
    var searchBox = $('.search-box');
    var loginForm = $('.login-form');
    var userAccount = $('.user-account');
    var url = '/ecommerce-project/';
    
    // associating z-index to ghost filter
     $(document).ready(function() {
        ghostFilter.css('z-index', '-99');   
    });
    ghostFilter.on('transitionend', function() { ghostFilter.css('z-index', '99'); if(ghostFilter.hasClass('close')) { ghostFilter.css('z-index', '-99'); }});
    
    // open navigation drawer
    function openFilter() {
        $(filter).removeClass('close').addClass('open');
        $(container).removeClass('close').addClass('open');
        $(ghostFilter).removeClass('close').addClass('open');
    }

    // close navigationdrawer
    function closeFilter() {
        $(filter).removeClass('open').addClass('close');
        $(container).removeClass('open').addClass('close');
        $(ghostFilter).removeClass('open').addClass('close');
    }

    // listen for navigation button clik
    $('#navToggle').on('click', function(event) {
        event.stopPropagation();
        event.preventDefault();
        if (container.hasClass('open')) {
            closeFilter();
        } else {
            openFilter();
        }
    });
    
    // listen for clicking outside the filter
    ghostFilter.click(function() {
        if (container.hasClass('open')) {
            closeFilter();
        }
    });
    
    // making search box default state
    if(matchMedia) {
        var hideSearchBox = window.matchMedia("(max-width: 820px)");
        hideSearchBox.addListener(function(hideSearchBox) {
            if(hideSearchBox.matches) {
                if(!searchBox.hasClass('close'))
                    searchBox.addClass('close');
            } else {
                if(searchBox.hasClass('close'))
                    searchBox.removeClass('close');
            }
        });
    }
    
    // listen to search box clicking and toggle search input showing
    $('.fa-search').on('click', function(event) {
        
        if(searchBox.hasClass('close'))
           searchBox.removeClass('close');
    });
    
    // listen to search typing
    $('#search-key').keyup(function() {
        var key =  $('#search-key').val();
        if(key.length > 0) {
            if(!$('.search').hasClass('active'))
                $('.search').addClass('active');
            $.get(url + 'search/search/' + key, function(o) {
                $('.search').text(function() { return ''; });
                for(var i = 0 ; i < o.length ; i++) {
                    $('.search').append(getArt(o[i].product_id, o[i].product_short_desc, o[i].product_thumb));
                }
            }, 'json');
        } else {
            if($('.search').hasClass('active'))
                $('.search').removeClass('active');
        }
    });
    
    // fix filter at position
    $(document).scroll(function() { 
        if($(this).scrollTop() > 50 ) {
            ghostFilter.css('top','0');
            filter.css('top', '0');
            filter.css('position', 'fixed');
            ghostFilter.css('position', 'fixed');
        } else {
            ghostFilter.css('top','50 !important');
            filter.attr('style','top: 50 !important');
            filter.css('position', 'absolute');
            ghostFilter.css('position', 'absolute');
        }
    });
    
    // login form apearance
    userAccount.on('click', function(event) { event.stopPropagation();});
    $('#user_account').on('click', function (event) {
        var user = false;
        user = getData(url + 'register/getSession');
        if(!user) {
            if(!loginForm.hasClass('active')) {
                loginForm.addClass('active');
                userAccount.addClass('active');
            } else {
                loginForm.removeClass('active');
                userAccount.removeClass('active');
            }
        } else {
            getData(url + 'register/signOut/' + user);
            window.location.href = url + "product"; 
        }
    });
    
    // panier click
    $('#panier').on('click', function(event) {
        window.location.href = url + "checkout"; 
    });
    
    
    $('html').on('click',function(event) { 
        if(loginForm.hasClass('active')) {
            loginForm.removeClass('active');
            userAccount.removeClass('active');
        }
        if($(".search").hasClass('active')) {
            $(".search").removeClass('active');
        }
    } );
    
    // login with login form
    // validate signing forms
    $('#email-sign-form, #password-sign-form').keyup(validate_sign);
    
    function validate_sign() {
        if($('#email-sign-form').val().length > 0 &&
          $('#password-sign-form').val().length > 0 && isValidEmailAddress($('#email-sign-form').val())) {
            $("#submit-sign-form").prop("disabled", false);
        } else {
            $("#submit-sign-form").prop("disabled", true);
        }
    }
    
    // sign in
    $('#login-sign-form').on('click', function(object) {
        if(!$("#submit-sign-form").is(':disabled')) {
            $("#login-form").submit();
        }
    });
    
        // validate email
    function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
};
    
    
    // get  ajax data synchronisly
    function getData(url) {
        var data;
            $.ajax({
                async: false, //thats the trick
                url: url,
                dataType: 'text',
                success: function(response){
                   data = response;
                }
            });
            return data;
    }
});


function getArt(art_id, art_title, art_thumb) {
    return '<div class="clearfix"><hr style="border-top: 1px dotted #c8cbcc;margin-bottom:20px"><div id="panier_art"><div id="product_img" style="float: left !important;"><img src="' + url + art_thumb +'" width="90px"></div><div id="product_desc" class="product" style="float: left !important;width: 35%;color:azure;font-size:10px"><h2><a style="color:azure" href="' + url + 'product/prod/' + art_id + '">' + art_title + '</a></h2></div>';
}