<?php 
	class Etiqueta_m extends CI_model {
		function get_all() {
			$this->db->select('valor');
			$this->db->order_by('valor');
			return $this->db->get("Etiqueta")->result();
		}
	}
?>