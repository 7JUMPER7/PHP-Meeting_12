<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Shop extends CI_Controller {
		function __construct() {
			parent::__construct();
			$this->load->model('good_model');
		}

		public function index() {
			// $this->load->view('./shop/shopIndex');
			$data['goods'] = $this->good_model->getGoods();
			$this->load->template('./shop/shopIndex', $data);
		}
	}
?>
