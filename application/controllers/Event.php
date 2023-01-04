<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
{
    public function index()
    {
        $this->load->model("Event_model", "event");
        $data = [
            "events" => $this->event->getAll(),
            "title" => "Relive",
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
                "public/assets/js/event/index.js"
            ]
        ];

        $this->load->view('pages/event/index', $data);
    }


    public function form()
    {
        $data = [
            "title" => "Relive",
            "scripts" => [
                "public/assets/js/user/form.js",
                "public/assets/js/sweetalert.js"
            ]
        ];

        $this->load->view('pages/event/formEvent', $data);
    }
}
