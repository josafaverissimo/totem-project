<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
		$this->load->library('aauth');

		var_dump($this->aauth->is_loggedin());

		$this->load->view('pages/login');
	}

	public function doLogin()
	{
		$this->load->library('aauth');


		echo json_encode([
			"post" => $_POST,
			"login_status" => $this->aauth->login($_POST['email'], $_POST['password'])
		]);
	}
}
