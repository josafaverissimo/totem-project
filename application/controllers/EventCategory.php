<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EventCategory extends CI_Controller
{
    public function index()
    {
        $this->load->model("EventCategory_model", "eventCategory");
        $data = [
            "page" => "eventCategory",
            "eventsCategories" => $this->eventCategory->getAll(),
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
                "public/assets/js/base_table.js"
            ]
        ];

        $this->load->view('pages/event/category/index', $data);
    }


    public function form($eventCategoryHash = null)
    {
        $this->load->model("Client_model", "client");

        $eventCategory = [
            "name" => null
        ];
        $editMode = !empty($eventCategoryHash);

        if ($editMode) :
            $this->load->model("EventCategory_model", "eventCategory");

            $eventCategory = $this->eventCategory->getByHash($eventCategoryHash);
        endif;

        $formAction = $editMode ? base_url("event/category/edit/$eventCategoryHash") : base_url("event/category/create");

        $data = [
            "page" => "eventCategory/form",
            "title" => "Relive",
            "eventCategory" => $eventCategory,
            "editMode" => $editMode,
            "formAction" => $formAction,
            "styles" => [
                "public/assets/css/base_datatables.css",
                "public/assets/datatables/css/datatables.css",
                "public/assets/css/toastify.css"
            ],
            "scripts" => [
                "public/assets/js/jqueryMask.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/formvalidation.js",
                "public/assets/js/base_form.js",
            ]
        ];

        $this->load->view('pages/event/category/form', $data);
    }

    private function formValidation(): array
    {
        $this->load->library('form_validation');

        $fieldsRules = [
            [
                "field" => "name",
                "label" => "Nome",
                "rules" => "trim|required"
            ]
        ];

        $this->form_validation->set_rules($fieldsRules);

        if (!$this->form_validation->run()) :
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

        if (!empty($post)) :
            $this->load->model("EventCategory_model", "eventCategory");

            $response['messages']['failed'] = [];

            $formValidation = $this->formValidation();
            if (!$formValidation['success']) :
                header("Content-type: application/json");
                echo json_encode([
                    "formValidation" => $formValidation["errors"]
                ]);
                return;
            endif;

            $eventCategoryCreateOperation = $this->eventCategory->create(
                $post['name']
            );

            if ($eventCategoryCreateOperation) :
                $response['success'] = true;
                $response['messages']['success'][] = "Categoria de evento criada com sucesso";
            endif;
        endif;

        header("Content-type: application/json");
        echo json_encode($response);
    }

    public function edit($hash)
    {
        $post = $this->input->post();
        $response = [
            "success" => false,
            "messages" => [
                "success" => [],
                "failed" => ["nenhum dado enviado"]
            ]
        ];

        if (!empty($post)) :
            $response['messages']['failed'] = [];

            $this->load->model('EventCategory_model', 'eventCategory');
            $this->load->helper("filtering_helper");

            $eventCategory = $this->eventCategory->getByHash($hash);
            $data = getFieldsIfNotEmpty([
                "name"
            ], $post);

            if (!empty($data)) :
                $success = $this->eventCategory->edit($eventCategory['id'], $data);

                if ($success) :
                    $response['success'] = true;
                    $response['messages']['success'][] = "Categoria de evento editada com sucesso";
                else :
                    $response['messages']['failed'][] = "Ocorreu um erro durante o processo de edição";
                endif;
            endif;
        endif;

        header("Content-type: application/json");
        echo json_encode($response);
    }

    public function delete($hash)
    {
        $this->load->model("EventCategory_model", "eventCategory");

        $response = [
            "success" => false,
            "messages" => [
                "success" => [],
                "failed" => []
            ]
        ];

        $eventCategory = $this->eventCategory->getByHash($hash);
        $deleteClientStatus = $this->eventCategory->delete($eventCategory['id']);

        if ($deleteClientStatus) :
            $response['messages']['success'][] = "Categoria de evento deletada com sucesso";
            $response["success"] = true;
        else :
            $response['messages']['failed'][] = "Ocorreu um erro durante a deleção da categoria do evento";
        endif;

        header("Content-type: application/json");
        echo json_encode($response);
    }
}
