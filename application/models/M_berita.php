<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_berita extends CI_Model
{

    public function getData($per_page = "", $offset = "", $search = "")
    {
        $this->db->select("berita.*, kategori_berita.nama_kategori");
        $this->db->join("kategori_berita", "berita.id_kategori = kategori_berita.id", "LEFT");
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("berita.judul", $search, "both");
            $this->db->or_like("berita.isi", $search, "both");
            $this->db->or_like("kategori_berita.nama_kategori", $search, "both");
            $this->db->group_end();
        }
        $this->db->order_by("berita.id", "DESC");
        return $this->db->get('berita', $per_page, $offset);
    }


    public function getDataSlug($slug)
    {
        $this->db->select("berita.*, kategori_berita.nama_kategori");
        $this->db->join("kategori_berita", "berita.id_kategori = kategori_berita.id", "LEFT");
        $this->db->order_by("berita.id", "DESC");
        $this->db->where("berita.slug", $slug);
        return $this->db->get('berita')->row_array();
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

    public function getLastest($limit = 3)
    {
        $this->db->select("berita.*, kategori_berita.nama_kategori");
        $this->db->join("kategori_berita", "berita.id_kategori = kategori_berita.id", "LEFT");
        $this->db->order_by("berita.id", "DESC");
        $this->db->limit($limit);
        return $this->db->get('berita')->result_array();
    }
}
