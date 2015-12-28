$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    
    $(document).on("click", ".open-guestModal", function () {
     var eventId = $(this).data('id');
     $(".modal-body #eventId").val(eventId);
});

    $('.event').each(function () {
        var location = $(this).find('.location').text();
        var map = 'map'.concat($(this).children()[1].id);
        displayMap(location, map);
    });


    function displayMap(location, mapId) {
        L.mapbox.accessToken = 'pk.eyJ1IjoiY2xpZW5nbWUiLCJhIjoiQUo3bUZNcyJ9.HxI36n5gzhdYhxqMG3Zl5g';
        var map = L.mapbox.map(mapId, 'cliengme.ogp3ej00');

        $('.panel').on("shown.bs.collapse", function () {

            map.invalidateSize();
            var geocoder = L.mapbox.geocoder('mapbox.places');

            geocoder.query(location, showMap);

        });

        function showMap(err, data) {

            if (data.lbounds) {
                map.fitBounds(data.lbounds);
            } else if (data.latlng) {
                map.setView([data.latlng[0], data.latlng[1]], 13);

            }
        }
    }


















});


