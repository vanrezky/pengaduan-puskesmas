<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pengaduan extends CI_Model
{

    public function getData($per_page = "", $offset = "", $tgl_mulai = "", $tgl_selesai = "")
    {
        $this->db->select("pengaduan.*,pasien.kode_pasien, pasien.nama_pasien, pasien.jenis_kelamin, pasien.alamat, pasien.telp, pasien.email, kategori_pengaduan.nama_kategori");
        $this->db->join("kategori_pengaduan", "pengaduan.id_kategori = kategori_pengaduan.id", "LEFT");
        $this->db->join("pasien", "pengaduan.id_pasien = pasien.id", "LEFT");
        if ($tgl_mulai && $tgl_selesai) {
            $this->db->where('pengaduan.tgl_pengaduan >=', $tgl_mulai);
            $this->db->where('pengaduan.tgl_pengaduan <=', $tgl_selesai);
        }
        $this->db->order_by("pengaduan.id", "DESC");
        return $this->db->get('pengaduan', $per_page, $offset);
    }

    public function getDataID($id)
    {
        $this->db->select("pengaduan.*,pasien.kode_pasien, pasien.nama_pasien, pasien.jenis_kelamin, pasien.alamat, pasien.telp, pasien.email, kategori_pengaduan.nama_kategori");
        $this->db->join("kategori_pengaduan", "pengaduan.id_kategori = kategori_pengaduan.id", "LEFT");
        $this->db->join("pasien", "pengaduan.id_pasien = pasien.id", "LEFT");
        $this->db->where("pengaduan.id", $id);
        return $this->db->get('pengaduan')->row_array();
    }

    public function deleteDataID($id)
    {
        $this->db->where("pengaduan.id", $id);
        return $this->db->delete("pengaduan");
    }

    public function updateDataID($data, $id)
    {
        $this->db->where("pengaduan.id", $id);
        return $this->db->update("pengaduan", $data);
    }


    public function updateKategoriID($data, $id)
    {
        $this->db->where("kategori_pengaduan.id", $id);
        return $this->db->update("kategori_pengaduan", $data);
    }

    public function getDataLatest()
    {
        $this->db->select("pengaduan.*,pasien.kode_pasien, pasien.nama_pasien, pasien.jenis_kelamin, pasien.alamat, pasien.telp, pasien.email, kategori_pengaduan.nama_kategori");
        $this->db->join("kategori_pengaduan", "pengaduan.id_kategori = kategori_pengaduan.id", "LEFT");
        $this->db->join("pasien", "pengaduan.id_pasien = pasien.id", "LEFT");
        $this->db->order_by("pengaduan.id", "DESC");
        $this->db->limit("10");
        return $this->db->get('pengaduan')->result_array();
    }

    public function getDataKode($kode)
    {
        $this->db->select("pengaduan.*,pasien.kode_pasien, pasien.nama_pasien, pasien.jenis_kelamin, pasien.alamat, pasien.telp, pasien.email, kategori_pengaduan.nama_kategori");
        $this->db->join("kategori_pengaduan", "pengaduan.id_kategori = kategori_pengaduan.id", "LEFT");
        $this->db->join("pasien", "pengaduan.id_pasien = pasien.id", "LEFT");
        $this->db->where("pasien.kode_pasien", $kode);
        $this->db->order_by("pengaduan.id", "DESC");
        return $this->db->get('pengaduan')->result_array();
    }
}
