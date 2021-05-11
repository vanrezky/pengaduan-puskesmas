<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    protected $center;
    function __construct()
    {
        parent::__construct();
        $this->load->library('googlemaps');
        $this->load->model('tpsModel');
        $this->center = getPengaturanWebsite("center_map_lat") . ',' . getPengaturanWebsite("center_map_lng");
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
        ];

        $this->view('home/v_home_index', $data, true);
    }

    public function persebaran()
    {
        // ambil semua tps
        $tps = $this->tpsModel->getData()->result_array();


        $config['center'] = 'auto';
        $config['zoom'] = 'auto';
        $config['places'] = TRUE;
        $config['disableStreetViewControl'] = true;
        $config['onclick'] = "mapClicked({ map: map, position:event.latLng, icon:{url:'" . base_url("assets/img/icon/me.png") . "'}});";
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
        $config['placesAutocompleteOnChange'] = "mapGeometry({ map: map, position:placesAutocomplete.getPlace().geometry.location, icon:{url:'" . base_url("assets/img/icon/me.png") . "'}});";

        $config['onboundschanged'] = 'if (!centreGot) {
                                            var mapCentre = map.getCenter();
                                            marker_0.setOptions({
                                                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
                                            });
                                        }
                                        centreGot = true;';
        $this->googlemaps->initialize($config);
        $HTML = "";
        foreach ($tps as $value) {
            $gambar = 'default.jpg';
            if (!empty($value['gambar']))
                $gambar = base_url("uploads/img/" . $value['gambar']);


            $HTML .= "<div class='media'>";
            $HTML .= "<div class='media-left'>";
            $HTML .= "<img src='$gambar' class='media-object' style='width:150px;'>";
            $HTML .= "</div>";
            $HTML .= "<div class='media-body'>";
            $HTML .= "<h4>$value[nama_tps]</h4>";
            $HTML .= "<ol>";
            $HTML .= "<li>ALamat, $value[alamat]</li>";
            $HTML .= "<li>No Telp, $value[telp]</li>";
            $HTML .= "</ol>";
            $HTML .= "</div>";
            $HTML .= "</div>";

            $marker = array();
            $marker['position'] = "$value[lat],$value[lng]";
            $marker['title'] = $value['nama_tps'];
            $marker['animation'] = 'BOUNCE';
            $marker['infowindow_content'] = $HTML;
            $HTML = "";


            $marker['icon'] = base_url("uploads/img/" . $value['marker']);
            $this->googlemaps->add_marker($marker);
        }

        $data = [
            'title' => 'Persebaran',
            'map' => $this->googlemaps->create_map(),
        ];

        $this->view('home/v_home_map', $data);
    }
}
