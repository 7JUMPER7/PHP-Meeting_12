<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->load->model('customer_model');
			$this->load->library('session');
		}

		public function index() {
			$errors = $this->session->flashdata('errors');
			unset($_SESSION['errors']);
			$logOutBtn = $this->input->post('logOutBtn');
			if(isset($logOutBtn)) {
				$this->session->sess_destroy();
				redirect('/shop');
			}
			
			$sessCustomer = $this->session->userdata('customer');
			$data = array('isAuth' => false, 'errors' => $errors);
			
			if(isset($sessCustomer)) {
				$data['isAuth'] = true;
				$customer = $this->customer_model->getCustomerById($sessCustomer['Id']);
				if($customer) {
					$data['customer'] = $customer[0];
				}
			}

			$this->load->template('./auth/userPage', $data);
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
		public function update() {
			$sessCustomer = $this->session->userdata('customer');
			if(!isset($sessCustomer)) {
				redirect('/shop');
			} else {
				$sessCustomer['Name'] = $_POST['name'];
				$sessCustomer['Email'] = $_POST['email'];
				$errors = array();
				

				$config['upload_path'] = './assets/avatars';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']  = '1024';
				$config['max_width'] = '1024';
				$config['max_height'] = '1024';
				
				$this->load->library('upload', $config);
				$imageData = null;
				if(!$this->upload->do_upload('avatar')) {
					$error = $this->upload->display_errors('', '');
					if($error == 'The file you are attempting to upload is larger than the permitted size.') {
						$errors[] = 'Изображение должно быть меньше 1 МБ';
						// $this->session->set_flashdata('errors[]', '[Изображение должно быть меньше 1 МБ]');
					} else if($error == 'The image you are attempting to upload doesn\'t fit into the allowed dimensions.') {
						$errors[] = 'Изображение не должно превышать 1024 писелей по высоте/ширине';

						// $this->session->set_flashdata('errors[]', '[Изображение не должно превышать 1024 писелей по высоте/ширине]');
					}
					// redirect('/auth');
				} else {
					$buf = $this->upload->data();
					$imageData = file_get_contents($buf['full_path']);
					$sessCustomer['Avatar'] = $imageData;
					
					$this->load->helper("file");
					unlink($buf['full_path']); // Удаление буферного файла
				}
				
				$this->session->set_userdata('customer', $sessCustomer); // Обновление пользователя в сессии
				$res = $this->customer_model->updateInfo($sessCustomer['Id'], $_POST['name'], $_POST['email'], $imageData); // Обновление информации в БД
				if(!$res['status']) {
					$errors[] = $res['error'];
					// $this->session->set_flashdata('errors[]', $res['error']);
				}
				$this->session->set_flashdata('errors', $errors);
				var_dump($errors);
				redirect('/auth');
			}
		}
	}
?>
