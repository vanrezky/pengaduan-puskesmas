<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel', 'userModel');
        logged_in();
    }

    public function index()
    {

        $per_page = '10'; #banyaknya data yang ditampilkan
        $total = $this->userModel->getData()->num_rows(); #ambil semua data user

        $data = [
            'title' => "Data Pengguna (User)",
            'pagin' => Pagin('admin/pengguna/index', $total, $per_page),
            'pengguna' => $this->userModel->getData($per_page, Offset())->result_array(),
        ];

        $this->render('admin/v_user_index', $data);
    }

    public function data($id = "")
    {
        $id = decode($id);

        $data = [
            "title" => isset($id) ? "Update Pengguna" : "Tambah Pengguna",
            "pengguna" => $this->userModel->getDataID($id),
        ];

        $this->render("admin/v_user_data", $data);
    }


    public function save($id = "")
    {
        if ($this->input->is_ajax_request()) {

            $id = !empty($id) ? decode($id) : $id;
            $user = $this->userModel->getDataID($id);
            $csrf = csrf_hash();

            $validation = $this->form_validation;
            $validation->set_rules("nama", "Nama Pengguna", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);

            $validation->set_rules("role", "Role Akses", "trim|required", [
                'required' => "{field} tidak boleh kosong",
            ]);

            if (!$user or !empty($this->input->post("password"))) {

                $validation->set_rules("password", "Password", "trim|required|min_length[3]", [
                    'required' => "{field} tidak boleh kosong",
                    'min_length' => "{field} harus memiliki minimal 3 karakter"
                ]);
                $validation->set_rules("password2", "Konfirmasi Password", "trim|required|matches[password]", [
                    'required' => "{field} tidak boleh kosong",
                    'matches' => "{field} tidak cocok dengan {param}"
                ]);
            }

            // set validasi jika perintah berupa insert
            if (!$user) {

                $validation->set_rules("username", "Username", "trim|required|is_unique[tb_user.username]", [
                    'required' => "{field} tidak boleh kosong",
                    'is_unique' => "{field} sudah digunakan!"
                ]);
            }

            if ($validation->run() == false) {
                $msg = [
                    'csrf' => $csrf,
                    'error' => [
                        'nama' => form_error('nama'),
                        'username' => form_error('username'),
                        'password' => form_error('password'),
                        'password2' => form_error('password2'),
                        'role' => form_error('role'),
                    ]
                ];
            } else {

                $data = [
                    'nama' => $this->input->post("nama"),
                    'role' => $this->input->post("role"),
                    'updated_at' => current_timestamp()
                ];

                if (!$user) {
                    $data['username'] = $this->input->post("username");
                    $data['password'] = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
                    $data['created_at'] = current_timestamp();

                    $query = $this->db->insert("tb_user", $data);
                } else {
                    if (!empty($this->input->post("password"))) {
                        $data['password'] = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
                    }
                    $query = $this->db->where("id_user", $user['id_user'])->update("tb_user", $data);
                }

                if ($query) {
                    $msg = [
                        'success' => [
                            'pesan' => 'Pengguna berhasil ditambahkan!',
                            'link' => base_url("admin/pengguna")
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
}
