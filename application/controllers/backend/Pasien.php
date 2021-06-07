<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends MY_Controller
{
    protected $role;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pasien', 'pasien');
        logged_in();
    }


    public function index()
    {

        $per_page = '10'; #banyaknya data yang ditampilkan
        $total = $this->pasien->getData()->num_rows(); #ambil semua total data tps

        $data = [
            'title' => "Data Pasien",
            'pagin' => Pagin('backend/pasien/index', $total, $per_page),
            'pasien' => $this->pasien->getData($per_page, Offset())->result_array(),
        ];

        $this->render("backend/v_pasien_index", $data);
    }


    public function data($param = "")
    {
        $param = !empty($param) ? decode($param) : "";

        $data = [
            "title" => isset($param) ? "Update Data TPS" : "Tambah Data TPS",
            'data' => $this->pasien->getDataID($param),
        ];

        $this->render("backend/v_pasien_data", $data);
    }

    public function save($param = "")
    {
        if ($this->input->is_ajax_request()) {

            $param = !empty($param) ? decode($param) : $param;
            $pasien = $this->pasien->getDataID($param);
            $csrf = csrf_hash();

            $validation = $this->form_validation;
            if (!$param) {
                $validation->set_rules("kode_pasien", "Kode Pasien", "trim|required|is_unique[pasien.kode_pasien]", [
                    'is_unique' => "{field} telah digunakan!",
                    'required' => "{field} tidak boleh kosong"
                ]);
            }
            $validation->set_rules("nama_pasien", "Nama Pasien", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("alamat", "Alamat", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("jenis_kelamin", "Jenis Kelamin", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("telp", "Telp", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("email", "Email", "trim|valid_email", [
                'valid_email' => "{field} tidak valid"
            ]);

            if ($validation->run() == false) {
                $msg = [
                    "csrf" => $csrf,
                    "error" => [
                        'kode_pasien' => form_error('kode_pasien'),
                        'nama_pasien' => form_error('nama_pasien'),
                        'alamat' => form_error('alamat'),
                        'jenis_kelamin' => form_error('jenis_kelamin'),
                        'telp' => form_error('telp'),
                        'email' => form_error("email"),
                    ]
                ];
            } else {
                // $current_timestamp = current_timestamp();

                $data = [
                    'nama_pasien' => $this->input->post("nama_pasien"),
                    'jenis_kelamin' => $this->input->post("jenis_kelamin"),
                    'alamat' => $this->input->post("alamat"),
                    'telp' => $this->input->post("telp"),
                    'email' => $this->input->post("email"),
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

    public function update($id = "")
    {
        // jika id tidak kosong
        $D = [];
        if ($id == "") {

            $D = $this->db->get_where("user", ["id" => $id])->get_row_array();
        }

        $this->db->where("id", $id);

        $data = [
            'data' => $D
        ];

        $this->load->view("backend/datauser/datauser_edit", $data);
    }




    // ================================
}
