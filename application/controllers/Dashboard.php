<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('aauth');

        if (!$this->aauth->is_loggedin()) :
            redirect("/");
        endif;
    }

    public function index()
    {
        $this->load->helper("format_helper");
        $this->load->model("User_model", "user");
        
        $data = [
            'title' => "Relive",
            "users" => $this->user->getLastUsers(),
            "styles" => [
                "public/assets/css/dashboard.css"
            ],
            "scripts" => [
                "public/assets/js/dashboard.js"
            ]
        ];

        $this->load->view('pages/dashboard', $data);
    }
}
