<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends MY_Controller
{
    protected $role;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_berita', 'berita');
        logged_in();
    }


    public function index()
    {
        $per_page = '10'; #banyaknya data yang ditampilkan
        $total = $this->berita->getData()->num_rows(); #ambil semua total data berita

        $data = [
            'title' => "Data Berita",
            'pagin' => Pagin('backend/berita/index', $total, $per_page),
            'berita' => $this->berita->getData($per_page, Offset())->result_array(),
        ];

        $this->render("backend/v_berita_index", $data);
    }


    public function data($param = "")
    {
        $param = !empty($param) ? decode($param) : "";

        $data = [
            "title" => isset($param) ? "Update Data Berita" : "Tambah Data Berita",
            'data' => $this->berita->getDataID($param),
            'kategori' => $this->db->get("kategori_berita")->result_array()
        ];

        $this->render("backend/v_berita_data", $data);
    }

    public function save($param = "")
    {
        if ($this->input->is_ajax_request()) {

            $param = !empty($param) ? decode($param) : $param;
            $berita = $this->berita->getDataID($param);
            $csrf = csrf_hash();
            $validasiJudul = true;

            $validation = $this->form_validation;
            // jika data parameter ditemukan
            if ($param) {
                // set validasi menjadi false
                $validasiJudul = false;
                // jika update data, tetapi judul tidak sama dengan judul post maka lakukan validasi lagi
                if ($berita['judul'] != $this->input->post("judul")) {
                    $validasiJudul = true;
                }
            }
            if ($validasiJudul) {
                $validation->set_rules("judul", "Judul Berita", "trim|required|is_unique[berita.judul]", [
                    'is_unique' => "{field} telah digunakan!",
                    'required' => "{field} tidak boleh kosong"
                ]);
            }
            $validation->set_rules("id_kategori", "Kategori Berita", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);

            if ($validation->run() == false) {
                $msg = [
                    "csrf" => $csrf,
                    "error" => [
                        'judul' => form_error('judul'),
                        'id_kategori' => form_error('id_kategori'),
                        'gambar' => form_error('gambar'),
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
                            "error" => [
                                'judul' => form_error('judul'),
                                'id_kategori' => form_error('id_kategori'),
                                'gambar' => $this->upload->display_errors(),
                            ]
                        ];
                    } else {
                        $postgambar = $this->upload->data();
                        // hapus gambar lama
                        if (isset($berita['gambar'])) {
                            if (file_exists("uploads/img/" . $berita['gambar']) && ($berita['gambar'] != 'default.jpg')) {
                                unlink("uploads/img/" . $berita['gambar']);
                            }
                        }
                    }
                }

                if ($error_upload === false) {
                    $current_timestamp = current_timestamp();

                    $data = [
                        'judul' => $this->input->post("judul"),
                        'slug' => url_title($this->input->post('judul'), "-", true),
                        'id_kategori' => $this->input->post("id_kategori"),
                        'isi' => $this->input->post("isi"),
                        'gambar' => isset($postgambar['file_name']) ? $postgambar['file_name'] : "default.jpg",
                        "updated_at" => $current_timestamp,
                    ];

                    if ($berita) {
                        $data["gambar"] = isset($postgambar['file_name']) ? $postgambar['file_name'] : $berita['gambar'];
                        $query = $this->berita->updateDataID($data, $berita['id']);
                    } else {

                        $data['created_at'] = $current_timestamp;

                        $query = $this->db->insert("berita", $data);
                    }

                    if ($query) {
                        $msg = [
                            "success" => [
                                "pesan" => "Data Berita berhasil disimpan!",
                                "link" => base_url("backend/berita"),
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
            $berita = $this->berita->getDataID($id);

            if ($berita && $id) {
                // hapus gambar lama
                if (file_exists("uploads/img/" . $berita['gambar']) && ($berita['gambar'] != 'default.jpg')) {
                    unlink("uploads/img/" . $berita['gambar']);
                }

                $delete = $this->berita->deleteDataID($id);
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


    public function kategori()
    {
        $data = [
            'title' => "Data Kategori Berita",
            'kategori' => $this->db->order_by("id", "DESC")->get("kategori_berita")->result_array(),
        ];

        $this->render("backend/v_kategori_berita_index", $data);
    }


    public function kategori_save($param = "")
    {
        if ($this->input->is_ajax_request()) {

            $param = !empty($param) ? decode($param) : $param;
            $csrf = csrf_hash();

            $validation = $this->form_validation;

            $validation->set_rules("nama_kategori", "Nama Kategori", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);

            if ($validation->run() == false) {
                $msg = [
                    "csrf" => $csrf,
                    "error" => [
                        'nama_kategori' => form_error('nama_kategori'),
                    ]
                ];
            } else {

                $data = [
                    'nama_kategori' => $this->input->post("nama_kategori"),
                ];

                if ($param) {
                    $query = $this->berita->updateKategoriID($data, $param);
                } else {

                    $query = $this->db->insert("kategori_berita", $data);
                }

                if ($query) {
                    $msg = [
                        "success" => [
                            "pesan" => "Data Kategori berhasil disimpan!",
                            "link" => base_url("backend/berita/kategori"),
                        ]
                    ];
                } else {

                    $msg = [
                        "csrf" => $csrf,
                        "info" => "Data gagal disimpan, coba lakukan submit ulang",
                    ];
                }
            }

            echo json_encode($msg);
        }
    }


    public function kategori_delete($id)
    {
        $csrf = csrf_hash();
        if ($this->input->is_ajax_request()) {
            $id = decode($id);
            $kategori = $this->db->get_where("kategori_berita", ["id" => $id])->row_array();
            $berita = $this->db->get_where("berita", ["id_kategori" => $id])->row_array();
            if (!$berita) {

                if ($kategori && $id) {

                    $delete = $this->db->where("id", $id)->delete("kategori_berita");
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
                            "pesan" => "Data tidak ditemukan!"
                        ]
                    ];
                }
            } else {
                $msg = [
                    "csrf" => $csrf,
                    "error" => [
                        "pesan" => "Kategori telah digunakan!"
                    ]
                ];
            }

            echo json_encode($msg);
        }
    }




    // ================================
}
