<?php 
	class Reporte_m extends CI_model {
		function insert_nuevoReporte($motivo, $aportacionOid, $reportadorUserName) {
			$data = array(
			   'motivo' => $motivo,
			   'aportacionOid' => $aportacionOid,
			   'reportadorUserName' => $reportadorUserName
			);

			$resultados = $this->db->insert('Reporte', $data);
			return $resultados;
		}
	}
?>