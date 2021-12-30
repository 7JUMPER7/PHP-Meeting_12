<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('customer_model');
			$this->load->library('session');
		}

		public function index() {
			$this->load->template('./auth/userPage');
		}
		public function register() {
			$sBtn = $this->input->post('sBtn');
			$data = array();
			if(isset($sBtn)) {
				$this->load->library('form_validation');
				$this->form_validation->set_rules('name', 'Имя', 'required', array('required' => 'Имя - обязательный параметр'));
				$this->form_validation->set_rules('email', 'Почта', 'required|valid_email|is_unique[Customers.Email]', array('required' => 'Почта - обязательный параметр',
					'valid_email' => 'Почта введена некорректно', 'is_unique' => 'Почта уже существует'));
				$this->form_validation->set_rules('pass1', 'Пароль', 'required', array('required' => 'Пароль - обязательное поле'));
				$this->form_validation->set_rules('pass2', 'Пароль', 'matches[pass1]', array('matches' => 'Пароли не совпадают'));
	
				if($this->form_validation->run() == false) {
					$data['success'] = false;
					$data['errors'] = $this->form_validation->error_array();
				} else {
					$name = $this->input->post('name');
					$email = $this->input->post('email');
					$password = $this->input->post('pass1');
					$customer = array('Name' => $name, 'Email' => $email, 'Password' => md5($password));
					$customerId = $this->customer_model->insertCustomer($customer);
					if($customerId == null) {
						$data['success'] = false;
						$data['errors'] = array('Ошибка БД');
					} else {
						$data['success'] = true;
						$customer[] = ['Id' => $customerId];
						$this->session->set_userdata('customer', $customer);
					}
				}
			}
			$this->load->template('./auth/register', $data);
		}
		public function login() {
			$sBtn = $this->input->post('sBtn');
			$data = array();
			if(isset($sBtn)) {
				$email = $this->input->post('email');
				$password = $this->input->post('pass');
				
				if(!isset($email)) {
					$data['success'] = false;
					$data['errors'] = array('Почта не указана');
				} else if(!isset($password)) {
					$data['success'] = false;
					$data['errors'] = array('Пароль не указан');
				} else {
					$customer = $this->customer_model->getCustomerByEmail($email);
					if(!$customer) {
						$data['success'] = false;
						$data['errors'] = array('Пользователь не найден');
					} else if($customer['Password'] != md5($password)) {
						$data['success'] = false;
						$data['errors'] = array('Неверный пароль');
					} else {
						$data['success'] = true;
						$this->session->set_userdata('customer', $customer);
					}
				}
			}
			$this->load->template('./auth/login', $data);
		}
	}
?>
