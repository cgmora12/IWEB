<?php 
	class Comentario_m extends CI_model {
		function get_comentariosAportacion($idAportacion) {
			$this->db->select('fecha, cuerpo, autorUserName');
			$this->db->where('aportacionOid', $idAportacion);

			return $this->db->get("Comentario")->result();
		}

		function insert_comentarioAportacion($cuerpo, $autorUserName, $aportacionOid) {

			$data = array(
			   'fecha' => date('Y-m-d'),
			   'cuerpo' => $cuerpo,
			   'autorUserName' => $autorUserName,
			   'aportacionOid' => $aportacionOid
			);

			$resultados = $this->db->insert('Comentario', $data);
			return $resultados;
		}
	}
?>