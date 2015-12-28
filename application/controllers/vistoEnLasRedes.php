<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	// La codificación de los mensajes para todo el archivo.
	header('Content-Type: text/html; charset=UTF-8');

	class vistoEnLasRedes extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model("Agenda_m", '', TRUE);

			$this->load->library('session');
			$this->load->model("Usuario_m", '', TRUE);
		}

		// Página principal
		public function index()
		{
			$data['titulo'] = "Listado de la Agenda";

			$data['cuantos'] = $this->Agenda_m->count_all();
			$data['lista'] = $this->Agenda_m->get_all();

			$this->load->view('/vistoEnLasRedes/index', $data);
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

				$this->load->view('/vistoEnLasRedes/index');
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
			if(count($resultados) == 1) {
				$this->session->set_userdata('usuarioLogueado', $resultados[0]->userName);

				echo "<script>  alert('Login correcto');
								window.location.href = 'index';
					   </script>"
				;
			}
			else {
				echo "<script>  alert('Usuario y/o contraseña incorrectos');
								window.location.href = 'login';
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
	}
?>