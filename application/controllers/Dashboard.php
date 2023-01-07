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
        $this->load->model("Event_model", "event");
        $this->load->model("Client_model", "client");

        $data = [
            'title' => "Relive",
            "users" => $this->user->getLast(),
            "events" => $this->event->getLast(),
            "clients" => $this->client->getLast(),
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
