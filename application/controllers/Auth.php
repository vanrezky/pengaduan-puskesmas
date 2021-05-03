<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->has_userdata("_user_login")) {
            $role = $this->session->userdata("_user_login")['role'];
            redirect("$role/dashboard");
        }

        $data = [
            'setting' => $this->db->get('tb_pengaturan')->row_array()
        ];

        $this->load->view('auth/v_auth_index', $data);
    }

    public function check()
    {

        if ($this->input->is_ajax_request()) {
            $csrf = csrf_hash();

            $validation = $this->form_validation;
            $validation->set_rules("username", "Username", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("password", "Password", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);

            if ($validation->run() == false) {
                $msg = [
                    'csrf' => $csrf,
                    'error' => [
                        'username' => form_error("username"),
                        'password' => form_error("password"),
                    ]
                ];
            } else {
                // ambil data user berdasarkan username
                $user = $this->db->get_where("tb_user", ['username' => $this->input->post("username")])->row_array();

                // jika user ditemukan (true)
                if ($user) {

                    // jik password yang di input sama dengan password di database
                    if (password_verify($this->input->post("password"), $user['password'])) {

                        // buat session
                        $session = [
                            'username' => $user['username'],
                            'nama' => $user['nama'],
                            'role' => $user['role'],
                        ];
                        // set session
                        $this->session->set_userdata("_user_login", $session);

                        //  data update last login user
                        $update = [
                            'last_login' => current_timestamp()
                        ];

                        // update las login
                        $this->db->where("username", $this->input->post("username"))->update("tb_user", $update);

                        // kirim pesan ke view
                        $msg = [
                            'success' => [
                                'pesan' => "Anda berhasil login!",
                                "url" => base_url("$user[role]/dashboard")
                            ]
                        ];
                    } else { // jika  password tidak cocok 

                        // kirim pesan ke view
                        $msg = [
                            'csrf' => $csrf,
                            'error' => [
                                'info' => pesan("Username atau password salah!", "danger")
                            ]
                        ];
                    }
                } else { // jika user tidak ditemukan (false)

                    // kirim pesan ke view
                    $msg = [
                        'csrf' => $csrf,
                        'error' => [
                            'info' => pesan("Username atau password salah!", "danger")
                        ]
                    ];
                }
            }

            echo json_encode($msg);
        }
    }


    public function logout()
    {
        $this->session->unset_userdata("_user_login");
        redirect("auth");
    }
}
