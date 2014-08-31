$(document).ready(function () {
    dropList = $('#drop_list');
    markersAmount = $('#markers_amount');
    iconDefault = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png';
    iconHover = 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png';
    loader = $('.map_loader');

    // init map
    map = new GMaps({
        div: '#drop_map',
        zoom: 15,
        lat: Boilerplate.currentDropLat,
        lng: Boilerplate.currentDropLng
    });

    // if there are markers found
    var markers = Boilerplate.currentDropMarkers;
    if (markers) {
        $(markers).each(function () {
            var markerIndex = map.markers.length;
            var markerLat = $(this)[0].lat;
            var markerLng = $(this)[0].lng;
            var markerId = $(this)[0].id;

            listMarkers(markerIndex, markerLat, markerLng, $(this)[0].id, $(this)[0].name);
            addMarker(markerIndex, markerLat, markerLng, markerId);
        });
    }

    // add a marker
    GMaps.on('click', map.map, function (event) {
        loader.show();
        var markerIndex = map.markers.length;
        var markerLat = event.latLng.lat();
        var markerLng = event.latLng.lng();

        // push marker to database
        var formData = new FormData();
        formData.append('name', 'Marker ' + (markerIndex + 1));
        formData.append('lat', markerLat);
        formData.append('lng', markerLng);
        formData.append('dropId', Boilerplate.currentDropId);

        $.ajax({
            type: "POST",
            url: "/marker/add",
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            data: formData,
            success: function (data) {
                // console.log(data)

                if (data.success) {
                    loader.hide();

                    addMarker(markerIndex, markerLat, markerLng, data.marker.id);
                    listMarkers(markerIndex, markerLat, markerLng, data.marker.id, data.marker.name);

                    drawRoute();
                }
            },
            error: function (data) {
                console.log("Marker could not be created: " + data);
            }
        });
    });

    // when clicking on the marker
    $(document).on('click', '.goto-marker', function (e) {
        e.preventDefault();

        var markerLat, markerLng;

        var $index = $(this).data('marker-index');
        var position = map.markers[$index].getPosition();

        markerLat = position.lat();
        markerLng = position.lng();

        map.setCenter(markerLat, markerLng);
    });

    // when deleting a marker
    $(document).on('click', '.delete-marker', function (e) {
        loader.show();
        e.preventDefault();

        var id = $(this).data('marker-id');
        var $index = $(this).data('marker-index');
        var marker = map.markers[$index];

        // delete marker from database
        $.ajax({
            type: "DELETE",
            url: "/marker/delete/" + id,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    loader.hide();

                    // remove from map
                    marker.setMap(null);

                    // remove from list
                    $('.marker-list-item' + $index).remove();

                    // set amount of markers
                    markersAmount.val($('#drop_list li').length);

                    // draw route
                    drawRoute();
                }
            },
            error: function (data) {
                console.log("Marker could not be removed: " + data);
            }
        });
    });

    // when updating markers info
    $('#marker-submit').click(function(){
        var markerId = $('#current_marker').val();

        var markerHasEvent = 0;
        if($('#event').prop('checked')) markerHasEvent = 1;

        // update marker in database
        var formData = new FormData();
        formData.append('name', $('#name').val());
        formData.append('hasEvent', markerHasEvent);

        $.ajax({
            method: "POST",
            url: "/marker/updateinfo/" + markerId,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            data: formData,
            success: function (data) {
                console.log(data)

                // form is valid
                if (data.success) {
                    // set view
                    $('#marker-id-' + markerId + ' .marker-list-a').html(data.marker.name);

                    // hide errors
                    $('.alert-ajax').hide().find('ul').empty();

                    // hide modal
                    $('#modalMarker').modal('hide');
                }
                // form is invalid
                else{
                    showErrors(data.errors);
                }
            },
            error: function (data) {
                console.log("Marker could not be updated the info:" + data);
            }
        });
    });
});

/**
 * Draw the route on the map
 */
function drawRoute() {
    var distance = 0;
    var lastIndex = -1;

    map.removePolylines();

    var dropList = $("#drop_list li");
    dropList.each(function (idx, li) {
        // get marker index
        var $index = ($(li).data('marker-index'));

        if (lastIndex !== -1) {
            var currentPosition = map.markers[$index].getPosition();
            var currentLat = currentPosition.lat();
            var currentLng = currentPosition.lng();

            var lastPosition = map.markers[lastIndex].getPosition();
            var lastLat = lastPosition.lat();
            var lastLng = lastPosition.lng();

            var currentLatlng = new google.maps.LatLng(currentLat, currentLng);
            var lastLatlng = new google.maps.LatLng(lastLat, lastLng);

            map.drawPolyline({
                path: [currentLatlng, lastLatlng],
                strokeColor: "##FF0000",
                strokeOpacity: 1.0,
                strokeWeight: 2
            });

            distance += google.maps.geometry.spherical.computeDistanceBetween(currentLatlng, lastLatlng);
        }

        lastIndex = $index;
    });

    // color markers on hover
    $('#drop_list li').mouseenter(function () {
        // get marker index
        var $index = ($(this).data('marker-index'));
        var marker = map.markers[$index];

        marker.setIcon(iconHover);
    }).mouseleave(function () {
        // get marker index
        var $index = ($(this).data('marker-index'));
        var marker = map.markers[$index];

        marker.setIcon(iconDefault);
    });
}

/**
 * Lists markers
 *
 * @param index
 * @param lat
 * @param lng
 * @param id
 */
function listMarkers(index, lat, lng, id, name) {
    // append to list
    dropList.append('<li id="marker-id-' + id + '" class="marker-list-item' + index + '" data-marker-index="' + index + '"><a href="javascript:;" class="marker-list-a" data-marker-id="' + id + '">' + name + '</a><i class="fa fa-sort pull-right"></i><a href="#" class="delete-marker" data-marker-id="' + id + '" data-marker-index="' + index + '"><i class="glyphicon glyphicon-remove pull-right"></i><a href="#" class="goto-marker" data-marker-lat="' + lat + '" data-marker-lng="' + lng + '" data-marker-index="' + index + '"><i class="fa fa-eye pull-right"></i></a></li>');

    // and make it sortable
    dropList.sortable({
        axis: 'y',
        update: function () {
            loader.show();

            var formData = $(this).sortable('serialize');

            // update the order in the database
            $.ajax({
                type: "POST",
                url: "/drops/sortmarkers/" + Boilerplate.currentDropId,
                processData: false,
                cache: false,
                dataType: 'json',
                data: formData,
                success: function (data) {
                    //console.log(data);

                    if (data.success) {
                        loader.hide();

                        // draw route
                        drawRoute();
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }
    });

    // set amount of markers
    markersAmount.val($('#drop_list li').length);

    // when clicking on a list item --> show modal
    $('.marker-list-a').click(function(){
        var id = $(this).data('marker-id');

        showMarker(id);
    });
}

/**
 * Add a marker
 *
 * @param index
 * @param lat
 * @param lng
 */
function addMarker(index, lat, lng, id) {
    var marker = map.addMarker({
        lat: lat,
        lng: lng,
        draggable: true,
        icon: iconDefault,
        title: 'Marker #' + index
    });

    // set id to marker
    marker.set('id', id);

    // what happens when you click a maker
    GMaps.on('click', marker, function(e) {
        showMarker(marker.id);
    });

    // what happens when you draged a maker
    GMaps.on('dragend', marker, function(e) {
        //console.log(marker);
        loader.show();

        var markerId = marker.id;

        // update marker in database
        var formData = new FormData();
        formData.append('lat', e.latLng.lat());
        formData.append('lng', e.latLng.lng());

        $.ajax({
            method: "POST",
            url: "/marker/updatelatlng/" + markerId,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            data: formData,
            success: function (data) {
                //console.log(data);

                if (data.success == 1) {
                    loader.hide();

                    // draw route
                    drawRoute();
                }
            },
            error: function (data) {
                console.log("Marker could not be updated:" + data);
            }
        });
    });

    drawRoute();
}

/**
 * Shows the modal of a marker
 * @param id
 */
function showMarker(id){
    $.ajax({
        type: "GET",
        url: "/marker/show/" + id,
        processData: false,
        contentType: false,
        cache: false,
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                //console.log(data);

                // place view
                $('#modalMarker .modal-body').html(data.view);

                // checkbox event
                eventContent = $('#event-content');
                $('#event').change(function () {
                    if ($(this).prop('checked')) {
                        eventContent.show();
                    }
                    else {
                        eventContent.hide();
                    }
                });

                // show modal
                $('#modalMarker').modal('show');
            }
        },
        error: function (data) {
            console.log("Marker could not be shown: " + data);
        }
    });
}
