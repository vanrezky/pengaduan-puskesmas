<?php

function Pagin($url = "", $total_rows = "0", $per_page = "10")
{

    $CI = &get_instance();
    $url_uri_segment = count(explode("/", $url)) + 1;
    $config["base_url"] = site_url($url);
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $per_page;
    $config["uri_segment"] = $url_uri_segment;

    // Membuat Style pagination untuk BootStrap v4
    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';
    // $config['attributes'] = array('class' => 'page-link');
    $CI->pagination->initialize($config);

    $pagin = "<div class='float-right mr-3'>" . $CI->pagination->create_links() . "</div>";

    $pagin = "<span> Total Records : " . ifUang($total_rows) . " Data</span>" . $pagin;

    return $pagin;
}

function PaginFrontend($url = "", $total_rows = "0", $per_page = "10")
{

    $CI = &get_instance();
    $url_uri_segment = count(explode("/", $url)) + 1;
    $config["base_url"] = site_url($url);
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $per_page;
    $config["uri_segment"] = $url_uri_segment;

    // Membuat Style pagination untuk BootStrap v4
    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class=""><nav class="blog-pagination justify-content-center d-flex"><ul class="pagination">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';
    // $config['attributes'] = array('class' => 'page-link');
    $CI->pagination->initialize($config);

    return $CI->pagination->create_links();
}

function Offset($param = "index", $number = "1")
{
    $CI = &get_instance();
    $prm = $CI->uri->uri_to_assoc($number);
    if (isset($prm["$param"])) {
        $offset = (int) $prm["$param"];
    } else {
        $offset = 0;
    }
    return $offset;
}

function ifUang($nominal = "")
{
    if (is_numeric($nominal)) {
        $panjang = strlen($nominal);
        $char    = str_split($nominal);
        $hasil   = "";
        $no = 0;
        for ($i = count($char) - 1; $i >= 0; $i--) {
            if ($no == 3) {
                $hasil .= ".";
                $no = 0;
            }
            $no++;
            $hasil .= $char[$i];
        }
        return strrev($hasil);
    } else {
        return $nominal;
    }
}

function csrf_field($id = "")
{
    $ci = get_instance();

    if (!empty($id)) {
        return "<input type='hidden' id='$id' name='" . $ci->security->get_csrf_token_name() . "' value='" . $ci->security->get_csrf_hash() . "'>";
    }

    return "<input type='hidden' name='" . $ci->security->get_csrf_token_name() . "' value='" . $ci->security->get_csrf_hash() . "'>";
}


function pesan($pesan, $status = "success")
{
    return "<div class='alert alert-$status' role='alert'>$pesan<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}

function current_timestamp()
{
    date_default_timezone_set("Asia/Jakarta");
    return date("Y-m-d H:i:s");
}

function logged_in()
{
    $CI = get_instance();

    if (!$CI->session->has_userdata("_user_login")) {
        redirect("auth");
    }
}

function tgl_jam_indo($tgl)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $jam = explode(" ", $tgl);
    $t = explode("-", $jam[0]);
    $j = explode(":", $jam[1]);
    return $t[2] . ' ' . $bulan[(int) $t[1]] . ' ' . $t[0] . ', ' . $j[0] . ':' . $j[1];
}

function d($var)
{
    echo '<pre>' . var_export($var, true) . '</pre>';
}

function dd($var)
{
    echo '<pre>' . var_export($var, true) . '</pre>';
    die;
}

function getMenu($role = "")
{

    $CI = get_instance();

    if ($role == "") {
        $role = $CI->session->userdata("_user_login")["role"];
    }

    $menu = $CI->db->select("menu_group.*, menu.nama_menu, menu.icon, menu.url")
        ->join('menu', 'menu_group.id_menu = menu.id', 'INNER')
        ->where("role", $role)
        ->order_by("urutan_menu", "ASC")
        ->get("menu_group")->result_array();

    $menu_array = [];
    foreach ($menu as $key => $value) {
        if ($value['parent_menu'] == 0) {
            $value['child'] = getChildGroupMenu($menu, $value['id_menu']);
            $menu_array[] = $value;
        }
    }

    return $menu_array;
}

function csrf_hash()
{
    $CI = get_instance();
    return $CI->security->get_csrf_hash();
}

function getPengaturanWebsite($field = "")
{
    $CI = get_instance();
    if ($field != "") {
        return $CI->db->where("id", 1)->get("pengaturan")->row()->$field;
    }

    return $CI->db->where("id", 1)->get("pengaturan")->row_array();
}

function getChildGroupMenu($var, $parent)
{
    $child = [];

    foreach ($var as $key => $value) {
        if ($value['parent_menu'] == $parent) {
            $child[] = $value;
        }
    }
    return $child;
}

function role_akses()
{
    return [
        'pimpinan',
        'petugas'
    ];
}

function status_pengaduan($status, $html = true)
{
    if ($html) {
        switch ($status) {
            case '1':
                $status = "<span class='badge badge-success'>Diterima & Selesai</span>";
                break;
            case '0':
                $status = "<span class='badge badge-danger'>Menunggu Konfirmasi</span>";
                break;
            default:
                $status = "<span class='badge badge-warning'>Menunggu Konfirmasi</span>";
                break;
        }
    } else {
        switch ($status) {
            case '1':
                $status = "Diterima & Selesai";
                break;
            case '0':
                $status = "Menunggu Konfirmasi";
                break;
            default:
                $status = "Menunggu Konfirmasi";
                break;
        }
    }


    return $status;
}

function getJenisKelamin()
{
    return [
        'pria',
        'wanita'
    ];
}
