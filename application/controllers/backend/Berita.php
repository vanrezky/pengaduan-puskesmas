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
        $total = $this->berita->getData()->num_rows(); #ambil semua total data tps

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
            $pasien = $this->pasien->getDataID($param);
            $csrf = csrf_hash();

            $validation = $this->form_validation;
            if (!$param) {
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
                // $current_timestamp = current_timestamp();

                $data = [
                    'nama_pasien' => $this->input->post("nama_pasien"),
                    'jenis_kelamin' => $this->input->post("jenis_kelamin"),
                    'alamat' => $this->input->post("alamat"),
                    'telp' => $this->input->post("telp"),
                ];

                if ($param) {
                    $query = $this->pasien->updateDataID($data, $param);
                } else {

                    $data['kode_pasien'] = $this->input->post("kode_pasien");

                    $query = $this->db->insert("pasien", $data);
                }

                if ($query) {
                    $msg = [
                        "success" => [
                            "pesan" => "Data Pasien berhasil disimpan!",
                            "link" => base_url("backend/pasien"),
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

    public function delete($id)
    {
        $csrf = csrf_hash();
        if ($this->input->is_ajax_request()) {
            $id = decode($id);
            $pasien = $this->pasien->getDataID($id);

            if ($pasien && $id) {

                $delete = $this->pasien->deleteDataID($id);
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
