<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('googlemaps'));
        $this->load->model('PengaturanModel', 'pengaturanModel');
        logged_in();
    }

    public function index()
    {

        $pengaturan = $this->pengaturanModel->getData()->row_array();
        $lat = $pengaturan['center_map_lat'];
        $lng = $pengaturan['center_map_lng'];

        $config = [
            'map_div_id' => "map-add",
            'map_height' => "600px",
            'center' => (!empty($lat) && !empty($lng)) ? $lat . "," . $lng : '0.5333593798115907,101.43400637930908',
            'zoom' => !empty($pengaturan['zoom']) ? $pengaturan['zoom'] : "12",
            'onclick' => "newLocationClick(event.latLng.lat(), event.latLng.lng());",
        ];

        $this->googlemaps->initialize($config);

        $marker = [
            'position' => (!empty($lat) && !empty($lng)) ? $lat . "," . $lng : '0.5333593798115907,101.43400637930908',
            'draggable' => true,
            'animation' => 'BOUNCE',
            'icon' => base_url("assets/img/icon/marker.png"),
            'infowindow_content' => "<div><p>Posisi Kamu</p></div>",
            'ondragend' => "newLocationDrag(event.latLng.lat(), event.latLng.lng());",
            'id' => "van",
        ];

        $this->googlemaps->add_marker($marker);

        $data = [
            'title' => "Data Pengaturan",
            'pengaturan' => $pengaturan,
            'map' => $this->googlemaps->create_map(),
        ];

        $this->render("admin/v_pengaturan_index", $data);
    }


    public function save()
    {
        if ($this->input->is_ajax_request()) {
            $pengaturan_id = 1;
            $pengaturan = $this->db->get_where("tb_pengaturan", ["id" => $pengaturan_id])->row_array();
            $csrf = csrf_hash();

            $validation = $this->form_validation;
            $validation->set_rules("nama_website", "Nama Website", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("deskripsi", "Deskripsi Website", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("zoom", "Zoom Peta", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("center_map_lat", "Posisi tengah peta", "trim|required", [
                'required' => "{field} belum diatur, silahkan gerakkan atau klik titik tertentu"
            ]);

            if ($validation->run() == false) {
                $msg = [
                    'csrf' => $csrf,
                    'error' => [
                        'nama_website' => form_error('nama_website'),
                        'deskripsi' => form_error('deskripsi'),
                        'zoom' => form_error('zoom'),
                    ],
                    'info' => !empty(form_error('center_map_lat')) ? pesan(form_error('center_map_lat'), "danger") : ""
                ];
            } else {
                $error_upload = false;

                // upload logo
                if (!empty($_FILES['logo']['name'])) {
                    $config['upload_path'] = './uploads/img/';
                    $config['allowed_types'] = 'jpg|png';
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('logo')) {
                        $error_upload = true;
                        // kirim pesan error
                        $msg = [
                            'csrf' => $csrf,
                            'error' => [],
                            'info' => pesan($this->upload->display_errors("<span>", "</span>"), "danger"),
                        ];
                    } else {
                        $postLogo = $this->upload->data();
                        // hapus logo lama
                        if (!empty($pengaturan['logo'] && file_exists("uploads/img/" . $pengaturan['logo']))) {
                            unlink("uploads/img/" . $pengaturan['logo']);
                        }
                    }
                }

                if ($error_upload === false) {

                    $data = [
                        'nama_website' => $this->input->post("nama_website"),
                        'deskripsi' => $this->input->post("deskripsi"),
                        'zoom' => $this->input->post("zoom"),
                        'center_map_lat' => $this->input->post("center_map_lat"),
                        'center_map_lng' => $this->input->post("center_map_lng"),
                        'logo' => isset($postLogo['file_name']) ? $postLogo['file_name'] : $pengaturan['logo'],
                    ];

                    $update = $this->db->where("id", $pengaturan_id)->update("tb_pengaturan", $data);

                    if ($update) {

                        $msg = [
                            "csrf" => $csrf,
                            "success" => [
                                "pesan" => "Pengaturan berhasil disimpan!",
                            ]
                        ];
                    } else {

                        $msg = [
                            "csrf" => $csrf,
                            "info" => "Pengaturan gagal disimpan, coba lakukan submit ulang",
                        ];
                    }
                }
            }
            echo json_encode($msg);
        }
    }
}
