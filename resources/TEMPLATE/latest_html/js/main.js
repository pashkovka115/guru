'use strict';

$("body").on('click', '.scroll-to', function(e){
  var fixed_offset = 100;
  $('html,body').stop().animate({ scrollTop: $(this.hash).offset().top - fixed_offset }, 1000);
  e.preventDefault();
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

$('.article').readmore({
    maxHeight: 400,
    moreLink: '<a href="#">Читать полностью</a>',
    lessLink: '<a href="#" style="display:none;">Свернуть текст</a>'
});

$('.reviews-read').readmore({
    maxHeight: 800,
    moreLink: '<a href="#">Показать все</a>',
    lessLink: '<a href="#" style="display:none;">Свернуть отзывы</a>'
});

let acc = document.getElementsByClassName("accordion-btn");

for (let i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    let panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}

$("input[name=booking]").change(function() {
    $(".booking__select").removeClass("selected")
    $(this).parents().addClass("selected")
})

$('.slide-autor').owlCarousel({
    loop:false,
    margin:10,
    responsiveClass:true,
    dots: false,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:true
        },
        1000:{
            items:1,
            nav:true
        }
    }
})

$(".filter-category > li > a").click(function(e) {
    $(".filter-category > li > a").not(this).removeClass('active');
    $(this).toggleClass('active');
});
$(document).on('click', function(e) {
    if (!$(e.target).closest(".filter-category > li").length) {
        $(".filter-category > li > a").not(this).removeClass('active');
    }
    e.stopPropagation();
});

$('#demo').daterangepicker({
    "locale": {
        "format": "MM/DD/YYYY",
        "separator": " - ",
        "applyLabel": "Применить",
        "cancelLabel": "Закрыть",
        "fromLabel": "От",
        "toLabel": "До",
        "customRangeLabel": "Custom",
        "weekLabel": "Г",
        "daysOfWeek": [
            "Вс",
            "Пн",
            "Вт",
            "Ср",
            "Чт",
            "Пт",
            "Сб"
        ],
        "monthNames": [
            "Январь",
            "Февраль",
            "Март",
            "Апрель",
            "Мая",
            "Июнь",
            "Июль",
            "Август",
            "Сентябрь",
            "Октябрь",
            "Ноябрь",
            "Декабрь"
        ],
        "firstDay": 1
    },

    "startDate": moment(),
    "endDate": moment(),
    "opens": "center"
}, function cb(start, end) {
        $('#demo').html(start.format('MM.DD.YY') + ' - ' + end.format('MM.DD.YY'));
});

$('select').each(function(){
    let $this = $(this), numberOfOptions = $(this).children('option').length;
  
    $this.addClass('select-hidden'); 
    $this.wrap('<div class="select"></div>');
    $this.after('<div class="select-styled"></div>');

    let $styledSelect = $this.next('div.select-styled');
    $styledSelect.text($this.children('option').eq(0).text());
  
    let $list = $('<ul />', {
        'class': 'select-options'
    }).insertAfter($styledSelect);
  
    for (let i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
        }).appendTo($list);
    }
  
    let $listItems = $list.children('li');
  
    $styledSelect.click(function(e) {
        e.stopPropagation();
        $('div.select-styled.active').not(this).each(function(){
            $(this).removeClass('active').next('ul.select-options').hide();
        });
        $(this).toggleClass('active').next('ul.select-options').toggle();
    });
  
    $listItems.click(function(e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass('active');
        $this.val($(this).attr('rel'));
        $list.hide();
    });
  
    $(document).click(function() {
        $styledSelect.removeClass('active');
        $list.hide();
    });

});

$(function(){
    $('.toggle-dates-event').on('click', function() {
        event.preventDefault();
        $(this).closest(".col-lg-12").find(".event_list_more").toggle('slow');
    });
});

$('.slide-cat').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    dots: false,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:1,
            nav:true
        },
        1000:{
            items:1,
            nav:true
        }
    }
})