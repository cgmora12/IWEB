<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	// /home
	public function index()
	{
		$data['titulo'] = "Hola mundo (desde el controlador)";

		$this->load->view('/home/index', $data);
	}
}
