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
            'banyakDilihat' => $this->tpsModel->getDataBanyakDilihat(),
        ];

        $this->view('home/v_home_index', $data, true);
    }

    public function persebaran($id = "")
    {
        $id = $id  == "" ? "" : decode($id);
        $globalSettingMarker = "animation: google.maps.Animation.BOUNCE, optimized: false";
        // ambil semua tps
        $tps = $this->tpsModel->getData("", "", $id)->result_array();

        $config['center'] = (count($tps) == 1 ? $tps[0]['lat'] . ',' . $tps[0]['lng'] : $this->center);
        // $config['directions'] = TRUE;
        // $config['directionsStart'] = '0.5653222492658629, 101.42672880801696';
        // $config['directionsEnd'] = '0.566316846105612, 101.43134562796631';
        $config['zoom'] = (count($tps) > 1 ? 'auto' : getPengaturanWebsite('zoom'));
        $config['places'] = TRUE;
        $config['disableStreetViewControl'] = true;
        $config['onclick'] = "mapClicked({ map: map, position:event.latLng, $globalSettingMarker});";
        $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
        $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
        $config['placesAutocompleteOnChange'] = "mapGeometry({ map: map, position:placesAutocomplete.getPlace().geometry.location, $globalSettingMarker});";
        $config['directions'] = TRUE;
        $config['directionsDivID'] = 'directionsDiv';
        $config['directionsDraggable'] = false;
        $this->googlemaps->initialize($config);
        $HTML = "";
        foreach ($tps as $value) {
            $gambar = 'default.jpg';
            if (!empty($value['gambar']))
                $gambar = base_url("uploads/img/" . $value['gambar']);


            $HTML .= "<div class='media'>";
            $HTML .= "<div class='media-left'>";
            $HTML .= "<img src='$gambar' class='media-object' style='width:150px;border-radius:5px;'>";
            $HTML .= "</div>";
            $HTML .= "<div class='media-body'>";
            $HTML .= "<ul style='list-style-type:none;'>";
            $HTML .= "<li><h4>$value[nama_tps]</h4></li>";
            $HTML .= "<li>ALamat, $value[alamat]</li>";
            $HTML .= "<li>No Telp, $value[telp]</li>";
            $HTML .= "<li>Keterangan, $value[keterangan]</li>";
            $HTML .= "</ol>";
            $HTML .= "</div>";
            $HTML .= "</div>";

            $marker = array();
            $marker['position'] = "$value[lat],$value[lng]";
            $marker['title'] = $value['nama_tps'];
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

    public function kontak()
    {

        $data = [
            'title' => 'Kontak',
        ];

        $this->view('home/v_home_kontak', $data);
    }

    public function save_kontak()
    {

        if ($this->input->is_ajax_request()) {
            $csrf = csrf_hash();

            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'pesan' => $this->input->post('pesan')
            ];


            $insert = $this->db->insert("tb_kontak", $data);

            $msg = ["success" => true, "csrf" => $csrf, "pesan" => "Pesan berhasil dikirim..!"];


            echo json_encode($msg);
        }
    }


    public function daftarTps()
    {

        $search = $this->input->get("s");

        $per_page = '5'; #banyaknya data yang ditampilkan
        $total = $this->tpsModel->getData()->num_rows(); #ambil semua total data tps

        $data = [
            'title' => "Daftar TPS",
            'pagin' => PaginFrontend('daftar-tps', $total, $per_page),
            'tps' => $this->tpsModel->getData($per_page, Offset('daftar-tps', 1))->result_array(),
            'banyakDilihat' => $this->tpsModel->getDataBanyakDilihat(),
        ];

        $this->view('home/v_home_daftar_tps', $data);
    }

    public function detailTps($id = "")
    {
        $id = decode($id);
        if ($id) {
            $D = $this->tpsModel->getDataID($id);
            if ($D) {

                $config = [
                    'map_div_id' => "map-add",
                    'map_height' => "350px",
                    'center' => $D['lat'] . ',' . $D['lng'],
                    'zoom' => !empty($pengaturan['zoom']) ? $pengaturan['zoom'] : "12",
                ];

                $this->googlemaps->initialize($config);

                $HTML = "";
                $HTML .= "<div class='media'>";
                $HTML .= "<div class='media-left'>";
                $HTML .= "<img src='" . base_url('uploads/img/' . $D['gambar']) . "' class='media-object' style='width:150px;'>";
                $HTML .= "</div>";
                $HTML .= "<div class='media-body'>";
                $HTML .= "<h4>$D[nama_tps]</h4>";
                $HTML .= "<ol>";
                $HTML .= "<li>ALamat, $D[alamat]</li>";
                $HTML .= "<li>No Telp, $D[telp]</li>";
                $HTML .= "</ol>";
                $HTML .= "</div>";
                $HTML .= "</div>";

                $marker = [
                    'position' => $D['lat'] . ',' . $D['lng'],
                    'draggable' => true,
                    'animation' => 'BOUNCE',
                    'infowindow_content' => $HTML,
                    'icon' => base_url("uploads/img/" . $D['marker']),
                    'id' => "van",
                ];

                $this->googlemaps->add_marker($marker);

                $data = [
                    'title' => $D['nama_tps'],
                    'data' => $D,
                    'map' => $this->googlemaps->create_map(),
                    'banyakDilihat' => $this->tpsModel->getDataBanyakDilihat(),
                ];

                $this->tpsModel->updateDataID($id);

                $this->view('home/v_home_detail_tps', $data);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }


    public function rute($id)
    {

        $id = decode($id);

        if ($id) {
        } else {
            show_404("maaf, data tidak ditemukan!");
        }
    }

    public function get_route($id)
    {
        if ($this->session->userdata('logged_in') != "" && $this->session->userdata('id_role') == "1") {

            $directionLat = $this->input->post('latitude');
            $directionLng = $this->input->post('longitude');

            if ($directionLat == 0 && $directionLng == 0) {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Silahkan Tentukan Lokasi Anda Terlebih Dahulu ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/costumer/route/' . $id);
            } else {

                $datamap = $this->m_costumer->detail_costumer_info($id);

                $config['map_div_id'] = "map-add";
                $config['center'] = $datamap->latitude . ',' . $datamap->longitude;
                $config['map_height'] = '400px;';
                $config['zoom'] = 'auto';
                $config['minzoom'] = '11';
                $config['directions'] = TRUE;
                $config['directionsStart'] = $directionLat . ',' . $directionLng;
                $config['directionsEnd'] = $datamap->latitude . ',' . $datamap->longitude;
                $config['directionsDraggable'] = TRUE;
                $config['directionsDivID'] = 'directionsDiv';
                $this->googlemaps->initialize($config);

                // $marker = array();
                // $marker['position'] = $datamap->latitude . ',' . $datamap->longitude;
                // $marker['animation'] = 'DROP';
                // $marker['icon'] = base_url("assets/icon/marker.png");
                // $this->googlemaps->add_marker($marker);

                $data['map'] = $this->googlemaps->create_map();

                $data['get_costumer_detail'] = $this->m_costumer->detail_costumer_info($id);

                $data['title'] = "Rute Costumer : $datamap->nama_costumer ";

                // var_dump($config);
                // die;


                $this->render('admin/costumer_route', $data);
            }
        } else {
            redirect('login/logout');
        }
    }
}
