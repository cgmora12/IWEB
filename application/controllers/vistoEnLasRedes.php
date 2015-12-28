<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vistoEnLasRedes extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model("Agenda_m", '', TRUE);
	}

	// /home
	public function index()
	{
		$data['titulo'] = "Listado de la Agenda";

		$data['cuantos'] = $this->Agenda_m->count_all();
		$data['lista'] = $this->Agenda_m->get_all();

		$this->load->view('/vistoEnLasRedes/index', $data);
	}

	public function login()
	{
		$this->load->view('/vistoEnLasRedes/login');
	}
}
