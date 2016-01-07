<?php 
	class Comentario_m extends CI_model {
		function get_comentariosAportacion($idAportacion) {
			$this->db->select('fecha, cuerpo, autorUserName');
			$this->db->where('aportacionOid', $idAportacion);

			return $this->db->get("Comentario")->result();
		}

		function get_comentariosUsuario($userName) {
			$this->db->select('oid, fecha, cuerpo, autorUserName');
			$this->db->where('autorUserName', $userName);
			$this->db->order_by("oid", "desc");

			return $this->db->get("Comentario")->result();
		}

		function get_comentarios_5($limit, $start, $idAportacion){
			if($start > 1)
				$start = ($start - 1)*5;
			$this->db->limit($limit,$start);
			$this->db->select('fecha, cuerpo, autorUserName');
			$this->db->where('aportacionOid', $idAportacion);

			return $this->db->get("Comentario")->result();
		}

		function get_comentarios_5_by_usuario($limit, $start, $userName){
			if($start > 1)
				$start = ($start - 1)*5;
			$this->db->limit($limit,$start);
			$this->db->select('oid, fecha, cuerpo, autorUserName');
			$this->db->where('autorUserName', $userName);
			$this->db->order_by("oid", "desc");
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