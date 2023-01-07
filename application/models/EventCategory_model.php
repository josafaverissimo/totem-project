<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EventCategory_model extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();

        $this->table = "totem_events_categories";
    }

    public function create($name)
    {
        $this->db->trans_begin();

        $timestamp = (new DateTime)->getTimestamp();

        $data = [
            "name" => $name,
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
                $this->db->set("tec.$field", $array[$field]);
            endif;
        endforeach;
    }

    public function edit($clientId, $data)
    {
        $this->db->trans_begin();

        $this->setFieldsIfIsSetInArray([
            "name"
        ], $data);

        $this->db->where('tec.id', "$clientId");
        $this->db->update($this->table . " tec");

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
        $this->db->select("tec.id, tec.name, tec.hash");
        $this->db->from($this->table . " tec");
        $this->db->order_by("tec.id", "desc");
        $this->db->where("tec.hash", $hash);

        return $this->db->get()->row_array();
    }

    public function getAll()
    {
        $this->db->select("tec.id, tec.name, tec.hash");

        $this->db->from($this->table . " tec");
        $this->db->order_by("tec.id", "desc");

        return $this->db->get()->result();
    }

    public function getLast($limit = 5)
    {
        $this->db->select("tec.id, tec.name, tec.cpf, tec.cellphone, tec.hash");
        $this->db->from($this->table . " tec");
        $this->db->order_by("tec.id", "desc");
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
