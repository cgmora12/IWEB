<?php 
	class Usuario_m extends CI_model {
		function get_usuarioLogin($username, $password) {
			$this->db->select('userName, password');
			$this->db->where('userName', $username);
			$this->db->where('password', $password);

			return $this->db->get("Usuario")->result();
		}

		function insert_usuarioRegistrado($username, $password, $email, $avatar, $pais, $provincia, $localidad, $fechaNacimiento, $sexo, $paginaWeb) {

			$data = array(
			   'userName' => $username,
			   'password' => $password,
			   'email' => $email,
			   'avatarUrl' => $avatar,
			   'pais' => $pais,
			   'provincia' => $provincia,
			   'localidad' => $localidad,
			   'fechaNacimiento' => date('Y-m-d', strtotime($fechaNacimiento)),
			   'sexo' => $sexo,
			   'paginaWeb' => $paginaWeb,
			   'fechaRegistro' => date('Y-m-d')
			);

			$resultados = $this->db->insert('Usuario', $data);
			return $resultados;
		}
	}

?>