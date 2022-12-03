<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();

        $this->table = "totem_users";
    }

    public function create($name, $cpf, $cellphone, $aauth_user_id): bool
    {
        $this->db->trans_begin();

        $data = [
            "name" => $name,
            "cpf" => $cpf,
            "cellphone" => $cellphone,
            "aauth_user_id" => $aauth_user_id,
            "hash" => md5($cpf)
        ];

        $this->db->insert($this->table, $data);

        if ($this->db->trans_status() === false) :
            $this->db->trans_rollback();

            return false;
        else :
            $this->db->trans_commit();

            return true;
        endif;
    }

    public function getByHash($hash)
    {
        $this->db->select("tu.id, tu.name, tu.cpf, tu.cellphone, tu.hash");
        $this->db->from($this->table . " tu");
        $this->db->where("tu.hash", $hash);

        return $this->db->get()->row_array();
    }

    public function getAll()
    {
        $this->db->select("tu.id, tu.name, tu.cpf, tu.cellphone, tu.hash");
        $this->db->from($this->table . " tu");
        $this->db->order_by("tu.id", "desc");

        return $this->db->get()->result();
    }
}
