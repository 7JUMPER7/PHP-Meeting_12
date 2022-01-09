<?php
	class sale_model extends CI_Model {
		function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function getSales() {
			$countris = $this->db->get('Sales');
			return $countris->result();
		}

		public function insertSale($sale) {
			$this->db->insert('Sales', $sale);
			$id = $this->db->insert_id();
			return $id;
		}
	}
?>
