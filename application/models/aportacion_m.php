<?php 
	class Aportacion_m extends CI_model {
		function get_aportacion($id) {
			$this->db->select('titulo, imagenUrl, fuenteUrl, fecha, creadorUserName, nombreCategoria');
			$this->db->where('oid', $id);

			return $this->db->get("Aportacion")->result();
		}

		function get_etiquetasAportacion($idAportacion) {
			$this->db->select('etiquetaValor');
			$this->db->where('aportacionOid', $idAportacion);

			return $this->db->get("Etiqueta_aportacion")->result();
		}

		function get_comentariosAportacion($idAportacion) {
			$this->db->select('fecha, cuerpo, autorUserName');
			$this->db->where('aportacionOid', $idAportacion);

			return $this->db->get("comentario")->result();
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

		function insert_etiquetaAportacion($etiquetaValor, $aportacionOid) {

			$data = array(
			   'etiquetaValor' => $etiquetaValor,
			   'aportacionOid' => $aportacionOid
			);

			$resultados = $this->db->insert('Etiqueta_aportacion', $data);
			return $resultados;
		}
	}
?>