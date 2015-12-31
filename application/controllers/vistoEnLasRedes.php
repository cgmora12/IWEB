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
			$this->load->model("Categoria_m", '', TRUE);
			$this->load->model("Etiqueta_m", '', TRUE);
			$this->load->model("Reporte_m", '', TRUE);
		}

		// Página principal
		public function index()
		{
			// Porque si no está el sufijo 'index' en la URL, el logout no funciona bien.
			// Si la URL tiene el sufijo 'index'
			if(endsWith($_SERVER['PHP_SELF'], "index")) {

				$data['titulo'] = "Listado de la Agenda";

				$data['cuantos'] = $this->Agenda_m->count_all();
				$data['lista'] = $this->Agenda_m->get_all();

				$this->load->view('/vistoEnLasRedes/index', $data);
			}
			// Si la URL es   http://localhost:8080/iweb/index.php/vistoEnLasRedes
			// redirecciona a http://localhost:8080/iweb/index.php/vistoEnLasRedes/index
			else {
				header('Location: /iweb/index.php/vistoEnLasRedes/index');
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

				echo "<script>  alert('Login correcto');
								window.location.href = 'index';
					   </script>"
				;
			}
			else {
				echo "<script>  alert('Usuario y/o contraseña incorrectos');
								window.history.back();
					   </script>"
				;
			}
		}


		// Funcionalidad logout
		public function hacerLogout()
		{
			// Se elimina el valor almacenado en la sesión.
			$this->session->unset_userdata('usuarioLogueado');
			echo "<script>  alert('Logout correcto');
							window.location.href = 'login';
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
				echo "<script>  alert('Usuario registrado correctamente');
							window.location.href = 'login';
				   </script>"
				;
			}
			else {
				echo "<script>  alert('Nombre de usuario y/o email ya registrados');
							window.history.back();
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
				echo "<script>  alert('Los datos del usuario con email " . $email . " son:\\n";
				echo "\\nUserName: " . $resultados[0]->userName . "\\n";
				echo "\\nContraseña: " . $resultados[0]->password . "');";
				echo "window.location.href = 'login';";
				echo "</script>";
			}
			else {
				echo "<script>  alert('El email introducido no corresponde con ningún usuario registrado');
								window.history.back();
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
				// Etiquetas
				$resultadosEtiquetas = $this->Aportacion_m->get_etiquetasAportacion($id);
				$datos['listaEtiquetas'] = $resultadosEtiquetas;
				$datos['numEtiquetas'] = count($resultadosEtiquetas);
				// Comentarios
				$resultadosComentarios = $this->Aportacion_m->get_comentariosAportacion($id);
				$datos['listaComentarios'] = $resultadosComentarios;
				$datos['numComentarios'] = count($resultadosComentarios);

				$this->load->view('/vistoEnLasRedes/verAportacion', $datos);
			}
			else {
				echo "No existe ninguna aportación con id " . $id;
			}
		}


		// Funcionalidad comentar aportación
		public function comentarAportacion($id)
		{
			$resultados = $this->Aportacion_m->insert_comentarioAportacion($_POST['comentario'], 
													$this->session->userdata('usuarioLogueado'), $id);

			if($resultados) {
				$this->Usuario_m->aumentarNumComentarios($this->session->userdata('usuarioLogueado'));
				echo "<script>  alert('Comentario añadido correctamente');
							window.location.href = '/iweb/index.php/vistoEnLasRedes/aportaciones/" . $id .  "';
				   </script>"
				;
			}
			else {
				echo "<script>  alert('No se ha podido guardar el comentario');
							window.history.back();
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
					$resultadosEtiquetas = $this->Aportacion_m->insert_etiquetaAportacion($_POST['etiqueta'], $idInsertado);
				}

				echo "<script>  alert('Aportación guardada correctamente');
							window.location.href = '/iweb/index.php/vistoEnLasRedes/aportaciones/" . $idInsertado . "';
				   </script>"
				;
			}
			else {
				echo "<script>  alert('No se ha podido guardar la aportación');
							window.history.back();
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

				echo "<script>  alert('Reporte guardado correctamente');
							window.location.href = '/iweb/index.php/vistoEnLasRedes/aportaciones/" . $idAportacion . "';
				   </script>"
				;
			}
			else {
				echo "<script>  alert('No se ha podido guardar el reporte');
							window.history.back();
				   </script>"
				;
			}
		}
	}
?>