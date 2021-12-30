<?php
	class customer_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function getCustomers() {
			$customer = $this->db->get('Customers');
			return $customer->result();
		}

		public function getCustomerById($id) {
			$customer = $this->db->get_where('Customers', array('Id' => $id), 1);
			return $customer->result();
		}

		public function getCustomerByEmail($email) {
			$res = $this->db->get_where('Customers', array('Email' => $email), 1);
			$customers = $res->result_array();
			if(count($customers) == 0) {
				return null;
			}
			return $customers[0];
		}

		public function insertCustomer($customer) {
			$this->db->insert('Customers', $customer);
			$id = $this->db->insert_id();
			return $id;
		}
	}
?>
