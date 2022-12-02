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
    public function create($name, $cpf, $cellphone, $aauth_user_id)
    {
        $this->db->trans_begin();

        $data = [
            "name" => $name,
            "cpf" => $cpf,
            "cellphone" => $cellphone,
            "aauth_user_id" => $aauth_user_id
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

    public function getAll()
    {
        $this->db->select("*");
        $this->db->from($this->table);

        return $this->db->get()->result();
    }
}
