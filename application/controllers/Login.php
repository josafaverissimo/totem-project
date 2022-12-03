<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library("aauth");

        if ($this->aauth->is_loggedin()) :
            //redirect("/dashboard");
        endif;
    }

    public function index()
    {
        $data = [
            "title" => "Relive",
            "scripts" => [
                "public/assets/js/login.js",
                "public/assets/js/formvalidation.js"
            ],
            "bodyClasses" => "hold-transition login-page"
        ];

        $this->load->view('pages/login', $data);
    }

    public function doLogin()
    {
        $this->load->library('aauth');

        $post = $this->input->post();

        $login_status = $this->aauth->login($post['user'], $post['password']) === true;

        echo json_encode([
            "login_status" => $login_status
        ]);
    }
}
