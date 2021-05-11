<style>
    .media {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
    }

    .media-object {
        max-width: 100px;
        border-radius: 4px;
        margin-right: 10px;
    }

    .media-body {
        -webkit-box-flex: 1;
        -ms-flex: 1;
        flex: 1;
    }

    .auto-map-position {
        cursor: pointer;
    }

    .auto-map-position:hover {
        text-decoration: underline;
    }
</style>
<script>
    let marker; // global new marker
    let terdekat = []; // global terdekat
    let centreGot = false;



    $(document).ready(function(e) {

        $(document).on('click', '.auto-map-position', function(e) {
            e.preventDefault();
            let autoMarker = eval($(this).data('automarker'));
            google.maps.event.trigger(autoMarker, 'click');

        });
    });
    // klik peta
    function mapClicked(markerOptions) {
        createMarker(markerOptions);
        $("#myPlaceTextBox").val("");
    }

    // geometri
    function mapGeometry(markerOptions) {
        createMarker(markerOptions);
    }

    // get location
    // function myFunction() {
    //     if (navigator.geolocation) {
    //         navigator.geolocation.getCurrentPosition(getPosition, showError);
    //     } else {
    //         alert("Geolocation is not supported by this browser.");
    //     }
    // }

    function showPosition(userLatitude, userLongitude) {
        lat = userLatitude;
        lon = userLongitude;
        latlon = new google.maps.LatLng(lat, lon);
        map.panTo(latlon);
    }

    function getPosition(position) {
        UserLatitude = position.coords.latitude;
        UserLongitude = position.coords.longitude;
        showPosition(UserLatitude, UserLongitude);
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.");
                break;
            case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.")
                break;
            case error.TIMEOUT:
                alert("The request to get user location timed out.")
                break;
            case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.")
                break;
        }
    }


    // buat marker
    function createMarker(markerOptions) {
        if (marker == undefined) {
            marker = new google.maps.Marker(markerOptions);
        } else {
            marker.setPosition(markerOptions.position);
        }

        // animasi center
        map.panTo(markerOptions.position);

        find_closest_marker(markerOptions);
        return marker;

    }

    function rad(x) {
        return x * Math.PI / 180;
    }

    function find_closest_marker(event) {
        var lat = event.position.lat();
        var lng = event.position.lng();
        var R = 6371; // radius of earth in km
        var distances = [];
        var closest = -1;
        terdekat = [];
        for (i = 0; i < markers_map.length; i++) {
            var mlat = markers_map[i].position.lat();
            var mlng = markers_map[i].position.lng();
            var title = markers_map[i].title;
            var dLat = rad(mlat - lat);
            var dLong = rad(mlng - lng);
            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(rad(lat)) * Math.cos(rad(lat)) * Math.sin(dLong / 2) * Math.sin(dLong / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c;
            distances[i] = d;

            //tambahkan jarak ke dalam marker
            markers_map[i].distance = d;
            // tambahkan parameter marker-map-auto
            markers_map[i].marker_map_auto = 'marker_' + i;

            // masukkan ke terdekat
            terdekat.push(markers_map[i]);

            if (closest == -1 || d < distances[closest]) {
                closest = i;
            }
        }

        terdekat.sort(function(a, b) {
            return a.distance - b.distance;
        });

        console.log(terdekat);

        // alert(markers_map[closest].title);
        tampilkan(terdekat);
        initLayout("open");
    }

    // tampikan lokasi terdekat
    function initLayout(tipe) {

        let layoutInfo = $("#layout-info");
        let layoutMap = $("#layout-map");

        if (tipe == 'open') {
            layoutMap.removeClass('col-md-12').addClass('col-md-8');
            layoutInfo.show();
        } else if (tipe == 'close') {
            layoutMap.removeClass('col-md-8').addClass('col-md-12');
            layoutInfo.addClass('hidden');
        }

        return false
    }

    function tampilkan(terdekat) {
        let html = '<div class="list-group">';

        $.each(terdekat, function(indexInArray, valueOfElement) {

            html += '<div href="#" class="list-group-item">';
            html += '<h4 data-automarker="' + valueOfElement.marker_map_auto + '" class="auto-map-position">' + valueOfElement.title + '</h4>';
            html += '<p>Jarak : ' + valueOfElement.distance.toFixed(2) + ' Km </p>';
            html += '<a href="" class=""><span class="s-icon-lonely icon-arrow-right-circle"> Rute</span> </a>';
            html += '</div>';
            // html += valueOfElement.content;

        });
        html += '</div>';

        $("#layout-info").empty().append(html);
        return false;

    }
</script>
<?= $map['js']; ?>
<div class="section-navigation-wrap">
    <!-- SECTION NAVIGATION -->
    <div class="section-navigation">
        <!-- SECTION NAVIGATION PATH -->
        <p class="section-navigation-path">
            <span class="path">Home</span>
            <span class="path bold">
                <!-- SVG ARROW -->
                <svg class="svg-arrow tiny">
                    <use xlink:href="#svg-arrow"></use>
                </svg>
                <!-- /SVG ARROW -->
            </span>
            <span class="path current">Persebaran</span>
        </p>
        <!-- SECTION NAVIGATION PATH -->
    </div>
    <!-- /SECTION NAVIGATION -->
</div>
<div class="section-wrap">
    <!-- FEATURES SECTION -->
    <div class="features-section section">
        <h4 class="title large"><?= $pengaturan['nama_website']; ?></h4>
        <hr class="line-separator">
        <div style="margin-bottom:30px">
            <input type="text" id="myPlaceTextBox" class="form-control">
            <!-- <button onclick="myFunction()">Posisi Saya</button> -->
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