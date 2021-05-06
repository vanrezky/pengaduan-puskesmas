<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model
{

    protected static $table = "tb_user";
    protected static $primary_key = "id_user";

    public function getData($per_page = "", $offset = "")
    {
        $this->db->select("*");
        $this->db->order_by($this::$primary_key, "DESC");
        return $this->db->get($this::$table . " user", $per_page, $offset);
    }

    public function getDataID($id_user)
    {
        $this->db->select("*");
        if (is_string($id_user)) {
            $this->db->where("id_user", $id_user);
        }
        if (is_array($id_user)) {
            $this->db->where($id_user);
        }
        return $this->db->get($this::$table . " user")->row_array();
    }

    public function deleteData($id)
    {
        $this->db->where($this::$primary_key, $id);
        return $this->db->delete($this::$table);
    }
}
