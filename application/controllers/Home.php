<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("m_berita", "berita");
        $this->load->model("m_pasien", "pasien");
        $this->load->model("m_pengaduan", "pengaduan");
        $this->load->helper("tema_helper");
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'latest' => $this->berita->getLastest(),
        ];

        $this->view('home/v_home_index', $data, true);
    }

    public function berita()
    {

        $search = str_replace("+", " ", $this->input->get("s"));

        $per_page = '4'; #banyaknya data yang ditampilkan
        $total = $this->berita->getData("", "", $search)->num_rows(); #ambil semua total data tps

        $data = [
            'title' => "Daftar Berita",
            'pagin' => PaginFrontend('berita', $total, $per_page),
            'berita' => $this->berita->getData($per_page, Offset('berita', 1), $search)->result_array(),
            'lastest' => $this->berita->getLastest(5),
            'search' => $search,
        ];

        $this->view('home/v_home_berita', $data);
    }


    public function beritaSingle($slug = "")
    {
        $berita = $this->berita->getDataSlug($slug);
        $data = [
            'title' => $berita['judul'],
            'berita' => $berita,
            'lastest' => $this->berita->getLastest(5),
        ];

        $this->view('home/v_home_berita_single', $data);
    }


    public function pengaduan()
    {

        if ($this->input->is_ajax_request()) {

            if (strlen($this->input->get("pasien")) > 2) {
                $msg = ["success" => false, "pesan" => "Maaf, kode pasien tidak ditemukan, silahkan hubungi pihak Puskesmas"];

                $pasien = $this->pasien->getDataKode($this->input->get("pasien"));

                if ($pasien) {
                    $msg = ["success" => true, "pesan" => "Data ditemukan..", "data" => $pasien];
                }
            }

            echo json_encode($msg);
            exit();
        } else {

            $data = [
                'title' => "Ajukan Pengaduan",
                'kategori' => $this->db->get("kategori_pengaduan")->result_array()
            ];

            $this->view("home/v_home_pengaduan", $data);
        }
    }


    public function pengaduan_save()
    {

        if ($this->input->is_ajax_request()) {
            $msg = ["success" => false, "pesan" => "Terjadi kesalahan, silahkan refresh halaman!"];
            $pasien = $this->pasien->getDataKode($this->input->post("kode_pasien"));

            if ($pasien) {

                $data = [
                    'id_pasien' => $pasien['id'],
                    'id_kategori' => $this->input->post("id_kategori"),
                    'pengaduan' => $this->input->post("pengaduan"),
                    'status' => 0,
                    'tgl_pengaduan' => current_timestamp()

                ];

                $this->db->insert("pengaduan", $data);

                $msg = ["success" => true, "pesan" => "Pengaduan berhasil dikirim, terimakasih.."];
            }

            echo json_encode($msg);
        }
    }

    public function pengaduan_cek()
    {
        $kode = $this->input->get("kode_pasien");
        $data = [
            'title' => "Cek Pengaduan",
            'data' => $this->pengaduan->getDataKode($kode),
            'kode' => $kode,
        ];

        $this->view("home/v_home_pengaduan_cek", $data);
    }
}
