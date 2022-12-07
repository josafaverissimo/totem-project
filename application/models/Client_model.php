<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_model extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();

        $this->table = "totem_clients";
    }

    public function create($name, $cpf, $cellphone, $address)
    {
        $this->db->trans_begin();

        $timestamp = (new DateTime)->getTimestamp();

        $data = [
            "name" => $name,
            "cpf" => $cpf,
            "cellphone" => $cellphone,
            "address" => $address,
            "hash" => md5($cpf . $timestamp)
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
                $this->db->set("tc.$field", $array[$field]);
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

    public function getByHash($hash)
    {
        $this->db->select("tc.id, tc.name, tc.cpf, tc.cellphone, tc.address, tc.hash");
        $this->db->from($this->table . " tc");
        $this->db->where("tc.hash", $hash);

        return $this->db->get()->row_array();
    }

    public function getAll()
    {
        $this->db->select("tc.id, tc.name, tc.cpf, tc.cellphone, tc.address, tc.hash");
        $this->db->from($this->table . " tc");
        $this->db->order_by("tc.id", "desc");

        return $this->db->get()->result();
    }

    public function getLast($limit = 5)
    {
        $this->db->select("tc.id, tc.name, tc.cpf, tc.cellphone, tc.hash");
        $this->db->from($this->table . " tc");
        $this->db->order_by("tc.id", "desc");
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
}
