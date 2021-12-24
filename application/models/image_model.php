<?php
	class image_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function getImagesByGoodId($id) {
			$images = $this->db->get_where('Images', array('GoodId' => $id));
			return $images->result();
		}
	}
?>
