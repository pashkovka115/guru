'use strict';

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

$(".chosen-select").select2({
    maximumSelectionLength: 5,
    language: {
        maximumSelected: function (args) {
           let message = 'Вы можете выбрать не более' + args.maximum + ' элемент';
    
           if (args.maximum  >= 2 && args.maximum <= 4) {
               message += 'а';
           } else if (args.maximum >= 5) {
               message += 'ов';
           }
           return message;
        },
        noResults: function () {
            return 'Ничего не найдено';
        },
        searching: function () {
            return 'Поиск…';
        }
    }
});



let autocomplete,  marker, infowindow, map;
    function initMap() {

    /*map = new google.maps.Map(document.getElementById('map'), {
        center: {lat:-33.56, lng:151.21},
        zoom: 13
    });

    infowindow = new google.maps.InfoWindow();
    marker = new google.maps.Marker({
        map:map
    });*/

    let inputs = document.querySelector('#address');
    autocomplete = new google.maps.places.Autocomplete(inputs);

    google.maps.event.addListener(autocomplete,'place_changed',function() {

        /*marker.setVisible(false);
        infowindow.close();*/

        let place = autocomplete.getPlace();
        if(!place.geometry) {
            alert('Error');
        }
        /*if(place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        }
        else {
            alert('Error');
        }*/

        /*marker.setIcon({
            url:place.icon,
            scaledSize: new google.maps.Size(35,35)
        });

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);*/

        let address = '';
        if(place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        //infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        //infowindow.open(map, marker);

        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value= place.geometry.location.lng();

        let city = '';
        let street = '';
        let house = '';
        let region = '';
        let country = '';

        let tmp = '';
        place.address_components.forEach(function(item) {
            tmp = item.long_name;
            if(item.types) {
                item.types.forEach(function(t) {

                    switch(t) {
                        case 'street_number':
                            house = tmp;
                            break;
                        case 'route' :
                            street = tmp;
                            break;
                        case 'administrative_area_level_1' :
                        case 'administrative_area_level_2' :
                            region = tmp;
                            break;
                        case 'country' :
                            country = tmp;
                            break;
                        case 'postal_town' :
                        case 'locality' :
                            city = tmp;
                            break;
                    }

                });
            }
        });
        document.getElementById('city').value = city;
        document.getElementById('street').value = street;
        document.getElementById('house').value = house;
        document.getElementById('region').value = region;
        document.getElementById('country').value = country;
    });
}

function readURL() {
    let $input = $(this);
    let $newinput =  $(this).parent().parent().parent().find('.portimg');
    if (this.files && this.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            reset($newinput.next('.delbtn'), true);
            $newinput.attr('src', e.target.result).show();
            $newinput.after('<span class="delbtn removebtn"><i class="fa fa-times" aria-hidden="true"></i></span>');
        }
        reader.readAsDataURL(this.files[0]);
    }
}

$(document).on("change", ".photo-variant", readURL);
$(document).on('click', '.choose-file .delbtn', function (e) {
    reset($(this));
});

function reset(elm, prserveFileName) {
    if (elm && elm.length > 0) {
        let $input = elm;
        $input.prev('.portimg').attr('src', '').hide();
        if (!prserveFileName) {
            $('input.photo-variant').val("");
        }
        elm.remove();
    }
}

$(document).ready(function() {
	if (window.File && window.FileList && window.FileReader) {
	$("#photogallery").on("change", function(e) {
	  let files = e.target.files,
	    filesLength = files.length;
	  for (let i = 0; i < filesLength; i++) {
	    let f = files[i]
	    let fileReader = new FileReader();
	    fileReader.onload = (function(e) {
	      let file = e.target;
	      $("<span class=\"photogallery-demo\">" +
	        "<img class=\"photogallery-elem\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
	        "<span class=\"removebtn\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span>" +
	        "</span>").insertAfter(".photogallery-container");
	      $(".removebtn").click(function(){
	        $(this).parent(".photogallery-demo").remove();
	      });
	    });
	    fileReader.readAsDataURL(f);
	  }
	});
	$("#accommodation-photo").on("change", function(e) {
	  let files = e.target.files,
	    filesLength = files.length;
	  for (let i = 0; i < filesLength; i++) {
	    let f = files[i]
	    let fileReader = new FileReader();
	    fileReader.onload = (function(e) {
	      let file = e.target;
	      $("<span class=\"photogallery-demo\">" +
	        "<img class=\"photogallery-elem\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
	        "<span class=\"removebtn\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span>" +
	        "</span>").insertAfter(".accommodation-container");
	      $(".removebtn").click(function(){
	        $(this).parent(".photogallery-demo").remove();
	      });
	    });
	    fileReader.readAsDataURL(f);
	  }
	});
	$("#meals-photo").on("change", function(e) {
	  let files = e.target.files,
	    filesLength = files.length;
	  for (let i = 0; i < filesLength; i++) {
	    let f = files[i]
	    let fileReader = new FileReader();
	    fileReader.onload = (function(e) {
	      let file = e.target;
	      $("<span class=\"photogallery-demo\">" +
	        "<img class=\"photogallery-elem\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
	        "<span class=\"removebtn\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></span>" +
	        "</span>").insertAfter(".meals-container");
	      $(".removebtn").click(function(){
	        $(this).parent(".photogallery-demo").remove();
	      });
	    });
	    fileReader.readAsDataURL(f);
	  }
	});
	} else {
	alert("Ваш браузер устарел и не поддерживает загрузку!")
	}
});

$(".removebtn").click(function(){
	$(this).parent(".photogallery-demo").remove();
});
