<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tps extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('googlemaps'));
        $this->load->model('TpsModel', 'tpsModel');
        $this->load->model('JenistpsModel', 'jenistpsModel');
        $this->load->library('image_lib'); #load library image
        logged_in();
    }


    public function index()
    {

        $per_page = '10'; #banyaknya data yang ditampilkan
        $total = $this->tpsModel->getData()->num_rows(); #ambil semua total data tps

        $data = [
            'title' => "Data TPS",
            'pagin' => Pagin('admin/tps/index', $total, $per_page),
            'tps' => $this->tpsModel->getData($per_page, Offset())->result_array(),
        ];

        $this->render("admin/v_tps_index", $data);
    }


    public function data($param = "")
    {
        $param = !empty($param) ? decode($param) : "";

        $config = [
            'map_div_id' => "map-add",
            'map_height' => "600px",
            'center' => (!empty($lat) && !empty($lng)) ? $lat . "," . $lng : '0.5333593798115907,101.43400637930908',
            'zoom' => !empty($pengaturan['zoom']) ? $pengaturan['zoom'] : "12",
            'onclick' => "newLocationClick(event.latLng.lat(), event.latLng.lng());",
            'disableStreetViewControl' => true
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
            "title" => isset($param) ? "Update Data TPS" : "Tambah Data TPS",
            'map' => $this->googlemaps->create_map(),
            'tps' => $this->tpsModel->getDataID($param),
            'jenistps' => $this->db->get("tb_jenistps")->result_array()
        ];

        $this->render("admin/v_tps_data", $data);
    }

    public function save($param = "")
    {
        if ($this->input->is_ajax_request()) {

            $param = !empty($param) ? decode($param) : $param;
            $tps = $this->tpsModel->getDataID($param);
            $csrf = csrf_hash();

            $validation = $this->form_validation;
            $validation->set_rules("nama_tps", "Nama TPS", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("alamat", "Alamat TPS", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("id_jenistps", "Jenis TPS", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("telp", "Telp", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("lat", "Latitude", "trim|required", [
                'required' => "{field} belum diatur, silahkan gerakkan marker atau klik titik tertentu"
            ]);
            $validation->set_rules("lng", "Longitude", "trim|required", [
                'required' => "{field} belum diatur, silahkan gerakkan marker atau klik titik tertentu"
            ]);

            if ($validation->run() == false) {
                $msg = [
                    "csrf" => $csrf,
                    "error" => [
                        'nama_tps' => form_error('nama_tps'),
                        'alamat' => form_error('alamat'),
                        'id_jenistps' => form_error('id_jenistps'),
                        'telp' => form_error('telp'),
                        'lat' => form_error('lat'),
                        'lng' => form_error('lng'),
                    ]
                ];
            } else {

                $error_upload = false;

                if (!empty($_FILES['gambar']['name'])) {
                    $config['upload_path'] = './uploads/img/';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('gambar')) {
                        $error_upload = true;
                        // kirim pesan error
                        $msg = [
                            'csrf' => $csrf,
                            'error' => [
                                'nama_tps' => form_error('nama_tps'),
                                'alamat' => form_error('alamat'),
                                'id_jenistps' => form_error('id_jenistps'),
                                'telp' => form_error('telp'),
                                'lat' => form_error('lat'),
                                'lng' => form_error('lng'),
                                "gambar" => $this->upload->display_errors(),
                            ],
                        ];
                    } else {
                        $postgambar = $this->upload->data();

                        // hapus gambar lama
                        if (isset($tps['gambar'])) {
                            if (file_exists("uploads/img/" . $tps['gambar']) && ($tps['gambar'] != 'default.jpg')) {
                                unlink("uploads/img/" . $tps['gambar']);
                            }
                        }
                    }
                }


                if ($error_upload === false) {
                    $current_timestamp = current_timestamp();

                    $data = [
                        'id_jenistps' => $this->input->post("id_jenistps"),
                        'nama_tps' => $this->input->post("nama_tps"),
                        'keterangan' => $this->input->post("keterangan"),
                        'alamat' => $this->input->post("alamat"),
                        'telp' => $this->input->post("telp"),
                        'lat' => $this->input->post("lat"),
                        'lng' => $this->input->post("lng"),
                        'gambar' => isset($postgambar['file_name']) ? $postgambar['file_name'] : "default.jpg",
                        "updated_at" => $current_timestamp,
                    ];

                    if ($tps) {
                        $data["gambar"] = isset($postgambar['file_name']) ? $postgambar['file_name'] : $tps['gambar'];

                        $query = $this->db->where("id_tps", $tps['id_tps'])->update("tb_tps", $data);
                    } else {

                        $data['created_at'] = $current_timestamp;

                        $query = $this->db->insert("tb_tps", $data);
                    }

                    if ($query) {
                        $msg = [
                            "success" => [
                                "pesan" => "Data TPS berhasil disimpan!",
                                "link" => base_url("admin/tps"),
                            ]
                        ];
                    } else {

                        $msg = [
                            "csrf" => $csrf,
                            "info" => "Data gagal disimpan, coba lakukan submit ulang",
                        ];
                    }
                }
            }

            echo json_encode($msg);
        }
    }

    public function delete($id)
    {
        $csrf = csrf_hash();
        if ($this->input->is_ajax_request()) {
            $id = decode($id);
            $tps = $this->tpsModel->getDataID($id);

            if ($tps && $id) {
                // hapus gambar lama
                if (file_exists("uploads/img/" . $tps['gambar']) && ($tps['gambar'] != 'default.jpg')) {
                    unlink("uploads/img/" . $tps['gambar']);
                }

                $delete = $this->tpsModel->deleteData($id);
                if ($delete) {
                    $msg = [
                        "csrf" => $csrf,
                        "success" => [
                            "pesan" => "Data Berhasil dihapus!"
                        ]
                    ];
                } else {

                    $msg = [
                        "csrf" => $csrf,
                        "error" => [
                            "pesan" => "Data gagal dihapus!"
                        ]
                    ];
                }
            } else {
                $msg = [
                    "csrf" => $csrf,
                    "error" => [
                        "pesan" => "Data tidak ditemukan!.."
                    ]
                ];
            }

            echo json_encode($msg);
        }
    }

    public function jenis()
    {

        $per_page = '10'; #banyaknya data yang ditampilkan
        $total = $this->jenistpsModel->getData(); #ambil semua data produk

        $data = [
            'title' => "Data Jenis TPS",
            'pagin' => Pagin('admin/tps/jenis', $total->num_rows(), $per_page),
            'jenistps' => $this->jenistpsModel->getData($per_page, Offset())->result_array(),
        ];

        $this->render("admin/v_jenistps_index", $data);
    }


    public function jenisSave($id = "")
    {

        if ($this->input->is_ajax_request()) {
            $id = $id != "" ? decode($id) : "";
            $jenistps = $this->jenistpsModel->getDataID($id);
            $csrf = csrf_hash();
            $validation = $this->form_validation;

            $validation->set_rules("nama_jenistps", "Nama Jenis TPS", "trim|required", [
                'required' => '{field} tidak boleh kosong!'
            ]);

            if ($validation->run() == false) {
                $msg = [
                    'csrf' => $csrf,
                    'error' => [
                        'nama_jenistps' => form_error('nama_jenistps'),
                        'marker' => '',
                    ]
                ];
            } else {

                $error_upload = false;

                if (!empty($_FILES['marker']['name'])) {
                    $config['upload_path'] = './uploads/img/';
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['encrypt_name'] = TRUE;

                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('marker')) {
                        $error_upload = true;

                        // kirim pesan error
                        $msg = [
                            'csrf' => $csrf,
                            'error' => [
                                'nama_jenistps' => "",
                                "marker" => $this->upload->display_errors("<span>", "</span>"),
                            ],
                        ];
                    } else {
                        $postmarker = $this->upload->data();


                        $config['image_library'] = 'GD2';
                        $config['source_image'] = 'uploads/img/' . $postmarker['file_name'];
                        $config['maintain_ratio'] = FALSE;
                        $config['width'] = 32;
                        $config['height'] = 32;
                        $config['new_image'] = 'uploads/img/thumbs/' . $postmarker['file_name'];
                        $this->load->library('image_lib', $config);

                        if (!$this->image_lib->resize()) {
                            $error_upload = true;

                            // kirim pesan error
                            $msg = [
                                'csrf' => $csrf,
                                'error' => [
                                    'nama_jenistps' => "",
                                    "marker" => $this->upload->display_errors("<span>", "</span>"),
                                ],
                            ];
                        } else {
                            // hapus marker lama
                            if (isset($tps['marker'])) {
                                if (file_exists("uploads/img/" . $tps['marker']) && ($tps['marker'] != 'default_marker.jpg')) {
                                    unlink("uploads/img/" . $tps['marker']);
                                }
                            }
                        }
                    }
                }

                if ($error_upload === false) {
                    $data = [
                        'nama_jenistps' => $this->input->post("nama_jenistps"),
                        'marker' => isset($postmarker['file_name']) ? $postmarker['file_name'] : "default_marker.png",
                    ];

                    if ($jenistps) {
                        $data["marker"] = isset($postmarker['file_name']) ? $postmarker['file_name'] : $jenistps['marker'];
                        $query = $this->db->where("id_jenistps", $jenistps['id_jenistps'])->update("tb_jenistps", $data);
                    } else {
                        $query = $this->db->insert("tb_jenistps", $data);
                    }

                    if ($query) {
                        $msg = [
                            "success" => [
                                "pesan" => "Data Jenis TPS berhasil disimpan!",
                                "link" => base_url("admin/tps/jenis"),
                            ]
                        ];
                    } else {

                        $msg = [
                            "csrf" => $csrf,
                            "info" => "Data gagal disimpan, coba lakukan submit ulang",
                        ];
                    }
                }
            }
            echo json_encode($msg);
        }
    }

    public function jenisGet($id)
    {
        if ($this->input->is_ajax_request()) {
            $id = decode($id);

            $error = [
                'error' => [
                    'pesan' => "Maaf, data tidak ditemukan!"
                ]
            ];

            if ($id) {
                $jenis = $this->jenistpsModel->getDataID($id);

                if ($jenis) {
                    $msg = [
                        "success" => "Data berhasil ditemukan!",
                        "data" => $jenis
                    ];
                } else {
                    $msg = $error;
                }
            } else {
                $msg = $error;
            }

            echo json_encode($msg);
        }
    }

    public function jenisDelete($id)
    {
        if ($this->input->is_ajax_request()) {

            $id = decode($id);
            $csrf = csrf_hash();

            if ($id) {
                $jenis = $this->jenistpsModel->getDataID($id);
                $used = $this->tpsModel->getDataID(["tp.id_jenistps" => $id]);
                if (empty($used)) {

                    if (isset($jenis['marker'])) {
                        if (file_exists("uploads/img/" . $jenis['marker']) && ($jenis['marker'] != 'default_marker.jpg') && ($jenis['marker'] != 'default.jpg')) {
                            unlink("uploads/img/" . $jenis['marker']);
                        }
                    }

                    $delete = $this->db->where("id_jenistps", $id)->delete("tb_jenistps");

                    $msg = [
                        'success' => [
                            'pesan' => "Data berhasil dihapus!"
                        ]
                    ];
                } else {


                    $msg = [
                        'csrf' => $csrf,
                        'error' => [
                            'pesan' => "Maaf, data sudah digunakan pada kategori tps!"
                        ]
                    ];
                }
            } else {

                $msg = [
                    'csrf' => $csrf,
                    'error' => [
                        'pesan' => "Maaf, data tidak ditemukan!"
                    ]
                ];
            }

            echo json_encode($msg);
        }
    }





    // ================================
}
