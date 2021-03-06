<?php
	class good_model extends CI_Model {
		public function __construct() {
			parent::__construct();
			$this->load->database();
		}

		public function getGoods() {
			$this->db->select('g.Id, g.Good, g.Price, g.Stars, g.Description, g.PreviewImage, c.Category');
			$this->db->from('Goods as g');
			$this->db->join('Categories as c', 'g.CategoryId = c.Id');
			$goods = $this->db->get();
			return $goods->result();
		}

		public function getGoodById($id) {
			$this->db->select('g.Id, g.Good, g.Price, g.Stars, g.Description, g.PreviewImage, c.Category');
			$this->db->from('Goods as g');
			$this->db->join('Categories as c', 'g.CategoryId = c.Id');
			$this->db->where('g.Id', $id);
			$good = $this->db->get();
			return $good->result();
		}

		public function getGoodsByCategoryId($categoryId) {
			$goods = $this->db->get_where('Goods', array('CategoryId' => $categoryId));
			return $goods->result();
		}

		public function insertGood($good) {
			$this->db->insert('Goods', $good);
			$id = $this->db->insert_id();
			return $id;
		}

		public function deleteManyGoods($ids) {
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
			$res = $this->db->delete('Goods');
			return $res;
		}
	}
?>
