$(function () {
    var filter = $('.filter');
    var container = $('.container');
    var ghostFilter = $('#filter-ghost');
    var searchBox = $('.search-box');
    var loginForm = $('.login-form');
    var userAccount = $('.user-account');
    
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
        if(!searchBox.hasClass('close'))
            searchBox.addClass('close');
        else
            searchBox.removeClass('close');
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
    // price range
    $( "#slider-range" ).slider({
          range: true,
          min: 0,
          max: 500,
          values: [ 0, 500 ],
          slide: function( event, ui ) {
            $( "#amount" ).val( "DT" + ui.values[ 0 ] + " - DT" + ui.values[ 1 ] );
          }
        });
        $( "#amount" ).val( "DT" + $( "#slider-range" ).slider( "values", 0 ) +
          " - DT" + $( "#slider-range" ).slider( "values", 1 ) );
    
    // login form apearance
    userAccount.on('click', function(event) { event.stopPropagation(); });
    $('.fa-user').on('click', function (event) {
        if(!loginForm.hasClass('active')) {
            loginForm.addClass('active');
            userAccount.addClass('active');
        } else {
            loginForm.removeClass('active');
            userAccount.removeClass('active');
        }
    });
    $('html').on('click',function(event) { 
        if(loginForm.hasClass('active')) {
            loginForm.removeClass('active');
            userAccount.removeClass('active');
        }
    } );
    
});