jQuery(document).ready(function($) {

    const navbarOpacity = function() {
        if ($(window).scrollTop() > 50) {
            $('.site-header').addClass('flat');
        } else {
            $('.site-header').removeClass('flat');
        }
    }

    navbarOpacity();
    $(window).scroll(navbarOpacity);

    $('.site-menu-toggler').click(function() {
        $('.site-header').toggleClass('active');
    });
 
});