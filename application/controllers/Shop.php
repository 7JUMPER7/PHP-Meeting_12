<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Shop extends CI_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('good_model');
			$this->load->model('category_model');
			$this->load->model('image_model');
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
			$this->load->template('./shop/index', $data);
		}

		public function good() {
			$goodId = $this->input->get('id');
			$goods = $this->good_model->getGoodById($goodId);
			if(!$goods) {
				$this->load->template('./errors/error404.php');
				return;
			}
			$data['good'] = $goods[0];
			$data['images'] = $this->image_model->getImagesByGoodId($data['good']->Id);
			$this->load->template('./shop/good', $data);
		}
	}
?>
