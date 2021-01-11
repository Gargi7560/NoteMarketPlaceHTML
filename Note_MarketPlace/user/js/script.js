/* =====================================
        Show/Hide Password
======================================== */

$(".toggle-password").click(function () {
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});


/* =====================================
            Navigation
======================================== */

function sticky_header() {
    var header_height = jQuery('.site-header').innerHeight() / 2;
    var scrollTop = jQuery(window).scrollTop();;
    if (scrollTop > header_height) {
        jQuery('body').addClass('sticky-header');

        //Show White logo
        $(".site-header .header-wrapper .logo-wrapper a img").attr("src", "images/logo_pur/top-logo.png")

    } else {
        jQuery('body').removeClass('sticky-header');

        //Show logo
        $(".site-header .header-wrapper .logo-wrapper a img").attr("src", "images/login/top-logo.png")
    }
}
jQuery(document).ready(function () {
    var bodyId = $('body').attr('id');

    if (bodyId == "bodyForStickyHeader")
        sticky_header();


});
jQuery(window).scroll(function () {
    var bodyId = $('body').attr('id');

    if (bodyId == "bodyForStickyHeader")
        sticky_header();
});
jQuery(window).resize(function () {
    var bodyId = $('body').attr('id');

    if (bodyId == "bodyForStickyHeader")
        sticky_header();
});

/* =====================================
                Mobile Menu
======================================== */
$(function () {
    //Show mobile nav
    $("#mobile-nav-open-btn").click(function () {
        $("#mobile-nav").css("height", "100%");
    });

    //Hide mobile nav
    $("#mobile-nav-close-btn").click(function () {
        $("#mobile-nav").css("height", "0%");
    });
});

/* =====================================
            Popup
======================================== */

$('#myModal').on('shown.bs.modal', function () {
    $('#myModal').trigger('focus')
});

/* =====================================
            Dropdown
======================================== */
$('.dropdown-toggle').dropdown();

$('#myDropdown').click(function () {
    $("sub_dropdown_header").show();
});

/* =====================================
            star
======================================== */
$(document).ready(function () {
    for (i = 1; i < 9; i++) {
        for (j = 5; j >= 1; j--) {
            $('.rate' + i + ' .rate').append('<input type="radio" id="s_' + i + '_' + j + '" name="rate' + i + '" value="5" /><label for="s_' + i + '_' + j + '" title="text">5 stars</label>');
        }
    }
});