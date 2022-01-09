<?php
	defined('BASEPATH') OR exit('No direct script allowed');

	class Admin extends CI_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('category_model');
			$this->load->model('sale_model');
			$this->load->library('session');
		}

		public function index() {
			$this->load->template('./admin/index');
		}

		public function Categories() {
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

		// public function delete($column, $id) {
		// 	$column = $this->input->post('')
		// }
	}
?>
