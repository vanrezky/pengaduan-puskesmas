<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pengaduan extends CI_Model
{

    protected static $table = "pengaduan";
    protected static $primary_key = "id";

    public function getData($per_page = "", $offset = "")
    {
        $this->db->select("*");
        $this->db->order_by($this::$primary_key, "DESC");
        return $this->db->get($this::$table . " PE", $per_page, $offset);
    }

    public function getDataLatest($limit = 10)
    {
        $this->db->select("PE.*, PA.kode_pasien, PA.nama_pasien, PA.alamat, PA.telp");
        $this->db->join("pasien PA", "PE.id_pasien = PA.id", "INNER");
        $this->db->order_by("PE." . $this::$primary_key, "DESC");
        $this->db->limit($limit);
        return $this->db->get($this::$table . " PE")->result_array();
    }

    public function getDataID($id)
    {
        $this->db->select("*");
        if (is_string($id)) {
            $this->db->where("id", $id);
        }
        if (is_array($id)) {
            $this->db->where($id);
        }
        return $this->db->get($this::$table . " PE")->row_array();
    }

    public function deleteData($id)
    {
        $this->db->where($this::$primary_key, $id);
        return $this->db->delete($this::$table);
    }
}
