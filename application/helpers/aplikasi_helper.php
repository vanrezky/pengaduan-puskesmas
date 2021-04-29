<?php

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

function helper_log($tipe = "", $str = "")
{

    $CI = &get_instance();

    if (strtolower($tipe) == "login") {
        $log_tipe   = 0;
    } elseif (strtolower($tipe) == "logout") {
        $log_tipe   = 1;
    } elseif (strtolower($tipe) == "add") {
        $log_tipe   = 2;
    } elseif (strtolower($tipe) == "edit") {
        $log_tipe  = 3;
    } elseif (strtolower($tipe) == "delete") {
        $log_tipe  = 4;
    } else {
        $log_tipe  = 5;
    }

    // paramter
    $param['log_user']      = $CI->session->userdata('id_user');
    $param['log_tipe']      = $log_tipe;
    $param['log_desc']      = $str;

    //load model log
    $CI->load->model('m_log');

    //save to database
    $CI->m_log->save_log($param);
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

function aktivitas($log_tipe)
{
    if ($log_tipe == '0') {

        echo "Login";
    } else if ($log_tipe == "1") {

        echo "Logout";
    } else if ($log_tipe == "2") {
        echo "Tambah Data";
    } else if ($log_tipe == "3") {
        echo "Update Data";
    } else if ($log_tipe == "4") {
        echo "Delete Data";
    } else {
        echo "belum diketahui";
    }
}

function role($id)
{
    if ($id == '1') {

        echo "Administrator";
    } else if ($id == "2") {

        echo "Petugas";
    }
}
