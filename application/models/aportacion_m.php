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

		function get_aportaciones() {
			$this->db->select('oid, titulo, imagenUrl, fuenteUrl, fecha, creadorUserName, nombreCategoria');
			$this->db->order_by("oid", "desc");
			return $this->db->get("Aportacion")->result();
		}

		function get_aportacionesByBusqueda($busqueda) {
			$this->db->select('oid, titulo, imagenUrl, fuenteUrl, fecha, creadorUserName, nombreCategoria');
			$this->db->where('titulo', $busqueda);
			$this->db->order_by("oid", "desc");
			return $this->db->get("Aportacion")->result();
		}

		function get_aportaciones_by_categoria($categoria) {
			$this->db->select('oid, titulo, imagenUrl, fuenteUrl, fecha, creadorUserName, nombreCategoria');
			$this->db->where('nombreCategoria', $categoria);
			$this->db->order_by("oid", "desc");
			return $this->db->get("Aportacion")->result();
		}

		function get_aportaciones_5($limit, $start){
			if($start > 1)
				$start = ($start - 1)*5;
			$this->db->limit($limit,$start);
			$this->db->select('oid, titulo, imagenUrl, fuenteUrl, fecha, creadorUserName, nombreCategoria');
			$this->db->order_by("oid", "desc");
			return $this->db->get("Aportacion")->result();
		}

		function get_aportaciones_5_by_usuario($limit, $start, $userName){
			if($start > 1)
				$start = ($start - 1)*5;
			$this->db->limit($limit,$start);
			$this->db->select('oid, titulo, imagenUrl, fuenteUrl, fecha, creadorUserName, nombreCategoria');
			$this->db->where('creadorUserName', $userName);
			$this->db->order_by("oid", "desc");
			return $this->db->get("Aportacion")->result();
		}

		function get_aportaciones_5_by_categoria($limit, $start, $categoria){
			if($start > 1)
				$start = ($start - 1)*5;
			$this->db->limit($limit,$start);
			$this->db->select('oid, titulo, imagenUrl, fuenteUrl, fecha, creadorUserName, nombreCategoria');
			$this->db->where('nombreCategoria', $categoria);
			$this->db->order_by("oid", "desc");
			return $this->db->get("Aportacion")->result();
		}

		function get_aportacionesByBusqueda_5($limit, $start, $busqueda) {
			if($start > 1)
				$start = ($start - 1)*5;
			$this->db->limit($limit,$start);
			$this->db->select('oid, titulo, imagenUrl, fuenteUrl, fecha, creadorUserName, nombreCategoria');
			$this->db->like('titulo', $busqueda);
			$this->db->order_by("oid", "desc");
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