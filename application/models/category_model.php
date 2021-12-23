<?php
	class category_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function getCategories() {
			$goods = $this->db->get('Categories');
			return $goods->result();
		}

		public function getCategoryById($id) {
			$good = $this->db->get_where('Categories', array('id' => $id), 1);
			return $good->result();
		}
	}
?>
