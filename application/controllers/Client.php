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
                "public/assets/datatables/css/datatables.css",
                "public/assets/css/toastify.css"
            ],
            "scripts" => [
                "public/assets/datatables/js/datatables.js",
                "public/assets/js/base_datatables.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/client/index.js"
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
            "cep" => null,
            "state" => null,
            "city" => null,
            "neighborhood" => null,
            "address" => null,
            "number" => null
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
                "public/assets/css/toastify.css",
                "public/assets/css/client/styles.css"
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
                "field" => "cep",
                "label" => "Cep",
                "rules" => "trim|required"
            ],
            [
                "field" => "state",
                "label" => "Estado",
                "rules" => "trim|required"
            ],
            [
                "field" => "city",
                "label" => "Cidade",
                "rules" => "trim|required"
            ],
            [
                "field" => "address",
                "label" => "Endereço",
                "rules" => "trim|required"
            ],
            [
                "field" => "neighborhood",
                "label" => "Bairro",
                "rules" => "trim|required"
            ],
            [
                "field" => "number",
                "label" => "Número",
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


    private function formEditValidation(): array
    {
        $this->load->library('form_validation');
        $this->load->helper("custom_form_validation_functions");

        $fieldsRules = [
            [
                "field" => "cpf",
                "label" => "Cpf",
                "rules" => "valid_cpf"
            ],
            [
                "field" => "cellphone",
                "label" => "Telefone",
                "rules" => "valid_cellphone"
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

            $this->load->model('Client_model', 'client');
            $this->load->helper("format_helper");

            $formValidation = $this->formValidation();
            if (!$formValidation['success']):
                header("Content-type: application/json");
                echo json_encode([
                    "formValidation" => $formValidation["errors"]
                ]);
                return;
            endif;

            $post['cpf'] = removeCpfMask($post['cpf']);
            $post['cellphone'] = removeCellphoneMask($post['cellphone']);

            $clientCreateOperation = $this->client->create(
                $post['name'],
                $post['cpf'],
                $post['cellphone'],
                $post['cep'],
                $post['state'],
                $post['city'],
                $post['address'],
                $post['neighborhood'],
                $post['number']
            );

            if ($clientCreateOperation):
                $response['success'] = true;
                $response['messages']['success'][] = "Cliente criado com sucesso";
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

        if (!empty($post)):
            $response['messages']['failed'] = [];

            $this->load->model('Client_model', 'client');

            $formEditValidation = $this->formEditValidation();
            if (!$formEditValidation['success']):
                header("Content-type: application/json");
                echo json_encode([
                    "formValidation" => $formEditValidation["errors"]
                ]);
                return;
            endif;

            $this->load->helper("format_helper");
            $this->load->helper("filtering_helper");

            if (isset($post['cpf'])):
                $post['cpf'] = removeCpfMask($post['cpf']);
            endif;

            if (isset($post['cellphone'])):
                $post['cellphone'] = removeCellphoneMask($post['cellphone']);
            endif;

            $client = $this->client->getByHash($hash);
            $data = getFieldsIfNotEmpty([
                "name",
                "cpf",
                "cellphone",
                "cep",
                "state",
                "city",
                "address",
                "neighborhood",
                "number"
            ], $post);

            if (!empty($data)):
                $success = $this->client->edit($client['id'], $data);

                if ($success):
                    $response['success'] = true;
                    $response['messages']['success'][] = "Cliente editado com sucesso";
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
        $this->load->model("Client_model", "client");

        $response = [
            "success" => false,
            "messages" => [
                "success" => [],
                "failed" => []
            ]
        ];

        $client = $this->client->getByHash($hash);
        $deleteClientStatus = $this->client->delete($client['id']);

        if ($deleteClientStatus):
            $response['messages']['success'][] = "Usuário deletado com sucesso";
            $response["success"] = true;
        else:
            $response['messages']['failed'][] = "Ocorreu um erro durante a deleção do usuário";
        endif;

        header("Content-type: application/json");
        echo json_encode($response);
    }
}
