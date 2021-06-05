<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model
{


    public function getData($per_page = "", $offset = "")
    {
        $this->db->select("*");
        $this->db->order_by('id', "DESC");
        return $this->db->get('user', $per_page, $offset);
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
        return $this->db->get('user')->row_array();
    }

    public function deleteDataID($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('user');
    }
}
