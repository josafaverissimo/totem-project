<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    // public function __construct(){
    //     $this->load->helper('helper/Form_helper');
    // }

	public function index()
	{
		$this->load->library('aauth');
		$this->load->view('pages/register');
	}

	public function registerUser()
	{
		$this->load->library('aauth');

        /**
         * Validate user input
         */
			$validated = $this->validate([
                'email' => 'required',
                'name' => 'required|valid_email',
                'pass' => 'require|min_length[5]|max_length[20]',
                'passConfirm' => 'require|min_length[5]|max_length[20]|matches[pass]'

            ]);

            if(!validated){
                return view('pages/register', ['validation' => $this->validator]);

            }
	}
}
