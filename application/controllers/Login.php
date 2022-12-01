<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
		$data = [
			"title" => "Relive",
			"scripts" => [
				"public/assets/js/login.js"
			]
		];

		$this->load->view('pages/login', $data);
	}

	public function doLogin()
	{
		$this->load->library('aauth');

		$post = $this->input->post();

		$login_status = $this->aauth->login($post['email'], $post['password']) === true;

		echo json_encode([
			"login_status" => $login_status
		]);
	}
}
