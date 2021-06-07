<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaduan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pengaduan', 'pengaduan');
        logged_in();
    }


    public function index()
    {

        $per_page = '10'; #banyaknya data yang ditampilkan
        $total = $this->pengaduan->getData()->num_rows(); #ambil semua total data pengaduan

        $data = [
            'title' => "Data Pengaduan Pasien",
            'pagin' => Pagin('backend/pengaduan/index', $total, $per_page),
            'pengaduan' => $this->pengaduan->getData($per_page, Offset())->result_array(),
        ];

        $this->render("backend/v_pengaduan_index", $data);
    }

    public function lihat($id = "")
    {

        $id = decode($id);

        if ($id) {
            $pengaduan = $this->pengaduan->getDataID($id);

            $data = [
                'title' => "Data Pengaduan, Pasien " . $pengaduan['kode_pasien'],
                'pengaduan' => $pengaduan,
                'status' => ['Menunggu Konfirmasi', 'Diterima & Selesai'],
            ];

            $this->render("backend/v_pengaduan_lihat", $data);
        } else {
            show_404();
        }
    }

    public function save($id = "")
    {

        $id = decode($id);

        if ($id) {

            $csrf = csrf_hash();
            $data = [
                "status" => $this->input->post("status"),
            ];

            $update = $this->pengaduan->updateDataID($data, $id);

            if ($update) {
                $data = $this->pengaduan->getDataID($id);

                $msg = [
                    'success' => true,
                    'pesan' => 'Pengaduan berhasil dikonfirmasi!',
                    'csrf' => $csrf,
                ];
                if (!empty($data['email'])) {
                    if (!$this->_sendEmail($data)) {
                        $msg = [
                            'success' => false,
                            'pesan' => 'Terjadi kesalahan!!, email tidak dapat dikirim..',
                            'csrf' => $csrf,
                        ];
                    }
                }
            } else {
                $msg = [
                    'success' => false,
                    'pesan' => 'Opps... silahkan perintah tidak diketahui.',
                    'csrf' => $csrf,
                ];
            }

            echo json_encode($msg);
            exit();
        } else {
            show_404();
        }
    }

    private function _sendEmail($data)
    {

        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => '26desiiranatal@gmail.com',
            'smtp_pass' => 'Qwe123asd123..',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library("email", $config);

        $this->email->from("26desiiranatal@gmail.com", "Pengaduan Puskesmas Payung Sekaki");
        $this->email->to($data['email']);
        $this->email->subject("Konfirmasi Pengaduan Puskesmas Payung Sekaki");
        $this->email->message("Pengaduan anda yaitu: <br/><br/> kategori: $data[nama_kategori] <br/> Isi: $data[pengaduan] <br/><br/><br/> <b>Sudah berstatus: " . status_pengaduan($data['status']) . "</b>");

        if ($this->email->send()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $csrf = csrf_hash();

        if ($this->input->is_ajax_request()) {
            $id = decode($id);
            $pengaduan = $this->pengaduan->getDataID($id);

            if ($pengaduan && $id) {

                $delete = $this->pengaduan->deleteData($id);
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
            'title' => "Data Kategori Pengaduan",
            'kategori' => $this->db->order_by("id", "DESC")->get("kategori_pengaduan")->result_array(),
        ];

        $this->render("backend/v_kategori_pengaduan_index", $data);
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
                    $query = $this->pengaduan->updateKategoriID($data, $param);
                } else {

                    $query = $this->db->insert("kategori_pengaduan", $data);
                }

                if ($query) {
                    $msg = [
                        "success" => [
                            "pesan" => "Data Kategori berhasil disimpan!",
                            "link" => base_url("backend/pengaduan/kategori"),
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
            $kategori = $this->db->get_where("kategori_pengaduan", ["id" => $id])->row_array();
            $pengaduan = $this->db->get_where("pengaduan", ["id_kategori" => $id])->row_array();
            if (!$pengaduan) {

                if ($kategori && $id) {

                    $delete = $this->db->where("id", $id)->delete("kategori_pengaduan");
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
}
