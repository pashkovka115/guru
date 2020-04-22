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