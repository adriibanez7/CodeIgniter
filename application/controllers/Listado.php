<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listado extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductosModel');
		$this->load->helper('string_helper');
		$this->load->helper('html');
		$this->load->library('table');
	}

	public function index()
	{
		$this->mostrar_listado();
	}

	public function mostrar_listado()
	{
		$data['listado'] = array(
			'vacio'=>'',
			'null'=>null,
			'fecha0'=>'0000-00-00, 0000-00-00 00:00:00',
			'patatas'=>'patatas',
			'peras'=>'peras'
		);


		$this->load->view('listado', $data);
	}


}
