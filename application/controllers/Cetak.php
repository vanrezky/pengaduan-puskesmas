<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("m_pengaduan", "pengaduan");
        $this->load->library('pdf');
    }
    public function index($param = "")
    {
        $param = decode($param);
        if (isset($param['index'])) {
            if (method_exists($this, $param['index'])) {
                $name = $param['index'];
                unset($param["index"]);
                $this->$name($param);
            } else {
                show_404("Maaf, halaman tidak ditemukan!");
            }
        } else {
            show_404("Maaf, halaman tidak ditemukan!");
        }
    }
    private function generate($view = "", $data = [], $name = "")
    {
        // $this->load->view($view, $data);
        $this->pdf->load_view($view, $data);
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->render();
        $this->pdf->stream($name . ".pdf");
    }

    private function pengaduan($param = "")
    {
        $title = "Daftar Pengaduan Pasien Puskesmas Payung Sekaki";
        $tgl_mulai = isset($param['tgl_mulai']) ? $param['tgl_mulai'] : "";
        $tgl_akhir = isset($param['tgl_akhir']) ? $param['tgl_akhir'] : "";

        $data = [
            'title' => $title,
            'data' => $this->pengaduan->getData("", "", $tgl_mulai, $tgl_akhir)->result_array()
        ];

        $this->generate(
            "pdf/v_pdf_pengaduan",
            $data,
            $title,
            false,
        );
    }
}
