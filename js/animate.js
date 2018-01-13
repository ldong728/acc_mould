
/***
 *   2017 01 08
 */

var index_animate = {
    nav: function () {
        $('.nav-lists').hover(function () {
            console.log($(this).children('.hover'));
            $(this).children('.hover').slideToggle();
        })
    }
}