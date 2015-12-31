<?php 
	class Categoria_m extends CI_model {
		function get_all() {
			$this->db->select('nombre');
			$this->db->order_by('nombre');
			return $this->db->get("Categoria")->result();
		}
	}
?>