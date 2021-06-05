<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	protected $center;
	public function __construct()
	{
		parent::__construct();
		$this->load->model("m_pengaduan", "pengaduan");
		logged_in();
	}


	public function index()
	{

		$D = $this->db->select("COUNT(pengaduan.id) as pengaduan, (
			SELECT COUNT(berita.id) from berita
		) berita,(
			SELECT COUNT(pasien.id) from pasien
		) pasien,(
			SELECT COUNT(user.id) from user
		) user")->get('pengaduan')->row_array();

		$data = [
			'title' => 'Dashboard',
			'data' => $D,
			'pengaduanLatest' => $this->pengaduan->getDataLatest()
		];

		$this->render('backend/v_dashboard_index', $data);
	}
}
