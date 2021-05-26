<?= $map['js']; ?>
<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/44/14/intl/en_gb/geometry.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/44/14/intl/en_gb/directions.js"></script>
<script>
    $(document).ready(function(e) {

        $(document).on('click', '.auto-map-position', function(e) {
            e.preventDefault();
            let autoMarker = eval($(this).data('automarker'));
            google.maps.event.trigger(autoMarker, 'click');

        });

        $(document).on('click', '.directions', function(e) {
            e.preventDefault();
            var destination = $(this).data('destination');
            var origin = $("#latLngPositionUser").val();
            calcRoute(origin, destination);
        });
    });
</script>

<script>
    let markerPositionUser; // global new marker
    let latLngPositionUser = null;
    let closestLocation = [];
    // let directionsService = new google.maps.DirectionsService(); // create direction object to use method

    // klik peta
    function mapClicked(markerOptions) {
        createMarker(markerOptions);
        $("#myPlaceTextBox").val("");
    }

    // geometri
    function mapGeometry(markerOptions) {
        createMarker(markerOptions);
    }

    // set latitude dan logitude di global user
    function setLatLng(latLng) {
        latLngPositionUser = latLng.toString().replace(/[^a-z0-9,. ]/gi, "");
    }

    // buat marker
    function createMarker(markerOptions) {
        var markerPosition = markerOptions.position;

        if (!markerPositionUser) {
            markerPositionUser = new google.maps.Marker(markerOptions);

        } else {
            markerPositionUser.setPosition(markerPosition);
        }

        latLngPositionUser = markerPosition;
        map.panTo(markerPosition);
        // cari marker terdekat
        find_closest_marker();
        return false;
    }

    // cari lokasi atau marker terdekat
    function find_closest_marker() {
        var numberOfResults = 25;
        var numberOfDrivingResults = 5;

        closestLocation = findClosestN(latLngPositionUser, numberOfResults);
        // get driving distance
        closestLocation = closestLocation.splice(0, numberOfResults);
        calculateDistances(latLngPositionUser, closestLocation, numberOfDrivingResults);
    }


    function findClosestN(pt, numberOfResults) {

        closestLocation = [];

        for (i = 0; i < markers_map.length; i++) {
            markers_map[i].distance = google.maps.geometry.spherical.computeDistanceBetween(pt, markers_map[i].getPosition());
            markers_map[i].marker_map_auto = 'marker_' + i;
            closestLocation.push(markers_map[i]);
        }
        closestLocation.sort(sortByDist);
        console.log(closestLocation);
        return closestLocation;
    }

    function sortByDist(a, b) {
        return (a.distance - b.distance)
    }

    function calculateDistances(pt, closest, numberOfResults) {
        var service = new google.maps.DistanceMatrixService();
        var request = {
            origins: [pt],
            destinations: [],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            avoidHighways: false,
            avoidTolls: false
        };
        for (var i = 0; i < closest.length; i++) {
            request.destinations.push(closest[i].getPosition());
        }
        service.getDistanceMatrix(request, function(response, status) {
            if (status != google.maps.DistanceMatrixStatus.OK) {
                alert('Error was: ' + status);
            } else {
                var origins = response.originAddresses;
                var destinations = response.destinationAddresses;
                // var outputDiv = document.getElementById('side_bar');
                // outputDiv.innerHTML = '';

                var results = response.rows[0].elements;
                // save title and address in record for sorting
                for (var i = 0; i < closest.length; i++) {
                    results[i].title = closest[i].title;
                    results[i].address = closest[i].address;
                    results[i].marker_map_auto = closest[i].marker_map_auto;
                }
                results.sort(sortByDistDM);

                tampilkan(results);
                initLayout("open");
            }
        });
    }

    function sortByDistDM(a, b) {
        return (a.distance.value - b.distance.value)
    }

    // tampikan lokasi terdekat
    function initLayout(tipe) {
        let layoutInfo = $("#layout-info");
        let layoutMap = $("#layout-map");

        if (tipe == "open") {
            layoutMap.removeClass("col-md-12").addClass("col-md-8");
            layoutInfo.show();
        } else if (tipe == "close") {
            layoutMap.removeClass("col-md-8").addClass("col-md-12");
            layoutInfo.addClass("hidden");
        }

        return false;
    }

    function tampilkan(terdekat) {
        let html = '<div class="list-group">';

        $.each(terdekat, function(indexInArray, valueOfElement) {
            // position = valueOfElement.position.toString().replace(/[^a-z0-9,. ]/gi, "");
            position = "";
            html += '<div href="#" class="list-group-item">';
            html += '<h4 data-automarker="' + valueOfElement.marker_map_auto + '" class="auto-map-position">' + valueOfElement.title + "</h4>";
            html += "<p>Jarak : " + valueOfElement.distance.text + "</p>";
            html += '<a href="" class="s-icon-lonely directions" data-destination="' + position + '"><i class="icon-arrow-right-circle"></i> Rute</a>';
            html += "</div>";
            // html += valueOfElement.content;
        });
        html += "</div>";

        $("#layout-info").empty().append(html);
        return false;
    }
</script>
<?= breadcrumb($title); ?>
<div class="section-wrap">
    <!-- FEATURES SECTION -->
    <div class="features-section section">
        <h4 class="title large"><?= $pengaturan['nama_website']; ?></h4>
        <hr class="line-separator">
        <div style="margin-bottom:30px">
            <input type="text" id="myPlaceTextBox" class="form-control">
            <input type="hidden" id="latLngPositionUser" class="form-control">
        </div>


        <!-- BG DECORATION -->
        <div class="row">
            <div class="col-md-4" id="layout-info" style="display:none;"></div>
            <div class="col-md-12" id="layout-map">
                <?= $map['html']; ?>
            </div>
        </div>
    </div>
    <!-- /FEATURES SECTION -->
</div>