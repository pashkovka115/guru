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

$(function() {
    $(document).on("click", ".mobile_menu_container span", function(e) {
        e.preventDefault();
        $(this).siblings("ul").addClass("loaded");
    });
    $(document).on("click", ".mobile_menu_container .back", function(e) {
        e.preventDefault();
        $(this).parent().parent().removeClass("loaded");
    });
    $(document).on("click", ".mobile_menu", function(e) {
        e.preventDefault();
        $(".mobile_menu_container").addClass("loaded");
        $(".mobile_menu_overlay").fadeIn();
        $("body").addClass("no-overlay");
    });
    $(document).on("click", ".mobile_menu_overlay", function(e) {
        $(".mobile_menu_container").removeClass("loaded");
        $("body").removeClass("no-overlay");
        $(this).fadeOut();
    });
    $(document).on("click", ".mobile_menu_close", function(e) {
        e.preventDefault();
        $(".mobile_menu_container").removeClass("loaded");
        $(".mobile_menu_overlay").fadeOut();;
        $("body").removeClass("no-overlay");
    });
});