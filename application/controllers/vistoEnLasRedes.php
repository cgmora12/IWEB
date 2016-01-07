<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// La codificación de los mensajes para todo el archivo.
	header('Content-Type: text/html; charset=UTF-8');

	function endsWith($str1, $str2)
	{
	    $length = strlen($str2);
	    if ($length == 0) {
	        return true;
	    }

	    return (substr($str1, -$length) === $str2);
	}

	class vistoEnLasRedes extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model("Agenda_m", '', TRUE);

			$this->load->library('session');
			$this->load->model("Usuario_m", '', TRUE);
			$this->load->model("Aportacion_m", '', TRUE);
			$this->load->model("EtiquetaAportacion_m", '', TRUE);
			$this->load->model("Comentario_m", '', TRUE);
			$this->load->model("Categoria_m", '', TRUE);
			$this->load->model("Etiqueta_m", '', TRUE);
			$this->load->model("Reporte_m", '', TRUE);
		}

		// Página principal
		public function index()
		{
			$this->load->library('pagination');

		    $opciones = array();
		    $desde = ($this->uri->segment($this->uri->total_segments())) ? $this->uri->segment($this->uri->total_segments()) : 0;
		 
		    $opciones['per_page'] = 5;
		    $opciones['base_url'] = base_url().'/vistoEnLasRedes/index';
		    $opciones['total_rows'] = count($this->Aportacion_m->get_aportaciones());
		    $opciones['uri_segment'] = $this->uri->total_segments();
		    $opciones['use_page_numbers'] = true;
		    $opciones['full_tag_open'] = "<ul class='pagination'>";
			$opciones['full_tag_close'] ="</ul>";
			$opciones['num_tag_open'] = '<li>';
			$opciones['num_tag_close'] = '</li>';
			$opciones['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$opciones['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$opciones['next_tag_open'] = "<li>";
			$opciones['next_tagl_close'] = "</li>";
			$opciones['prev_tag_open'] = "<li>";
			$opciones['prev_tagl_close'] = "</li>";
			$opciones['first_tag_open'] = "<li>";
			$opciones['first_tagl_close'] = "</li>";
			$opciones['last_tag_open'] = "<li>";
			$opciones['last_tagl_close'] = "</li>";
		 
		    $this->pagination->initialize($opciones);
		 
			$resultados = $this->Aportacion_m->get_aportaciones_5($opciones['per_page'],$desde);
			$datos['aportaciones'] = $resultados;
			$datos['categoria'] = null;
			$datos['busqueda'] = null;
		    $datos['paginacion'] = $this->pagination->create_links();
		 
			$this->load->view('/vistoEnLasRedes/index', $datos);
			
		}

		// Página principal filtrada por categoria
		public function verCategorias()
		{
			
			$resultados = $this->Categoria_m->get_all();
			$datos['categorias'] = $resultados;
		 
			$this->load->view('/vistoEnLasRedes/verCategorias', $datos);
			
		}

		// Página principal filtrada por categoria
		public function categoria($nombre)
		{
			$this->load->library('pagination');

		    $opciones = array();
		    $desde = ($this->uri->segment($this->uri->total_segments())) ? $this->uri->segment($this->uri->total_segments()) : 0;
		 
		    $opciones['per_page'] = 5;
		    $opciones['base_url'] = base_url().'/vistoEnLasRedes/index';
		    $opciones['total_rows'] = count($this->Aportacion_m->get_aportaciones_by_categoria($nombre));
		    $opciones['uri_segment'] = $this->uri->total_segments();
		    $opciones['use_page_numbers'] = true;
		    $opciones['full_tag_open'] = "<ul class='pagination'>";
			$opciones['full_tag_close'] ="</ul>";
			$opciones['num_tag_open'] = '<li>';
			$opciones['num_tag_close'] = '</li>';
			$opciones['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$opciones['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$opciones['next_tag_open'] = "<li>";
			$opciones['next_tagl_close'] = "</li>";
			$opciones['prev_tag_open'] = "<li>";
			$opciones['prev_tagl_close'] = "</li>";
			$opciones['first_tag_open'] = "<li>";
			$opciones['first_tagl_close'] = "</li>";
			$opciones['last_tag_open'] = "<li>";
			$opciones['last_tagl_close'] = "</li>";
		 
		    $this->pagination->initialize($opciones);
		 
			$resultados = $this->Aportacion_m->get_aportaciones_5_by_categoria($opciones['per_page'],$desde, $nombre);
			$datos['categoria'] = $nombre;
			$datos['busqueda'] = null;
			$datos['aportaciones'] = $resultados;
		    $datos['paginacion'] = $this->pagination->create_links();
		 
			$this->load->view('/vistoEnLasRedes/index', $datos);
			
		}


		// Funcionalidad buscar
		public function buscar()
		{
			$this->load->view('/vistoEnLasRedes/buscar');
			
		}

		public function busqueda()
		{

			$this->load->library('pagination');

		    $opciones = array();
		    $desde = ($this->uri->segment($this->uri->total_segments())) ? $this->uri->segment($this->uri->total_segments()) : 0;
		 
		    $opciones['per_page'] = 5;
		    $opciones['base_url'] = base_url().'/vistoEnLasRedes/index';
		    $opciones['total_rows'] = count($this->Aportacion_m->get_aportacionesByBusqueda($_POST['textoBusqueda']));
		    $opciones['uri_segment'] = $this->uri->total_segments();
		    $opciones['use_page_numbers'] = true;
		    $opciones['full_tag_open'] = "<ul class='pagination'>";
			$opciones['full_tag_close'] ="</ul>";
			$opciones['num_tag_open'] = '<li>';
			$opciones['num_tag_close'] = '</li>';
			$opciones['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
			$opciones['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
			$opciones['next_tag_open'] = "<li>";
			$opciones['next_tagl_close'] = "</li>";
			$opciones['prev_tag_open'] = "<li>";
			$opciones['prev_tagl_close'] = "</li>";
			$opciones['first_tag_open'] = "<li>";
			$opciones['first_tagl_close'] = "</li>";
			$opciones['last_tag_open'] = "<li>";
			$opciones['last_tagl_close'] = "</li>";
		 
		    $this->pagination->initialize($opciones);
		 
			$resultados = $this->Aportacion_m->get_aportacionesByBusqueda_5($opciones['per_page'], $desde, $_POST['textoBusqueda']);
			$datos['categoria'] = null;
			$datos['busqueda'] = $_POST['textoBusqueda'];
			$datos['aportaciones'] = $resultados;
		    $datos['paginacion'] = $this->pagination->create_links();
		 
			$this->load->view('/vistoEnLasRedes/index', $datos);
		}


		// Funcionalidad faq
		public function faq()
		{
			$this->load->view('/vistoEnLasRedes/faq');
			
		}


		// Funcionalidad faq
		public function acercade()
		{
			$this->load->view('/vistoEnLasRedes/acercade');
			
		}


		// Funcionalidad perfil
		public function perfil($userName)
		{
			$datos['userName'] = $userName;
			$resultados = $this->Usuario_m->get_usuarioByUsername($userName);

			// Si es correcto sólo devolverá un usuario
			if(count($resultados) == 1) {

				$datos['usuario'] = $resultados[0];

				$this->load->view('/vistoEnLasRedes/perfil', $datos);
			}
			else {
				echo "No existe ningun usuario con username " . $userName;
			}
			
		}


		// Funcionalidad ver aportaciones de un usuario
		public function verAportacionesUsuario($userName)
		{
			$datos['userName'] = $userName;
			$resultados = $this->Usuario_m->get_usuarioByUsername($userName);

			// Si es correcto sólo devolverá un usuario
			if(count($resultados) == 1) {

				$datos['usuario'] = $resultados[0];

				$this->load->library('pagination');

			    $opciones = array();
			    $desde = ($this->uri->segment($this->uri->total_segments())) ? $this->uri->segment($this->uri->total_segments()) : 0;
			 
			    $opciones['per_page'] = 5;
			    $opciones['base_url'] = base_url().'/vistoEnLasRedes/verAportacionesUsuario/' . $userName;
			    $opciones['total_rows'] = count($this->Aportacion_m->get_aportacionesByUsuario($userName));
			    $opciones['uri_segment'] = $this->uri->total_segments();
			    $opciones['use_page_numbers'] = true;
			    $opciones['full_tag_open'] = "<ul class='pagination'>";
				$opciones['full_tag_close'] ="</ul>";
				$opciones['num_tag_open'] = '<li>';
				$opciones['num_tag_close'] = '</li>';
				$opciones['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$opciones['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$opciones['next_tag_open'] = "<li>";
				$opciones['next_tagl_close'] = "</li>";
				$opciones['prev_tag_open'] = "<li>";
				$opciones['prev_tagl_close'] = "</li>";
				$opciones['first_tag_open'] = "<li>";
				$opciones['first_tagl_close'] = "</li>";
				$opciones['last_tag_open'] = "<li>";
				$opciones['last_tagl_close'] = "</li>";
			 
			    $this->pagination->initialize($opciones);
		    	$datos['paginacion'] = $this->pagination->create_links();
			 
				$aportaciones = $this->Aportacion_m->get_aportaciones_5_by_usuario($opciones['per_page'],$desde, $userName);

				$datos['aportacionesUsuario'] = $aportaciones;

				$this->load->view('/vistoEnLasRedes/verAportacionesUsuario', $datos);
			}
			else {
				echo "No existe ningun usuario con username " . $userName;
			}
			
		}


		// Funcionalidad ver aportaciones de un usuario
		public function verComentariosUsuario($userName)
		{
			$datos['userName'] = $userName;
			$resultados = $this->Usuario_m->get_usuarioByUsername($userName);

			// Si es correcto sólo devolverá un usuario
			if(count($resultados) == 1) {

				$datos['usuario'] = $resultados[0];
				
				$this->load->library('pagination');

			    $opciones = array();
			    $desde = ($this->uri->segment($this->uri->total_segments())) ? $this->uri->segment($this->uri->total_segments()) : 0;
			 
			    $opciones['per_page'] = 5;
			    $opciones['base_url'] = base_url().'/vistoEnLasRedes/verComentariosUsuario/' . $userName;
			    $opciones['total_rows'] = count($this->Comentario_m->get_comentariosUsuario($userName));
			    $opciones['uri_segment'] = $this->uri->total_segments();
			    $opciones['use_page_numbers'] = true;
			    $opciones['full_tag_open'] = "<ul class='pagination'>";
				$opciones['full_tag_close'] ="</ul>";
				$opciones['num_tag_open'] = '<li>';
				$opciones['num_tag_close'] = '</li>';
				$opciones['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$opciones['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$opciones['next_tag_open'] = "<li>";
				$opciones['next_tagl_close'] = "</li>";
				$opciones['prev_tag_open'] = "<li>";
				$opciones['prev_tagl_close'] = "</li>";
				$opciones['first_tag_open'] = "<li>";
				$opciones['first_tagl_close'] = "</li>";
				$opciones['last_tag_open'] = "<li>";
				$opciones['last_tagl_close'] = "</li>";
			 
			    $this->pagination->initialize($opciones);
		    	$datos['paginacion'] = $this->pagination->create_links();
			 
				$comentarios = $this->Comentario_m->get_comentarios_5_by_usuario($opciones['per_page'],$desde, $userName);

				$datos['comentariosUsuario'] = $comentarios;

				$this->load->view('/vistoEnLasRedes/verComentariosUsuario', $datos);
			}
			else {
				echo "No existe ningun usuario con username " . $userName;
			}
			
		}

		// Funcionalidad login
		public function login()
		{
			// Si el usuario ya se ha logueado, que entre al index
			if($this->session->userdata('usuarioLogueado')) {
				echo "<script>  alert('Usuario logueado: " . $this->session->userdata('usuarioLogueado') . "');
								window.location.href = 'index';
					   </script>"
				;
			}
			// Si aún no se ha loguedao, que tenga que loguearse previamente.
			else {
				$this->load->view('/vistoEnLasRedes/login');
			}
		}

		public function hacerLogin()
		{
			$resultados = $this->Usuario_m->get_usuarioLogin($_POST['username'], $_POST['password']);

			// Si es correcto sólo devolverá un usuario
			if(count($resultados) == 1 && $resultados[0]->userName != "Anónimo") {
				$this->session->set_userdata('usuarioLogueado', $resultados[0]->userName);
				$this->session->set_flashdata('login', 'Bienvenid@ ' . $resultados[0]->userName . '!');

				echo "<script> window.location.href = 'index';
					   </script>"
				;
			}
			else {

				$this->session->set_flashdata('login', 'Usuario y/o contraseña incorrectos');
				echo "<script>  window.location.href = 'login';
					   </script>"
				;
			}
		}


		// Funcionalidad logout
		public function hacerLogout()
		{
			// Se elimina el valor almacenado en la sesión.
			$this->session->unset_userdata('usuarioLogueado');
			$this->session->set_flashdata('login', 'Logout correcto.');
			echo "<script> window.location.href = 'login';
				   </script>"
			;
		}


		// Funcionalidad registro
		public function registro()
		{
			// Si el usuario ya se ha logueado, que entre al index
			if($this->session->userdata('usuarioLogueado')) {
				echo "<script>  alert('Usuario logueado: " . $this->session->userdata('usuarioLogueado') . "');
								window.location.href = 'index';
					   </script>"
				;
			}
			// Si aún no se ha loguedao, que tenga que loguearse previamente.
			else {
				$this->load->view('/vistoEnLasRedes/registro');
			}
		}

		public function hacerRegistro()
		{
			$resultados = $this->Usuario_m->insert_usuarioRegistrado($_POST['username'], $_POST['password'], $_POST['email'], 
				$_POST['avatar'], $_POST['pais'], $_POST['provincia'], $_POST['localidad'], $_POST['fechaNacimientoInput'], 
				$_POST['sexo'], $_POST['paginaWeb']);

			if($resultados) {
				$this->session->set_flashdata('login', 'Usuario registrado correctamente. Inicie sesión con su nueva cuenta.');
				echo "<script>  window.location.href = 'login';
				   </script>"
				;
			}
			else {
				$this->session->set_flashdata('registro', 'Nombre de usuario y/o email ya registrados. Inténtelo de nuevo.');
				echo "<script>  window.history.back();
								window.location.reload();
				   </script>"
				;
			}
		}


		// Funcionalidad recuperar contraseña
		public function recuperarContrasenya()
		{
			// Si el usuario ya se ha logueado, que entre al index
			if($this->session->userdata('usuarioLogueado')) {
				echo "<script>  alert('Usuario logueado: " . $this->session->userdata('usuarioLogueado') . "');
								window.location.href = 'index';
					   </script>"
				;
			}
			// Si aún no se ha loguedao, que tenga que loguearse previamente.
			else {
				$this->load->view('/vistoEnLasRedes/recuperarContrasenya');
			}
		}

		public function hacerRecuperacionDatos()
		{
			$email = $_POST['email'];
			$resultados = $this->Usuario_m->get_usuarioRecuperacionDatos($email);

			// Si es correcto sólo devolverá un usuario
			if(count($resultados) == 1  && $resultados[0]->userName != "Anónimo") {
				// Enviar email
				/*
				 * El email no funciona. La función PHP me devuelve true pero no los recibo ni en hotmail ni el gmail. 
				 * He buscado información, he configurado Xampp y seguido varías guías pero no consigo que funcione.
				 * Email creado para el proyecto: 
				 * Correo: vistoenlasredesIW@gmail.com
				 * Contraseña: vistoenlasredesIW1A
				*/
				/*
				// Asunto
				$asunto = 'Visto en las redes Ingeniería Web - Recuperación datos de acceso';
				// El mensaje
				$mensaje = "Buenas,\r\n
							Ha recibido este mensaje porque ha solicitado la recuperación de los 
							datos de su cuenta en la web Visto en las redes de Ingeniería Web\r\n
							Por favor, ignore este mensaje en el caso que no haya solicitado la recuperación de sus datos.\r\n
							\r\n
							Sus datos de acceso son: \r\n
							UserName: " . $resultados[0]->userName . "\r\n
							Password: " . $resultados[0]->password . "\r\n
							Email: " . $email . "\r\n
							\r\n
							--------- \r\n
							El equipo de Visto en las redes de Ingeniería Web"
				;
				// Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
				$mensaje = wordwrap($mensaje, 70, "\r\n");

				// Cabeceras
				$cabeceras = 'From: no_reply@vistoenlasredesIW.com';

				// Enviarlo
				$enviado = mail($email, $asunto, $mensaje, $cabeceras);

				if($enviado) {
					echo "<script>  alert('Se ha enviado un email a " . $email . " con los datos para acceder a la web');
									window.location.href = 'login';
						   </script>"
					;
				}
				else {
					echo "<script>  alert('No se ha podido enviar el email a " . $email . ". Por favor, vuelva a intentarlo');
									window.location.href = 'login';
						   </script>"
					;
				}
				*/

				// Como lo del email no funciona, muestro los datos si el email es correcto.
				$this->session->set_flashdata('login', 'Los datos del usuario con email ' . $email . ' son: <p style="margin-top: 5px; margin-left:20px;"> Usuario: '
					. $resultados[0]->userName . '</p><p style="margin-top: 5px; margin-left:20px;"> Contraseña: ' . $resultados[0]->password . '</p>');
				echo "<script> window.location.href = 'login'; </script>";
			}
			else {
				$this->session->set_flashdata('recuperarContrasenya', 'El email introducido no corresponde con ningún usuario registrado.');
				echo "<script> window.location.href = 'recuperarContrasenya';
					   </script>"
				;
			}
		}


		// Funcionalidad ver aportación con comentarios
		public function verAportacion($id)
		{
			$datos['idAportacion'] = $id;
			$resultados = $this->Aportacion_m->get_aportacion($id);

			// Si es correcto sólo devolverá una aportación
			if(count($resultados) == 1) {
				// Aportación (ya tiene la categoría)
				$datos['aportacion'] = $resultados[0];
				
				$this->load->library('pagination');

			    $opciones = array();
			    $desde = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			 
			    $opciones['per_page'] = 5;
			    $opciones['base_url'] = base_url().'/vistoEnLasRedes/verAportacion/' . $id;
			    $opciones['total_rows'] = count($this->Comentario_m->get_comentariosAportacion($id));
			    $opciones['uri_segment'] = 4;
			    $opciones['use_page_numbers'] = true;
			    $opciones['full_tag_open'] = "<ul class='pagination'>";
				$opciones['full_tag_close'] ="</ul>";
				$opciones['num_tag_open'] = '<li>';
				$opciones['num_tag_close'] = '</li>';
				$opciones['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
				$opciones['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
				$opciones['next_tag_open'] = "<li>";
				$opciones['next_tagl_close'] = "</li>";
				$opciones['prev_tag_open'] = "<li>";
				$opciones['prev_tagl_close'] = "</li>";
				$opciones['first_tag_open'] = "<li>";
				$opciones['first_tagl_close'] = "</li>";
				$opciones['last_tag_open'] = "<li>";
				$opciones['last_tagl_close'] = "</li>";
			 
			    $this->pagination->initialize($opciones);
		    	$datos['paginacion'] = $this->pagination->create_links();
		    	$datos['paginaActual'] = $desde;
			 

				// Etiquetas
				$resultadosEtiquetas = $this->EtiquetaAportacion_m->get_etiquetasAportacion($id);
				$datos['listaEtiquetas'] = $resultadosEtiquetas;
				$datos['numEtiquetas'] = count($resultadosEtiquetas);
				// Comentarios
				$comentarios = $this->Comentario_m->get_comentarios_5($opciones['per_page'], $desde, $id);
				$datos['listaComentarios'] = $comentarios;
				$datos['numComentarios'] = count($comentarios);

				$this->load->view('/vistoEnLasRedes/verAportacion', $datos);
			}
			else {
				echo "No existe ninguna aportación con id " . $id;
			}
		}


		// Funcionalidad comentar aportación
		public function comentarAportacion($id)
		{
			$resultados = $this->Comentario_m->insert_comentarioAportacion($_POST['comentario'], 
													$this->session->userdata('usuarioLogueado'), $id);

			if($resultados) {
				$this->Usuario_m->aumentarNumComentarios($this->session->userdata('usuarioLogueado'));
				$this->session->set_flashdata('añadir', 'Comentario añadido correctamente.');
				echo "<script>  window.location.href = '/IWEB/vistoEnLasRedes/verAportacion/" . $id .  "';
				   </script>"
				;
			}
			else {
				$this->session->set_flashdata('añadir', 'No se ha podido guardar el comentario.');
				echo "<script>  window.location.href = '/IWEB/vistoEnLasRedes/verAportacion/" . $id .  "';
				   </script>"
				;
			}
		}


		// Funcionalidad enviar aportación
		public function enviarAportacion()
		{
			// Categorías
			$resultadosCategorias = $this->Categoria_m->get_all();
			$datos['listaCategorias'] = $resultadosCategorias;
			$datos['numCategorias'] = count($resultadosCategorias);

			// Etiquetas
			$resultadosEtiquetas = $this->Etiqueta_m->get_all();
			$datos['listaEtiquetas'] = $resultadosEtiquetas;
			$datos['numEtiquetas'] = count($resultadosEtiquetas);

			$this->load->view('/vistoEnLasRedes/enviarAportacion', $datos);
		}

		public function guardarAportacion()
		{
			$idInsertado = $this->Aportacion_m->insert_nuevaAportacion($_POST['titulo'], $_POST['imagen'], $_POST['fuente'],
																		$_POST['username'], $_POST['categoria']);
			
			if($idInsertado) {
				$this->Usuario_m->aumentarNumAportaciones($_POST['username']);

				if($_POST['etiqueta'] != "sinElegir") {
					$resultadosEtiquetas = $this->EtiquetaAportacion_m->insert_etiquetaAportacion($_POST['etiqueta'], $idInsertado);
				}

				$this->session->set_flashdata('añadir', 'Aportación guardada correctamente.');

				echo "<script>  window.location.href = '/IWEB/vistoEnLasRedes/verAportacion/" . $idInsertado . "';
				   </script>"
				;
			}
			else {
				$this->session->set_flashdata('añadir', 'No se ha podido guardar la aportación.');
				echo "<script>  window.location.href = '/IWEB/vistoEnLasRedes/verAportacion/" . $idInsertado . "';
				   </script>"
				;
			}
		}


		// Funcionalidad reportar aportación
		public function reportarAportacion($id)
		{
			$datos['idAportacion'] = $id;
			// Sólo me hace falta para comprobar si existe una aportación con ese id
			$resultados = $this->Aportacion_m->get_aportacionId($id);

			// Si es correcto sólo devolverá una aportación
			if(count($resultados) == 1) {

				$this->load->view('/vistoEnLasRedes/reportarAportacion', $datos);
			}
			else {
				echo "No existe ninguna aportación con id " . $id;
			}
		}

		public function guardarReporteAportacion($idAportacion)
		{
			$resultados = $this->Reporte_m->insert_nuevoReporte($_POST['motivo'], $idAportacion, $_POST['username']);
			
			if($resultados) {
				$this->session->set_flashdata('añadir', 'Reporte guardado correctamente.');

				echo "<script>  window.location.href = '/IWEB/vistoEnLasRedes/verAportacion/" . $idAportacion . "';
				   </script>"
				;
			}
			else {
				$this->session->set_flashdata('añadir', 'No se ha podido guardar el reporte.');
				echo "<script>  window.location.href = '/IWEB/vistoEnLasRedes/verAportacion/" . $idAportacion . "';
				   </script>"
				;
			}
		}
	}
?>