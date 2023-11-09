<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ejercicio2 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->mostrar_ejercicio2();
	}

	public function mostrar_ejercicio2(){

		$this->load->helper('html');
		$this->load->library('table');

		$data['titulo3'] = "Listado de productos y categorías";
		echo heading($data['titulo3'], 1);

		$this->load->model("Productos");

		$this->table->set_heading( 'NOMBRE PRODUCTO', 'MARCA','PRECIO','CATEGORÍA');
		$data['listado3'] = $this->Productos->get_products_and_categories();

		$template = array(
			'table_open' => '<table style="border: 1px solid black;">'
		);

		$this->table->set_template($template);

		echo $this->table->generate($data['listado3'] );
	}
}
