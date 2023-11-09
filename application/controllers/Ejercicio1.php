<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ejercicio1 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->mostrar_ejercicios();
	}

	public function mostrar_ejercicios(){
		$this->load->model("Productos");

		$data['listado1'] = $this->Productos->get_all_products();
		$data['titulo1'] = "Listado de productos";

		$data['listado2'] = $this->Productos->get_all_categories();
		$data['titulo2'] = "Listado de categorías";

		$data['listado3'] = $this->Productos->get_products_and_categories();
		$data['titulo3'] = "Listado de productos y categorías";

		$data['listado4'] = $this->Productos->get_products_with_category_zapatillas();
		$data['titulo4'] = "Listado de productos con categoría zapatillas";

		$data['listado5'] = $this->Productos->get_products_starts_with_category_zapa();
		$data['titulo5'] = "Listado de productos zapa";

		$data['listado6'] = $this->Productos->get_avg_price_products();
		$data['titulo6'] = "Media precios";

		$data['listado7'] = $this->Productos->get_products_in_category();
		$data['titulo7'] = "Listado de categorías con número de productos";

		$data['listado8'] = $this->Productos->get_category_more_10_products();
		$data['titulo8'] = "Listado de categorías con más de diez productos";

		$this->Productos->insert_2_new_products();

		$this->Productos->update_product_7();

		$this->load->view('ejercicio1', $data);
	}
}
