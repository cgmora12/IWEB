<?php 
	class EtiquetaAportacion_m extends CI_model {
		function get_etiquetasAportacion($idAportacion) {
			$this->db->select('etiquetaValor');
			$this->db->where('aportacionOid', $idAportacion);

			return $this->db->get("Etiqueta_aportacion")->result();
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