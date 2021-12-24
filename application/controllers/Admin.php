<?php
	defined('BASEPATH') OR exit('No direct script allowed');

	class Admin extends CI_Controller {
		public function index() {
			$this->load->template('./admin/index');
		}

		public function add() {
			
		}

		// public function delete($column, $id) {
		// 	$column = $this->input->post('')
		// }
	}
?>
