<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
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

        $this->load->view('pages/client/index', $data);

    }
        
    
    public function formClient(){

        $user = [
            "name" => null,
            "cpf" => null,
            "cellphone" => null,
            "address" => null,
        ];

        $data = [
            "title" => "Relive",
            "scripts" => [
                "public/assets/js/user/form.js",
                "public/assets/js/sweetalert.js"
            ]
        ];

        $this->load->view('pages/client/formClient', $data);
    }
}
