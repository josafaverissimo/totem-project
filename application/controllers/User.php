<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function index()
    {
        $data = [
            "title" => "Relive"
        ];

        $this->load->view('pages/user/index', $data);
    }


    public function form()
    {
        $data = [
            "title" => "Relive",
            "scripts" => [
                "public/assets/js/user/form.js"
            ]
        ];

        $this->load->view('pages/user/form', $data);
    }

    public function create()
    {

        $post = $this->input->post();

        if (!empty($post)) :
            $this->load->model('User_model', 'user');
            $this->load->library('aauth');

            $aauth_user_id = $this->aauth->create_user($post['cpf'] . "@mail.com", $post['password'], $post['cpf']);

            if ($aauth_user_id !== false) :
                var_dump($this->user->create($post['name'], $post['cpf'], $post['cellphone'], $aauth_user_id));
            endif;
        endif;
    }
}
