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
			$this->db->select('c.Id, c.Name, c.Email, c.Password, c.Discount, c.Avatar, c.RoleId, r.Role');
			$this->db->from('Customers as c');
			$this->db->join('Roles as r', 'r.Id = c.RoleId');
			$this->db->where('c.Id', $id);
			$customer = $this->db->get();
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

		public function updateInfo($id, $name, $email, $avatarData) {
			$data = array(
				'Name' => $name,
				'Email' => $email,
				'Avatar' => $avatarData
			);

			$this->db->where('Id', $id);
			$this->db->update('Customers', $data);
		}
	}
?>
