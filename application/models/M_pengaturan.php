<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pengaturan extends CI_Model
{

    public function getData()
    {
        $this->db->select("*");
        return $this->db->get("pengaturan");
    }
}
