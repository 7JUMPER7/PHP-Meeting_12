<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Shop extends CI_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('good_model');
			$this->load->model('category_model');
		}

		public function index() {
			$data['categories'] = $this->category_model->getCategories();
			$filterBtn = $this->input->post('filterBtn');
			$categoryId = $this->input->post('categoryId');
			if(isset($filterBtn) && isset($categoryId)) {
				if($categoryId != 0) {
					$data['goods'] = $this->good_model->getGoodsByCategoryId($categoryId);
					$data['selectedCategoryId'] = $categoryId;
				} else {
					$data['goods'] = $this->good_model->getGoods();
				}
			} else {
				$data['goods'] = $this->good_model->getGoods();
			}
			$this->load->template('./shop/shopIndex', $data);
		}
	}
?>
