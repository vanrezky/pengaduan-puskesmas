<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pasien extends CI_Model
{

    protected static $table = "pasien";
    protected static $primary_key = "id";

    public function getData($per_page = "", $offset = "", $id = "")
    {
        $this->db->select("*");
        if (isset($id)) {
            if (!empty($id)) {
                $this->db->where($this::$primary_key, $id);
            }
        }
        $this->db->order_by($this::$primary_key, "DESC");
        return $this->db->get($this::$table . " PA", $per_page, $offset);
    }

    public function getDataID($id)
    {
        $this->db->select("*");
        if (is_string($id)) {
            $this->db->where("PA.id", $id);
        }
        if (is_array($id)) {
            $this->db->where($id);
        }
        return $this->db->get($this::$table . " PA")->row_array();
    }

    public function deleteDataID($id)
    {
        $this->db->where($this::$primary_key, $id);
        return $this->db->delete($this::$table);
    }

    public function updateDataID($data, $id)
    {
        $this->db->where($this::$primary_key, $id);
        return $this->db->update($this::$table, $data);
    }

    public function getDataKode($kode)
    {
        $this->db->select("*");
        if (is_string($kode)) {
            $this->db->where("PA.kode_pasien", $kode);
        }
        if (is_array($kode)) {
            $this->db->where($kode);
        }
        return $this->db->get($this::$table . " PA")->row_array();
    }
}
