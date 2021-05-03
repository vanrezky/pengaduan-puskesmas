<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class JenistpsModel extends CI_Model
{

    protected static $table = "tb_jenistps";
    protected static $primary_key = "id_jenistps";

    public function getData($per_page = "", $offset = "")
    {
        $this->db->select("*");
        $this->db->order_by($this::$primary_key, "DESC");
        return $this->db->get($this::$table . " jt", $per_page, $offset);
    }

    public function getDataID($id_jenistps)
    {
        $this->db->select("*");
        $this->db->where("id_jenistps", $id_jenistps);
        return $this->db->get($this::$table . " jt")->row_array();
    }

    public function deleteData($id)
    {
        $this->db->where($this::$primary_key, $id);
        return $this->db->delete($this::$table);
    }
}
