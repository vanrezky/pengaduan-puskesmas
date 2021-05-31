<section class="breadcrumb_area">
    <div class="overlay bg-parallax" data-stellar-ratio="0.8" data-stellar-vertical-offset="0" data-background=""></div>
    <div class="container">
        <div class="page-cover text-center">
            <h2 class="page-cover-tittle"><?= $title; ?></h2>
            <ol class="breadcrumb">
                <li><a href="<?= base_url(); ?>">Home</a></li>
                <li class="active"><?= $title; ?></li>
            </ol>
        </div>
    </div>
</section>
<!--================ About History Area  =================-->
<section class="about_history_area section_gap">
    <div class="container">
        <div class="mb-5">
            <div class="row">
                <div class="col-lg-10 mb-2">
                    <input type="text" id="myPlaceTextBox" class="form-control">
                </div>
                <div class="col-lg-2">
                    <button class="genric-btn primary radius" onclick="getLocation()"><i class="fa fa-map-marker"></i> Lokasi Saya</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 d_flex" id="layout-info" style="display:none;">
                <div class="about_content ">
                    <h2 class="title title_color">Tentang TPS</h2>
                    <p>Tempat pembuangan sampah akhir (TPA) suatu area tanah atau galian yang menerima sampah rumah tangga atau jenis sampah lainnya yang tidak berbahaya, seperti sampah padat komersial, limbah lumpur/endapan dan limbah padat industri yang tidak mengandung bahan kimia berbahaya.</p>
                </div>
            </div>

            <div class="col-md-12" id="layout-map">
                <?= $map['html']; ?>
                <div id="directionsDiv"></div>
            </div>
        </div>
    </div>
</section>
<style>
    .auto-map-position {
        cursor: pointer;
    }
</style>
<?= $map['js']; ?>
<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/44/14/intl/en_gb/geometry.js"></script>
<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/44/14/intl/en_gb/directions.js"></script>
<script>
    let markerPositionUser; // global new marker
    let latLngPositionUser = null;
    let closestLocation = [];
    let statusRoutes = false;

    $(document).ready(function(e) {
        $(document).on('click', '.auto-map-position', function(e) {
            e.preventDefault();
            let autoMarker = eval($(this).data('automarker'));
            google.maps.event.trigger(autoMarker, 'click');

        });

        $(document).on('click', '.cari-rute', function(e) {
            e.preventDefault();
            var start = latLngPositionUser.lat() + ',' + latLngPositionUser.lng();
            var end = $(this).data('destination').toString().replace(/[^a-z0-9,. ]/gi, "");
            calcRoutes(start, end);
        });

    });

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation tidak di dukung pada browser anda!");
        }
    }

    function showPosition(position) {
        var location = {
            map: map,
            position: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
            // icon: userMarker,
            animation: google.maps.Animation.BOUNCE,
            optimized: false
        }
        createMarker(location);
    }

    // klik peta
    function mapClicked(markerOptions) {
        createMarker(markerOptions);
        $("#myPlaceTextBox").val("");
    }

    // geometri
    function mapGeometry(markerOptions) {
        createMarker(markerOptions);
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

        if (statusRoutes) {
            directionsDisplay.setDirections({
                routes: []
            });
        }

        closestLocation = findClosestN(latLngPositionUser, numberOfResults);
        // get driving distance
        closestLocation = closestLocation.splice(0, numberOfResults);
        calculateDistances(latLngPositionUser, closestLocation, numberOfDrivingResults);
    }


    function findClosestN(pt, numberOfResults) {

        closestLocation = [];

        for (i = 0; i < markers_map.length; i++) {

            var tpsLatLng = markers_map[i].getPosition();

            markers_map[i].distance = google.maps.geometry.spherical.computeDistanceBetween(pt, tpsLatLng);
            markers_map[i].marker_map_auto = 'marker_' + i;
            markers_map[i].tpsLatLng = tpsLatLng;
            closestLocation.push(markers_map[i]);
        }
        closestLocation.sort(sortByDist);
        // console.log(closestLocation);
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
                    results[i].tpsLatLng = closest[i].tpsLatLng;
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
            position = valueOfElement.tpsLatLng;
            html += '<div href="#" class="list-group-item">';
            html += '<h4 data-automarker="' + valueOfElement.marker_map_auto + '" class="auto-map-position">' + valueOfElement.title + "</h4>";
            html += "<p>Jarak : " + valueOfElement.distance.text + "</p>";
            html += '<a href="javscript:void(0);" class="genric-btn danger radius small cari-rute" data-destination="' + position + '"><i class="icon-arrow-right-circle"></i> Rute</a>';
            html += "</div>";
            // html += valueOfElement.content;
        });
        html += "</div>";

        $("#layout-info").empty().append(html);
        return false;
    }

    //define calcRoutes function
    function calcRoutes(start, end) {
        statusRoutes = true;
        //create request
        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING, //WALKING, BYCYCLING, TRANSIT
            unitSystem: google.maps.UnitSystem.METRIC
        }

        //pass the request to the route method
        directionsService.route(request, function(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {

                //Get distance and time
                // const output = document.querySelector('#output');
                // output.innerHTML = "<div class='alert-info'>From: " + document.getElementById("from").value + ".<br />To: " + document.getElementById("to").value + ".<br /> Driving distance <i class='fas fa-road'></i> : " + result.routes[0].legs[0].distance.text + ".<br />Duration <i class='fas fa-hourglass-start'></i> : " + result.routes[0].legs[0].duration.text + ".</div>";

                //display route
                console.log(result);
                directionsDisplay.setDirections(result);
            } else {
                //delete route from map
                directionsDisplay.setDirections({
                    routes: []
                });
                //center map in London
                map.setCenter(myLatLng);
                //show error message
                output.innerHTML = "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> Could not retrieve driving distance.</div>";
            }
        });

    }
</script>
<!--================ About History Area  =================-->