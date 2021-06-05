<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pengaduan extends CI_Model
{

    public function getData($per_page = "", $offset = "", $id = "")
    {
        $this->db->select("pengaduan.*, kategori_pengaduan.nama_kategori");
        $this->db->join("kategori_pengaduan", "pengaduan.id_kategori = kategori_pengaduan.id", "LEFT");
        $this->db->order_by("pengaduan.id", "DESC");
        return $this->db->get('pengaduan', $per_page, $offset);
    }

    public function getDataID($id)
    {
        $this->db->select("*");
        if (is_string($id)) {
            $this->db->where("pengaduan.id", $id);
        }
        if (is_array($id)) {
            $this->db->where($id);
        }
        return $this->db->get("pengaduan")->row_array();
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
}
