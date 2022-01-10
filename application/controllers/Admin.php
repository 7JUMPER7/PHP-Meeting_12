<?php
	defined('BASEPATH') OR exit('No direct script allowed');

	class Admin extends CI_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('category_model');
			$this->load->model('good_model');
			$this->load->model('sale_model');
			$this->load->library('session');
		}

		function isAdmin($customer) {
			if(!isset($customer) || $customer['RoleId'] != 1) {
				return false;
			}
			return true;
		}

		// Index page
		public function index() {
			$customer = $this->session->userdata('customer');
			if(!$this->isAdmin($customer)) {
				$this->load->template('./admin/notAllowed.php');
			} else {
				$this->load->template('./admin/index');
			}
		}

		// Categories page
		public function Categories() {
			$customer = $this->session->userdata('customer');
			if(!$this->isAdmin($customer)) {
				$this->load->template('./admin/notAllowed.php');
			} else {
				$addBtn = $this->input->post('addBtn');
				if(isset($addBtn)) {
					unset($addBtn);
					$category = array('Category' => $_POST['category']);
					$this->category_model->insertCategory($category);
					redirect('/admin/categories');
				}
	
				$delBtn = $this->input->post('delBtn');
				if(isset($delBtn)) {
					unset($delBtn);
					$this->category_model->deleteManyCategories($_POST['selected']);
					redirect('/admin/categories');
				}
	
				$data = array();
				$data['categories'] = $this->category_model->getCategories();		
	
				$this->load->template('./admin/categories', $data);
			}
		}

		// Goods page
		public function Goods() {
			$customer = $this->session->userdata('customer');
			if(!$this->isAdmin($customer)) {
				$this->load->template('./admin/notAllowed.php');
			} else {
				$addBtn = $this->input->post('addBtn');
				if(isset($addBtn)) {
					unset($addBtn);
					$good = array(
						'Good' => $_POST['good'],
						'CategoryId' => $_POST['categoryId'],
						'Price' => $_POST['price'],
						'Description' => $_POST['description']
					);
					$this->good_model->insertGood($good);
					redirect('/admin/goods');
				}
	
				$delBtn = $this->input->post('delBtn');
				if(isset($delBtn)) {
					unset($delBtn);
					$this->good_model->deleteManyGoods($_POST['selected']);
					redirect('/admin/goods');
				}
	
				$data = array();
				$data['goods'] = $this->good_model->getGoods();		
				$data['categories'] = $this->category_model->getCategories();
	
				$this->load->template('./admin/goods', $data);
			}
		}
	}
?>
