<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pengaduan', 'pengaduan');
        logged_in();
    }


    public function index()
    {
        $tgl_mulai = $this->input->get("tgl_mulai");
        $tgl_akhir = $this->input->get("tgl_akhir");

        $data = [
            'title' => "Laporan Pengaduan Pasien",
            'pengaduan' => $this->pengaduan->getData("", "", $tgl_mulai, $tgl_akhir)->result_array(),
            'filter' => [
                'tgl_mulai' => $tgl_mulai,
                'tgl_akhir' => $tgl_akhir,
            ]
        ];

        $this->render("backend/v_laporan_index", $data);
    }
}
