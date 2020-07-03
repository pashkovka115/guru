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
        $(".mobile_menu_overlay").fadeOut();
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

$(".filter-category > li > span").click(function(e) {
    $(".filter-category > li > span").not(this).removeClass('active');
    $(this).toggleClass('active');
});
$(document).on('click', function(e) {
    if (!$(e.target).closest(".filter-category > li").length) {
        $(".filter-category > li > span").not(this).removeClass('active');
    }
    e.stopPropagation();
});

$(function() {
    $( ".range-line" ).slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 0, 500 ],
        slide: function( event, ui ) {
            $( ".range-result" ).text(ui.values[ 0 ] + " - " + ui.values[ 1 ] + " дней");
        }
    });
});

$(function() {
    $( ".range-price" ).slider({
        range: true,
        min: 0,
        max: 500000,
        values: [ 0, 500000 ],
        slide: function( event, ui ) {
            $( ".range-price-result" ).text(ui.values[ 0 ] + " - " + ui.values[ 1 ] + " RUB");
        }
    });
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

function youTubes_makeDynamic() {
    let $ytIframes = $('iframe[src*="youtube.com"]');
    $ytIframes.each(function (i,e) {
        let $ytFrame = $(e);
        let ytKey;
        let tmp = $ytFrame.attr('src').split(/\//); tmp = tmp[tmp.length - 1]; tmp = tmp.split('?'); ytKey = tmp[0];
        let $ytLoader = $('<div class="youtube" style="background-image: url(https://i.ytimg.com/vi/'+ytKey+'/maxresdefault.jpg)">');
        $ytLoader.append($('<div class="play"></div>'));
        $ytLoader.data('$ytFrame',$ytFrame);
        $ytFrame.replaceWith($ytLoader);
        $ytLoader.click(function () {
            let $ytFrame = $ytLoader.data('$ytFrame');
            $ytFrame.attr('src',$ytFrame.attr('src')+'?autoplay=1');
            $ytLoader.replaceWith($ytFrame);
        });
    });
};
$(document).ready(function () {youTubes_makeDynamic()});

jQuery(document).ready(function() {
    let btn = $('.btn-scroll');  
    $(window).scroll(function() {     
        if ($(window).scrollTop() > 500) {
           btn.addClass('show');
         } else {
           btn.removeClass('show');
         }
    });
    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop:0}, '300');
   });
});

document.querySelector('li[rel="price-low"]').onclick = function () {
    sortList('data-price');
}
document.querySelector('li[rel="price-high"]').onclick = function () {
    sortListDesc('data-price');
}
document.querySelector('li[rel="date-start"]').onclick = function () {
    sortListDesc('data-date');
}
document.querySelector('li[rel="popular"]').onclick = function () {
    sortListDesc('data-popular');
}

function sortList(sortType) {
    let items = document.querySelector('#load_content');
    for (let i = 0; i < items.children.length - 1; i++) {
        for (let j = i; j < items.children.length; j++) {
            if (+items.children[i].getAttribute(sortType) > +items.children[j].getAttribute(sortType)) {
                console.log(1);
                let replacedNode = items.replaceChild(items.children[j], items.children[i]);
                insertAfter(replacedNode, items.children[i]);
            }
        }
    }
}

function sortListDesc(sortType) {
    let items = document.querySelector('#load_content');
    for (let i = 0; i < items.children.length - 1; i++) {
        for (let j = i; j < items.children.length; j++) {
            if (+items.children[i].getAttribute(sortType) < +items.children[j].getAttribute(sortType)) {
                console.log(1);
                let replacedNode = items.replaceChild(items.children[j], items.children[i]);
                insertAfter(replacedNode, items.children[i]);
            }
        }
    }
}


function insertAfter(elem, refElem) {
    return refElem.parentNode.insertBefore(elem, refElem.nextSibling);
}