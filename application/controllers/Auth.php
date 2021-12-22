<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth extends CI_Controller {
		public function index() {
			$this->load->template('./auth/userPage');
		}
		public function register() {
			$this->load->template('./auth/register');
		}
		public function login() {
			$this->load->template('./auth/login');
		}
	}
?>
