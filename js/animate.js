
/***
 *   2017 01 08
 */

var index_animate = {
    nav: function () {
        $('.nav-lists').hover(function () {
            var nav_hover = $(this).children('.hover');
            // console.log(nav_hover.css('display'));
            if (nav_hover.css('display') == "none"){
                nav_hover.slideDown();
            }else {
                nav_hover.slideUp();
            }
        });
    }
}