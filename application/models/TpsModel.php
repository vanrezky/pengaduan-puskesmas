<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TpsModel extends CI_Model
{

    protected static $table = "tb_tps";
    protected static $primary_key = "id_tps";

    public function getData($per_page = "", $offset = "")
    {
        $this->db->select("*");
        $this->db->join("tb_jenistps jp", "jp.id_jenistps = tp.id_jenistps", "LEFT");
        $this->db->order_by($this::$primary_key, "DESC");
        return $this->db->get($this::$table . " tp", $per_page, $offset);
    }

    public function getDataID($id_tps)
    {
        $this->db->select("*");
        $this->db->join("tb_jenistps jp", "jp.id_jenistps = tp.id_jenistps", "LEFT");
        $this->db->where("id_tps", $id_tps);
        return $this->db->get($this::$table . " tp")->row_array();
    }

    public function deleteData($id)
    {
        $this->db->where($this::$primary_key, $id);
        return $this->db->delete($this::$table);
    }
}
