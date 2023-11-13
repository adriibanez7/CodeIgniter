<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listado extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductosModel');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('table');
		$this->load->library('pagination');
	}

	public function index()
	{
		$this->mostrar_listado();
	}

	public function mostrar_listado($num_registros = 5)
	{
		if ($this->input->post('num_registros')) {
			$num_registros = $this->input->post('num_registros');
		}
		$config = array();
		$config["base_url"] = base_url() . "listado/mostrar_listado";
		$config["total_rows"] = $this->ProductosModel->get_products_count();
		$config["per_page"] = $num_registros;
		$config["uri_segment"] = 3;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["productos"] = $this->ProductosModel->get_products_and_categories($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();

		$start = $page + 1;
		$end = min(($page + 1) * $config["per_page"], $config["total_rows"]);
		$total = $config["total_rows"];
		$data["pagination_text"] = "{$start} al {$end} de {$total} productos";

		$data["num_registros_selected"] = $num_registros;

		$this->load->view('listado', $data);
	}


}
