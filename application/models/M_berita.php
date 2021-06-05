<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_berita extends CI_Model
{

    public function getData($per_page = "", $offset = "", $id = "")
    {
        $this->db->select("berita.*, kategori_berita.nama_kategori");
        $this->db->join("kategori_berita", "berita.id_kategori = kategori_berita.id", "LEFT");
        $this->db->order_by("berita.id", "DESC");
        return $this->db->get('berita', $per_page, $offset);
    }

    public function getDataID($id)
    {
        $this->db->select("*");
        if (is_string($id)) {
            $this->db->where("berita.id", $id);
        }
        if (is_array($id)) {
            $this->db->where($id);
        }
        return $this->db->get("berita")->row_array();
    }

    public function deleteDataID($id)
    {
        $this->db->where("berita.id", $id);
        return $this->db->delete("berita");
    }

    public function updateDataID($data, $id)
    {
        $this->db->where("berita.id", $id);
        return $this->db->update("berita", $data);
    }


    public function updateKategoriID($data, $id)
    {
        $this->db->where("kategori_berita.id", $id);
        return $this->db->update("kategori_berita", $data);
    }
}
