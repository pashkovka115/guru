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
        $(".mobile_menu_overlay").fadeOut();;
        $("body").removeClass("no-overlay");
    });
});

$(".chosen-select").select2({
    tags: true
});

/*$('.click_to_add_block').click(function() {
  $(this).before(`
    <div class="block-variants">
        <div class="choose-file">
            <div class="upload-demo">
                <div class="upload-demo-wrap"><img class="img-fluid portimg" src="http://a0437878.xsph.ru/assets/site/images/wide.jpg"></div>
            </div>
            <span class="btn_upload">
                    <input type="file" name="photo_variant[]" class="inputfile photo-variant">
                    Загрузить фото
                </span>
        </div>
        <div class="block-variant-date">
            <p>Дата начала</p>
            <input class="text-variant" type="date" name="date_start_variant[]" value="">
        </div>
        <div class="block-variant-date">
            <p>Дата окончания</p>
            <input class="text-variant" type="date" name="date_end_variant[]" value="">
        </div>
        <div class="block-variant-desk">
            <p>Краткое описание (проживание, питание и т.д.)</p>
            <input class="text-variant" type="text" name="text_variant[]" value="">
        </div>
        <div class="block-variant-price">
            <p>Цена (RUB)</p>
            <input class="price-variant" type="text" name="price_variant[]" value="" required>
        </div>
        <div class="block-variant-amount">
            <p>Кол. человек</p>
            <select name="amount_variant[]" class="amount-variant">
                <option value="1 человек">1 человек</option>
                <option value="2 человека">2 человек</option>
                <option value="3 человека">3 человека</option>
                <option value="4 человека">4 человека</option>
                <option value="5 человек">5 человек</option>
            </select>
        </div>
        <div class="delete" data-id="0"><i class="fa fa-times" aria-hidden="true"></i></div>
    </div>
    `);
});

$(document).on('click', '.delete', function(e) {
    // e.stopPropagation();
    // console.log(e.target.parentElement)
    $.ajax({
        type: "GET",
        url: "http://a0437878.xsph.ru/delete-variant-tour/" + e.target.parentElement.dataset.id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            //'id': e.target.parentElement.dataset.id
        },
        success: function(msg){
            console.log(msg, 'удаление ' + e.target.parentElement.dataset.id);
            $(e.target).parent().parent().remove();
            // $(this).parent().remove();
        },
        error: function (msg, textStatus) {
            console.log('Неудача. ' + textStatus);
        }
    });

});*/

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
