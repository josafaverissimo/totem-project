<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EventSelection extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    private function getEvents()
    {
        $request = curl_init();

        curl_setopt($request, CURLOPT_URL, base_cdn("event/getAll"));
        curl_setopt($request, CURLOPT_HTTPGET, true);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($request);

        if (curl_errno($request)) :
            return [];
        endif;

        curl_close($request);

        return json_decode($response, true);
    }

    public function index()
    {
        $events = $this->getEvents();

        $data = [
            "events" => (object) $events,
            "title" => "Relive",
            "styles" => [
                "public/assets/adminlte/plugins/select2/css/select2.min.css",
                "public/assets/css/toastify.css"
            ],
            "scripts" => [
                "public/assets/js/jqueryMask.js",
                "public/assets/js/toastify.js",
                "public/assets/js/helpers.js",
                "public/assets/js/formvalidation.js",
                "public/assets/adminlte/plugins/select2/js/select2.full.min.js",
                "public/assets/js/base_form.js",
            ],
            "bodyClasses" => "hold-transition layout-top-nav"
        ];

        $this->load->view('pages/event_selection', $data);
    }

    public function loadEvent()
    {
        echo "evento carregado";
    }
}
