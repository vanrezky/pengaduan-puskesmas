<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TpsModel extends CI_Model
{

    protected static $table = "tb_tps";
    protected static $primary_key = "id_tps";

    public function getData($per_page = "", $offset = "", $id = "")
    {
        $this->db->select("*");
        $this->db->join("tb_jenistps jp", "jp.id_jenistps = tp.id_jenistps", "LEFT");
        if (isset($id)) {
            if (!empty($id)) {
                $this->db->where($this::$primary_key, $id);
            }
        }
        $this->db->order_by($this::$primary_key, "DESC");
        return $this->db->get($this::$table . " tp", $per_page, $offset);
    }

    public function getDataID($id_tps)
    {
        $this->db->select("*");
        $this->db->join("tb_jenistps jp", "jp.id_jenistps = tp.id_jenistps", "LEFT");
        if (is_string($id_tps)) {
            $this->db->where("id_tps", $id_tps);
        }
        if (is_array($id_tps)) {
            $this->db->where($id_tps);
        }
        return $this->db->get($this::$table . " tp")->row_array();
    }

    public function deleteData($id)
    {
        $this->db->where($this::$primary_key, $id);
        return $this->db->delete($this::$table);
    }


    public function getDataBanyakDilihat()
    {

        return $this->db->join('tb_jenistps tj', 'tt.id_jenistps = tj.id_jenistps', 'left')
            ->order_by('dilihat', 'desc')
            ->limit(3)
            ->get('tb_tps tt')->result_array();
    }

    public function updateDataID($id)
    {
        $this->db->set("dilihat", "`dilihat` + 1", false);
        $this->db->where($this::$primary_key, $id);
        return $this->db->update($this::$table);
    }
}
