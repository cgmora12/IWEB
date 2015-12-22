<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda2 extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');

	}

	public function index(){

		$crud = new grocery_CRUD();

		$crud->set_theme('datatables');
		$crud->set_table('agenda');
		$crud->set_subject('Listado de la agenda');

		$output = $crud->render();
		$this->load->view('agenda2/index', $output);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */