<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pengaturan', 'pengaturan');
        logged_in();
    }

    public function index()
    {

        $pengaturan = $this->pengaturan->getData()->row_array();

        $data = [
            'title' => "Data Pengaturan Website",
            'pengaturan' => $pengaturan,
        ];

        $this->render("backend/v_pengaturan_index", $data);
    }


    public function save()
    {
        if ($this->input->is_ajax_request()) {
            $pengaturan_id = 1;
            $pengaturan = $this->db->get_where("pengaturan", ["id" => $pengaturan_id])->row_array();
            $csrf = csrf_hash();

            $validation = $this->form_validation;
            $validation->set_rules("nama_website", "Nama Website", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("nama_singkat", "Nama Singkat", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);
            $validation->set_rules("semboyan", "Semboyan", "trim|required", [
                'required' => "{field} belum diatur, silahkan gerakkan atau klik titik tertentu"
            ]);
            $validation->set_rules("deskripsi", "Deskripsi Website", "trim|required", [
                'required' => "{field} tidak boleh kosong"
            ]);

            if ($validation->run() == false) {
                $msg = [
                    'csrf' => $csrf,
                    'error' => [
                        'nama_website' => form_error('nama_website'),
                        'nama_singkat' => form_error('nama_singkat'),
                        'semboyan' => form_error('semboyan'),
                        'deskripsi' => form_error('deskripsi'),

                    ],
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
                        'nama_singkat' => $this->input->post("nama_singkat"),
                        'semboyan' => $this->input->post("semboyan"),
                        'deskripsi' => $this->input->post("deskripsi"),
                        'logo' => isset($postLogo['file_name']) ? $postLogo['file_name'] : $pengaturan['logo'],
                    ];

                    $update = $this->db->where("id", $pengaturan_id)->update("pengaturan", $data);

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
