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
        $data = [
            'title' => "Relive"
        ];
        $this->load->view('pages/dashboard', $data);
    }
}
