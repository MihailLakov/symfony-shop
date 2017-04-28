/**
 * Cusotom js functions for the shop
 * author mlakov
 */


$('document').ready(function(){
    
    setTimeout(function(){
        $('div.alert').fadeOut('fast');
    }, 5000);
    
    $(window).scroll(function () {
        if ($(this).scrollTop() > 280) {            
            $('#totop').css("opacity", "0.9");
            $('header').addClass('sticky');
        }
        else {            
            $('#totop').css("opacity", "0");
            $('header').removeClass('sticky');
        }
    });
});