<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PengaturanModel extends CI_Model
{

    protected static $table = "tb_pengaturan";
    protected static $primary_key = "id";

    public function getData()
    {
        $this->db->select("*");
        return $this->db->get($this::$table);
    }
}

