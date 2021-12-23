<?php
	class good_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function getGoods() {
			$goods = $this->db->get('Goods');
			return $goods->result();
		}

		public function getGoodById($id) {
			$good = $this->db->get_where('Goods', array('id' => $id), 1);
			return $good->result();
		}

		public function getGoodsByCategoryId($categoryId) {
			$goods = $this->db->get_where('Goods', array('CategoryId' => $categoryId));
			return $goods->result();
		}
	}
?>