<?php 
	class Usuario_m extends CI_model {
		function get_usuarioLogin($username, $password) {
			$this->db->select('userName, password');
			$this->db->where('userName', $username);
			$this->db->where('password', $password);

			return $this->db->get("Usuario")->result();
		}
	}

?>