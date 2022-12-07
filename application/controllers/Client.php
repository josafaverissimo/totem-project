<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{
    public function index()
    {
        $this->load->model("Client_model", "client");
        $data = [
            "title" => "Relive",
            "clients" => $this->client->getAll(),
            "styles" => [
                "public/assets/css/base_datatables.css",
                "public/assets/datatables/css/datatables.css"
            ],
            "scripts" => [
                "public/assets/datatables/js/datatables.js",
                "public/assets/js/base_datatables.js"
            ]
        ];

        $this->load->view('pages/client/index', $data);
    }


    public function form($clientHash = null)
    {

        $client = [
            "name" => null,
            "cpf" => null,
            "cellphone" => null,
            "address" => null,
        ];

        $editMode = !empty($clientHash);

        $formAction = $editMode ? base_url("client/edit/$clientHash") : base_url("client/create");

        if ($editMode) :
            $this->load->model("Client_model", "client");

            $client = $this->client->getByHash($clientHash);
        endif;

        $data = [
            "title" => "Relive",
            "editMode" => $editMode,
            "formAction" => $formAction,
            "client" => $client,
            "styles" => [
                "public/assets/css/toastify.css"
            ],
            "scripts" => [
                "public/assets/js/jqueryMask.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/formvalidation.js",
                "public/assets/js/client/form.js",
            ]
        ];

        $this->load->view('pages/client/form', $data);
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
                "field" => "cpf",
                "label" => "Cpf",
                "rules" => "required|valid_cpf"
            ],
            [
                "field" => "cellphone",
                "label" => "Telefone",
                "rules" => "trim|valid_cellphone|required"
            ],
            [
                "field" => "address",
                "label" => "Endereço",
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
            "messages" => [
                "success" => [],
                "failed" => ["nenhum dado enviado"]
            ]
        ];

        if (!empty($post)):
            $response['messages']['failed'] = [];

            $this->load->model('Client_model', 'client');

            $formValidation = $this->formValidation();
            if (!$formValidation['success']):
                header("Content-type: application/json");
                echo json_encode([
                    "formValidation" => $formValidation["errors"]
                ]);
                return;
            endif;

            $clientCreateOperation = $this->client->create(
                $post['name'],
                $post['cpf'],
                $post['cellphone'],
                $post['address']
            );

            if ($clientCreateOperation):
                $response['messages']['success'][] = "Cliente criado com sucesso";
            endif;
        endif;

        header("Content-type: application/json");
        echo json_encode($response);
    }
}
