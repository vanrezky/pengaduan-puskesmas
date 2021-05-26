<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class KontakModel extends CI_Model
{

    protected static $table = "tb_kontak";
    protected static $primary_key = "id_kontak";

    public function getData($per_page = "", $offset = "")
    {
        $this->db->select("*");
        $this->db->order_by($this::$primary_key, "DESC");
        return $this->db->get($this::$table . " tk", $per_page, $offset);
    }

    public function getDataID($id_kontak)
    {
        $this->db->select("*");
        if (is_string($id_kontak)) {
            $this->db->where("id_kontak", $id_kontak);
        }
        if (is_array($id_kontak)) {
            $this->db->where($id_kontak);
        }
        return $this->db->get($this::$table . " tk")->row_array();
    }

    public function deleteData($id)
    {
        $this->db->where($this::$primary_key, $id);
        return $this->db->delete($this::$table);
    }
}
