<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kontak extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('KontakModel', 'kontakModel');
        logged_in();
    }


    public function index()
    {

        $per_page = '10'; #banyaknya data yang ditampilkan
        $total = $this->kontakModel->getData()->num_rows(); #ambil semua total data kontak

        $data = [
            'title' => "Data Kontak / Kritik",
            'pagin' => Pagin('admin/kontak/index', $total, $per_page),
            'kontak' => $this->kontakModel->getData($per_page, Offset())->result_array(),
        ];

        $this->render("admin/v_kontak_index", $data);
    }


    public function delete($id)
    {
        $csrf = csrf_hash();

        if ($this->input->is_ajax_request()) {
            $id = decode($id);
            $kontak = $this->kontakModel->getDataID($id);

            if ($kontak && $id) {

                $delete = $this->kontakModel->deleteData($id);
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
}
