<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	protected $center;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('tpsModel');
		$this->load->library('googlemaps');
		$this->center = getPengaturanWebsite("center_map_lat") . ',' . getPengaturanWebsite("center_map_lng");

		logged_in();
	}


	public function index()
	{

		$D = $this->db->select("COUNT(id_tps) as tps, (
			SELECT COUNT(id_jenistps) from tb_jenistps
		) jenistps,(
			SELECT COUNT(id_kontak) from tb_kontak
		) kontak,(
			SELECT COUNT(id_user) from tb_user
		) user")->get('tb_tps')->row_array();


		// $globalSettingMarker = "icon:{url:'" . base_url("assets/img/icon/me.png") . "'}, animation: google.maps.Animation.BOUNCE";
		// ambil semua tps
		$tps = $this->tpsModel->getData()->result_array();


		$config['center'] = $this->center;
		$config['zoom'] = 'auto';
		// $config['places'] = TRUE;
		// $config['disableStreetViewControl'] = true;
		// $config['onclick'] = "mapClicked({ map: map, position:event.latLng, $globalSettingMarker});";
		// $config['placesAutocompleteInputID'] = 'myPlaceTextBox';
		// $config['placesAutocompleteBoundsMap'] = TRUE; // set results biased towards the maps viewport
		// $config['placesAutocompleteOnChange'] = "mapGeometry({ map: map, position:placesAutocomplete.getPlace().geometry.location, $globalSettingMarker});";

		$this->googlemaps->initialize($config);
		$HTML = "";
		foreach ($tps as $value) {
			$gambar = 'default.jpg';
			if (!empty($value['gambar']))
				$gambar = base_url("uploads/img/" . $value['gambar']);


			$HTML .= "<div class='media'>";
			$HTML .= "<div class='media-left'>";
			$HTML .= "<img src='$gambar' class='media-object' style='width:150px;'>";
			$HTML .= "</div>";
			$HTML .= "<div class='media-body'>";
			$HTML .= "<h4>$value[nama_tps]</h4>";
			$HTML .= "<ol>";
			$HTML .= "<li>ALamat, $value[alamat]</li>";
			$HTML .= "<li>No Telp, $value[telp]</li>";
			$HTML .= "</ol>";
			$HTML .= "</div>";
			$HTML .= "</div>";

			$marker = array();
			$marker['position'] = "$value[lat],$value[lng]";
			$marker['title'] = $value['nama_tps'];
			$marker['infowindow_content'] = $HTML;
			$HTML = "";


			$marker['icon'] = base_url("uploads/img/" . $value['marker']);
			$this->googlemaps->add_marker($marker);
		}



		$data = [
			'title' => 'Dashboard',
			'data' => $D,
			'map' => $this->googlemaps->create_map(),
		];
		$this->render('admin/v_dashboard_index', $data);
	}

	public function cetak_laporan()
	{

		if ($this->session->userdata('logged_in') != "" && $this->session->userdata('id_role') == "1") {

			$data = array();
			$data['cetak_laporan'] = $this->m_dashboard->all_costumer();

			$this->load->library('pdf');
			$this->pdf->load_view('cetak_laporan', $data);
			$this->pdf->setPaper('A4', 'portrait');
			$this->pdf->render();
			$this->pdf->stream("Cetak Laporan.pdf");
		} else {
			redirect('login/logout');
		}
	}
}
