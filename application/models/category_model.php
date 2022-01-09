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

		public function insertCategory($category) {
			$this->db->insert('Categories', $category);
			$id = $this->db->insert_id();
			return $id;
		}

		public function deleteManyCategories($ids) {
			$query = '';
			$i = 0;
			foreach($ids as $id) {
				if($i == 0) {
					$query .= 'Id = '.$id;
				} else {
					$query .= ' OR Id = '.$id;
				}
				$i++;
			}
			$this->db->where($query);
			$res = $this->db->delete('Categories');
			return $res;
		}
	}
?>
