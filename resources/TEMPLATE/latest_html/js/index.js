'use strict';

$(document).scroll(function() {
    let scroll_btn = $('.form_search').offset().top;
    if ($(this).scrollTop() > scroll_btn) {
        $(".form_search").hide();
        $("header").addClass('fixed');
        
    }else{
        $(".form_search").show();
        $("header").removeClass('fixed');
    }   
});

$('.search-input').click( function(){
    $('.search-category').toggle();
});
$(document).on('click', function(e) {
    if (!$(e.target).closest(".search-input").length) {
        $('.search-category').hide();
    }
    e.stopPropagation();
});