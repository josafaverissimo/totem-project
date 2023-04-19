<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event_model extends CI_Model
{
    private $table;
    private $lastInsertId;

    public function __construct()
    {
        parent::__construct();

        $this->table = "totem_events";
    }

    public function getLastInsertId()
    {
        return $this->lastInsertId;
    }

    public function create($name, $events_category_id, $active, $background)
    {
        $this->db->trans_begin();

        $timestamp = (new DateTime)->getTimestamp();

        $data = [
            "name" => $name,
            "events_category_id" => $events_category_id,
            "active" => $active,
            "background" => $background,
            "hash" => md5($name . $timestamp)
        ];

        $this->db->insert($this->table, $data);
        $this->lastInsertId = $this->db->insert_id();

        if ($this->db->trans_status() === false) :
            $this->db->trans_rollback();

            return false;
        else :
            $this->db->trans_commit();

            return true;
        endif;
    }

    public function unlinkClientsToEvent($eventId)
    {
        $this->db->trans_begin();

        $this->db->where("event_id", $eventId);
        $this->db->delete("totem_events_clients");

        if ($this->db->trans_status() === false) :
            $this->db->trans_rollback();

            return false;
        else :
            $this->db->trans_commit();

            return true;
        endif;
    }

    public function linkClientToEvent($eventId, $clientId)
    {
        $this->db->trans_begin();

        $data = [
            "event_id" => $eventId,
            "client_id" => $clientId,
        ];

        $this->db->insert("totem_events_clients", $data);

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

    public function edit($eventId, $data)
    {
        $this->db->trans_begin();

        $this->setFieldsIfIsSetInArray([
            "name",
            "events_category_id",
            "background",
            "active"
        ], $data);

        $this->db->where('te.id', "$eventId");
        $this->db->update($this->table . " te");

        if ($this->db->trans_status() === false) :
            $this->db->trans_rollback();

            return false;
        else :
            $this->db->trans_commit();

            return true;
        endif;
    }

    public function getEventClients($eventId)
    {
        $this->db->select("tc.id, tc.name, tc.cpf, tc.cellphone, tc.cep, tc.state, tc.city,
        tc.neighborhood, tc.address, tc.number, tc.hash");
        $this->db->from("totem_events_clients tec");
        $this->db->join("totem_events te", "te.id = tec.event_id");
        $this->db->join("totem_clients tc", "tc.id = tec.client_id");
        $this->db->where("te.id", $eventId);

        return $this->db->get()->result_array();
    }

    public function getBy($field, $value)
    {
        $this->db->select("te.id, te.name, te.events_category_id, te.active, te.background, te.hash");
        $this->db->from($this->table . " te");
        $this->db->order_by("te.id", "desc");
        $this->db->where("te.$field", $value);

        return $this->db->get()->row_array();
    }

    public function getByHash($hash)
    {
        $this->db->select("te.id, te.name, te.events_category_id, te.active, te.background, te.hash");
        $this->db->from($this->table . " te");
        $this->db->order_by("te.id", "desc");
        $this->db->where("te.hash", $hash);

        return $this->db->get()->row_array();
    }

    public function getAll()
    {
        $this->db->select("te.id, te.name, te.events_category_id, te.active, te.background, te.hash");

        $this->db->from($this->table . " te");
        $this->db->order_by("te.id", "desc");

        return $this->db->get()->result();
    }

    public function getLast($limit = 5)
    {
        $this->db->select("te.id, te.name, te.events_category_id, te.active, te.background, te.hash");
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
