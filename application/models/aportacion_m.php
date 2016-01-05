<?php 
	class Aportacion_m extends CI_model {

		// Para comprobar si la aportación existe
		function get_aportacionId($id) {
			$this->db->select('oid');
			$this->db->where('oid', $id);

			return $this->db->get("Aportacion")->result();
		}

		function get_aportacion($id) {
			$this->db->select('titulo, imagenUrl, fuenteUrl, fecha, creadorUserName, nombreCategoria');
			$this->db->where('oid', $id);

			return $this->db->get("Aportacion")->result();
		}

		function insert_nuevaAportacion($titulo, $imagenUrl, $fuenteUrl, $creadorUserName, $nombreCategoria) {

			$data = array(
			   'titulo' => $titulo,
			   'imagenUrl' => $imagenUrl,
			   'fuenteUrl' => $fuenteUrl,
			   'fecha' => date('Y-m-d'),
			   'creadorUserName' => $creadorUserName,
			   'nombreCategoria' => $nombreCategoria
			);

			$resultados = $this->db->insert('Aportacion', $data);
			$insert_id = $this->db->insert_id();

			return $insert_id;
		}
	}
?>