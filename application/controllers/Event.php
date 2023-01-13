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
            "styles" => [
                "public/assets/adminlte/plugins/select2/css/select2.min.css"
            ],
            "scripts" => [
                "public/assets/js/jqueryMask.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/formvalidation.js",
                "public/assets/js/base_form.js",
                "public/assets/adminlte/plugins/select2/js/select2.full.min.js"
            ]
        ];

        $this->load->view('pages/event/form', $data);
    }

    private function formValidation(): array
    {
        $this->load->library('form_validation');
        $this->load->helper("custom_form_validation_functions");

        $fieldsRules = [
            [
                "field" => "name",
                "label" => "Nome",
                "rules" => "trim|required"
            ],
            [
                "field" => "clients",
                "label" => "Clientes",
                "rules" => "trim|required"
            ],
            [
                "field" => "category",
                "label" => "Categoria",
                "rules" => "trim|required"
            ]
        ];

        $this->form_validation->set_rules($fieldsRules);

        if (!$this->form_validation->run()):
            return [
                "success" => false,
                "errors" => $this->form_validation->error_array()
            ];
        endif;

        return [
            "success" => true
        ];
    }

    public function create()
    {
        $post = $this->input->post();
        $response = [
            "success" => false,
            "messages" => [
                "success" => [],
                "failed" => ["nenhum dado enviado"]
            ]
        ];

        if (!empty($post)):
            $response['messages']['failed'] = [];

            $this->load->model("Event_model", "event");

            echo json_encode($post);

            return;
        endif;

        header("Content-type: application/json");
        echo json_encode($response);
    }
}
