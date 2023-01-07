<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event_model extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();

        $this->table = "totem_events";
    }

    public function create($name, $type, $active, $background)
    {
        $this->db->trans_begin();

        $timestamp = (new DateTime)->getTimestamp();

        $data = [
            "name" => $name,
            "type" => $type,
            "active" => $active,
            "background" => $background,
            "hash" => md5($name . $timestamp)
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
        foreach ($fields as $field) :
            if (isset($array[$field])) :
                $this->db->set("te.$field", $array[$field]);
            endif;
        endforeach;
    }

    public function edit($clientId, $data)
    {
        $this->db->trans_begin();

        $this->setFieldsIfIsSetInArray([
            "name",
            "cpf",
            "cellphone",
            "cep",
            "state",
            "city",
            "address",
            "neighborhood",
            "number"
        ], $data);

        $this->db->where('tc.id', "$clientId");
        $this->db->update($this->table . " tc");

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
        $this->db->select("te.id, te.name, te.events_category_id, te.active, te.background_path, te.hash");
        $this->db->from($this->table . " te");
        $this->db->order_by("te.id", "desc");
        $this->db->where("te.hash", $hash);

        return $this->db->get()->row_array();
    }

    public function getAll()
    {
        $this->db->select("te.id, te.name, te.events_category_id, te.active, te.background_path, te.hash");

        $this->db->from($this->table . " te");
        $this->db->order_by("te.id", "desc");

        return $this->db->get()->result();
    }

    public function getLast($limit = 5)
    {
        $this->db->select("te.id, te.name, te.events_category_id, te.active, te.background_path, te.hash");
        $this->db->from($this->table . " te");
        $this->db->order_by("te.id", "desc");
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
