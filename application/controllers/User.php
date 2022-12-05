<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $this->load->model("User_model", "user");
        $data = [
            "title" => "Relive",
            "users" => $this->user->getAll(),
            "styles" => [
                "public/assets/css/base_datatables.css",
                "public/assets/datatables/css/datatables.css"
            ],
            "scripts" => [
                "public/assets/datatables/js/datatables.js",
                "public/assets/js/base_datatables.js"
            ]
        ];

        $this->load->view('pages/user/index', $data);

    }


    public function form($userHash = null)
    {
        $user = [
            "id" => null,
            "name" => null,
            "cpf" => null,
            "cellphone" => null,
            "hash" => null,
        ];

        $editMode = !empty($userHash);

        $formAction = $editMode ? base_url("user/edit") : base_url("user/create");

        if ($editMode) :
            $this->load->model("User_model", "user");

            $user = $this->user->getByHash($userHash);
        endif;


        $data = [
            "title" => "Relive",
            "user" => $user,
            "editMode" => $editMode,
            "formAction" => $formAction,
            "styles" => [
                "public/assets/css/toastify.css"
            ],
            "scripts" => [
                "public/assets/js/jqueryMask.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/formvalidation.js",
                "public/assets/js/user/form.js",
            ]
        ];

        $this->load->view('pages/user/form', $data);
    }

    private function removeFieldMask($field, $value)
    {
        $removeMask = [
            "cpf" => function ($value) {
                return preg_replace("/[.-]/", "", $value);
            },
            "cellphone" => function ($value) {
                return preg_replace("/[() -]/", "", $value);
            }
        ];

        return $removeMask[$field]($value);
    }

    public function create()
    {

        $post = $this->input->post();
        $success = false;
        $message = "nenhum dado enviado";

        if (!empty($post)) :
            $this->load->model('User_model', 'user');
            $this->load->library('aauth');
            $this->load->library('form_validation');

            $fieldsRules = [
                [
                    "field" => "name",
                    "label" => "Nome",
                    "rules" => "trim|required"
                ],
                [
                    "field" => "cpf",
                    "label" => "Cpf",
                    "rules" => "required|is_unique[totem_users.cpf]"
                ],
                [
                    "field" => "cellphone",
                    "label" => "Telefone",
                    "rules" => "trim|required"
                ],
                [
                    "field" => "password",
                    "label" => "Senha",
                    "rules" => "required"
                ]
            ];
            $this->form_validation->set_rules($fieldsRules);

            if (!$this->form_validation->run()):
                header("Content-Type: application/json");
                echo json_encode([
                    "success" => false,
                    "formValidation" => $this->form_validation->error_array()
                ]);
                return;
            endif;

            $post['cpf'] = $this->removeFieldMask("cpf", $post['cpf']);
            $post['cellphone'] = $this->removeFieldMask("cellphone", $post['cellphone']);

            $aauth_user_id = $this->aauth->create_user($post['cpf'] . "@mail.com", $post['password'], $post['cpf']);

            if ($aauth_user_id !== false) :
                $success = $this->user->create($post['name'], $post['cpf'], $post['cellphone'], $aauth_user_id);
                $message = "Usuário criado com sucesso";
            else :
                $message = "Cpf já cadastrado";
            endif;
        endif;

        echo json_encode([
            "success" => $success,
            "message" => $message
        ]);
    }

    public function edit()
    {
        echo "hello edit";
    }
}