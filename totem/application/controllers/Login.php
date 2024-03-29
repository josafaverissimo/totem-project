<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library("aauth");
    }

    public function index()
    {
        if ($this->aauth->is_loggedin()) :
            redirect("/eventSelection");
        endif;

        $data = [
            "page" => "login",
            "title" => "Relive",
            "styles" => [
                "public/assets/css/toastify.css"
            ],
            "scripts" => [
                "public/assets/js/formvalidation.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/login.js"
            ],
            "bodyClasses" => "hold-transition login-page"
        ];

        $this->load->view('pages/login', $data);
    }

    public function doLogin()
    {

        $post = $this->input->post();

        $message = "";
        $loginOperation = $this->aauth->login($post['user'], $post['password']) === true;

        if (!$loginOperation) {
            $message = "Usuário ou senha incorretos.";
        }

        $loginStatus = [
            "loginOperation" => $loginOperation,
            "message" => $message
        ];

        header('Content-Type: application/json');
        echo json_encode($loginStatus);
    }

    public function doLogout()
    {
        $this->aauth->logout();

        redirect("/login");
    }
}
