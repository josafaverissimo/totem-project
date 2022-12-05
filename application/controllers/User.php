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
                "public/assets/js/formvalidation.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/user/form.js",
            ]
        ];

        $this->load->view('pages/user/form', $data);
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

            $this->form_validation->set_rules("name", 'Nome', 'trim|required');
            $this->form_validation->set_rules("cpf", 'Cpf', 'required|is_unique[totem_users.cpf]');
            $this->form_validation->set_rules("cellphone", "Telefone", "trim|required");
            $this->form_validation->set_rules("password", "Senha", "required", [
                "required" => "O campo Senha é obrigatório"
            ]);

            if ($this->form_validation->run() == FALSE):
                header("Content-Type: application/json");
                echo json_encode($this->form_validation->error_array());

                return;
            endif;

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