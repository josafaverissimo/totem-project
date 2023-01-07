<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function index()
    {
        $this->load->model("Event_model", "event");
        $data = [
            "events" => $this->event->getAll(),
            "title" => "Relive",
            "styles" => [
                "public/assets/css/base_datatables.css",
                "public/assets/datatables/css/datatables.css",
                "public/assets/css/toastify.css"
            ],
            "scripts" => [
                "public/assets/datatables/js/datatables.js",
                "public/assets/js/base_datatables.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/event/index.js"
            ]
        ];

        $this->load->view('pages/event/index', $data);
    }


    public function form($eventHash = null)
    {
        $this->load->model("Client_model", "client");
        $this->load->model("EventCategory_model", "eventCategory");

        $event = [
            "name" => null,
            "eventsCategoryId" => null,
            "backgroundPath" => null,
            "active" => null
        ];
        $editMode = !empty($eventHash);
        $formAction = $editMode ? base_url("event/edit/$eventHash") : base_url("event/create");

        $clients = $this->client->getAll();
        $eventsCategories = $this->eventCategory->getAll();

        $data = [
            "title" => "Relive",
            "event" => $event,
            "editMode" => $editMode,
            "formAction" => $formAction,
            "clients" => $clients,
            "eventsCategories" => $eventsCategories,
            "scripts" => [
                "public/assets/js/jqueryMask.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/formvalidation.js",
                "public/assets/js/base_form.js",
            ]
        ];

        $this->load->view('pages/event/form', $data);
    }
}
