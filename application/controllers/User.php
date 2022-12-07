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
                "public/assets/datatables/css/datatables.css",
                "public/assets/css/toastify.css"
            ],
            "scripts" => [
                "public/assets/datatables/js/datatables.js",
                "public/assets/js/base_datatables.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/user/index.js"
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

        $formAction = $editMode ? base_url("user/edit/$userHash") : base_url("user/create");

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
        $message = [
            "messages" => [
                "success" => [],
                "failed" => ["nenhum dado enviado"]
            ]
        ];

        if (!empty($post)) :
            $message['messages']['failed'] = [];

            $this->load->model('User_model', 'user');
            $this->load->library('aauth');
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
                    "rules" => "required|valid_cpf|is_unique[totem_users.cpf]"
                ],
                [
                    "field" => "cellphone",
                    "label" => "Telefone",
                    "rules" => "trim|valid_cellphone|required"
                ],
                [
                    "field" => "password",
                    "label" => "Senha",
                    "rules" => "min_length[5]|max_length[14]|required"
                ]
            ];

            // to form validation rules "is_unique" and valid_cellphone
            $_POST['cpf'] = $this->removeFieldMask("cpf", $_POST['cpf']);
            $_POST['cellphone'] = $this->removeFieldMask("cellphone", $post['cellphone']);
            $post['cpf'] = $_POST['cpf'];
            $post['cellphone'] = $_POST['cellphone'];

            $this->form_validation->set_rules($fieldsRules);

            if (!$this->form_validation->run()):
                header("Content-Type: application/json");
                echo json_encode([
                    "formValidation" => $this->form_validation->error_array()
                ]);
                return;
            endif;

            $aauth_user_id = $this->aauth->create_user($post['cpf'] . "@mail.com", $post['password'], $post['cpf']);

            if ($aauth_user_id !== false) :
                $success = $this->user->create($post['name'], $post['cpf'], $post['cellphone'], $aauth_user_id);

                if ($success):
                    $message['messages']['success'][] = "Usuário criado com sucesso";
                else:
                    $message['messages']['failed'][] = "Ocorreu um erro durante o processo de cadastro";
                endif;

            else :
                $message['messages']['failed'][] = $this->aauth->get_errors_array();
            endif;
        endif;

        header("Content-type: application/json");
        echo json_encode($message);
    }

    private function getFieldsIfNotEmpty($fields, $array)
    {
        $newArray = [];
        foreach ($fields as $field):
            if (!empty($array[$field])):
                $newArray[$field] = $array[$field];
            endif;
        endforeach;

        return $newArray;
    }

    public function edit($userHash)
    {
        $post = $this->input->post();
        $message = [
            "messages" => [
                "success" => [],
                "failed" => ["nenhum dado enviado"]
            ]
        ];

        if (!empty($post)) :
            $message['messages']['failed'] = [];

            $this->load->model('User_model', 'user');
            $this->load->library('aauth');
            $this->load->library('form_validation');

            if (isset($post['cpf'])):
                $post['cpf'] = $this->removeFieldMask("cpf", $post['cpf']);
            endif;

            if (isset($post['cellphone'])):
                $post['cellphone'] = $this->removeFieldMask("cellphone", $post['cellphone']);
            endif;

            $this->form_validation->set_rules("cpf", "Cpf", "is_unique[totem_users.cpf]");

            if (!$this->form_validation->run()):
                header("Content-Type: application/json");
                echo json_encode([
                    "success" => false,
                    "formValidation" => $this->form_validation->error_array()
                ]);
                return;
            endif;

            $user = $this->user->getByHash($userHash);
            $data = $this->getFieldsIfNotEmpty([
                "name",
                "cpf",
                "cellphone"
            ], $post);

            if (!empty($data)):
                $success = $this->user->edit($user['id'], $data);


                if ($success):
                    $this->load->library("aauth");
                    if (!empty($post['password'])):
                        $passwordHash = $this->aauth->hash_password($post['password'], $user['aauth_user_id']);

                        $passwordEditStatus = $this->user->editPassword($user['aauth_user_id'], $passwordHash);

                        if (!$passwordEditStatus):
                            $message['messages']["failed"][] = "Não foi possível alterar a senha";
                        endif;
                    endif;

                    if (!empty($data['cpf'])):
                        $username = $data['cpf'];

                        $usernameEditStatus = $this->user->editUsername($user['aauth_user_id'], $username);
                        if (!$usernameEditStatus):
                            $message['messages']["failed"][] = "Não foi possível alterar o seu nome de usuário";
                        endif;
                    endif;
                endif;

                if ($success):
                    $message['messages']["success"][] = "Usuário editado com sucesso";
                else:
                    $message['messages']['failed'][] = "Ocorreu um erro durante o processo de edição";
                endif;
            endif;
        endif;

        header("Content-type: application/json");
        echo json_encode($message);
    }

    public function delete($hash)
    {
        $this->load->model("User_model", "user");

        $response = [
            "success" => false,
            "messages" => [
                "success" => [],
                "failed" => []
            ]
        ];

        $user = $this->user->getByHash($hash);
        $deleteUserStatus = $this->user->delete($user['id']);
        $deleteAauthUser = $this->user->deleteAauthUser($user['aauth_user_id']);

        if ($deleteUserStatus):
            $response['messages']['success'][] = "Usuário deletado com sucesso";
            $response["success"] = true;
        else:
            $response['messages']['failed'][] = "Ocorreu um erro durante a deleção do usuário";
        endif;

        if (!$deleteAauthUser):
            $response['messages']['failed'][] = "Ocorreu um erro durante a deleção das credencias de login";
            $response["success"] = false;
        endif;

        header("Content-type: application/json");
        echo json_encode($response);
    }
}