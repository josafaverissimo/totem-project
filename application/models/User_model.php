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

    private function setFieldsIfIsSetInArray($fields, $array)
    {
        foreach ($fields as $field):
            if (isset($array[$field])):
                $this->db->set("tu.$field", $array[$field]);
            endif;
        endforeach;
    }

    public function edit($userId, $data)
    {
        $this->db->trans_begin();

        $this->setFieldsIfIsSetInArray([
            "name",
            "cpf",
            "cellphone"
        ], $data);

        $this->db->where('tu.id', "$userId");
        $this->db->update($this->table . " tu");

        if ($this->db->trans_status() === false) :
            $this->db->trans_rollback();

            return false;
        else :
            $this->db->trans_commit();

            return true;
        endif;
    }

    public function editUsername($aauthUserId, $username)
    {
        $this->db->trans_begin();

        $this->db->set("au.username", "$username");
        $this->db->where("au.id", "$aauthUserId");
        $this->db->update("aauth_users au");

        if ($this->db->trans_status() === false) :
            $this->db->trans_rollback();

            return false;
        else :
            $this->db->trans_commit();

            return true;
        endif;
    }

    public function editPassword($aauthUserId, $passwordHash)
    {
        $this->db->trans_begin();

        $this->db->set("au.pass", "$passwordHash");
        $this->db->where("au.id", "$aauthUserId");
        $this->db->update("aauth_users au");

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
        $this->db->select("tu.id, tu.name, tu.cpf, tu.cellphone, tu.hash, tu.aauth_user_id");
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

    public function getLastUsers($limit = 5)
    {
        $this->db->select("tu.id, tu.name, tu.cpf, tu.cellphone, tu.hash");
        $this->db->from($this->table . " tu");
        $this->db->order_by("tu.id", "desc");
        $this->db->limit($limit);

        return $this->db->get()->result();
    }

    public function delete($id)
    {
        $this->db->trans_begin();

        $this->db->where("id", $id);
        $this->db->delete($this->table);

        if ($this->db->trans_status() === false) :
            $this->db->trans_rollback();

            return false;
        else :
            $this->db->trans_commit();

            return true;
        endif;
    }

    public function deleteAauthUser($id)
    {
        $this->db->trans_begin();

        $this->db->where("id", $id);
        $this->db->delete("aauth_users");

        if ($this->db->trans_status() === false) :
            $this->db->trans_rollback();

            return false;
        else :
            $this->db->trans_commit();

            return true;
        endif;
    }
}
