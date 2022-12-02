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
            "scripts" => [
                "public/assets/js/user/form.js",
                "public/assets/js/sweetalert.js"
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
