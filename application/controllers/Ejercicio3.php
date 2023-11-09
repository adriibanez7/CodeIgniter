<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ejercicio3 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->model("Productos");
		$this->load->library("pagination");
	}

	public function index()
	{
		$this->mostrar_ejercicio3();
	}

	public function mostrar_ejercicio3(){

		$config['base_url'] = base_url() . "ejercicio3";
		$config['total_rows'] = $this->Productos->get_count();
		$config['per_page'] = 2;
		$config["uri_segment"] = 2;
		$config["first_link"] = '<i class="bi bi-caret-left-fill"></i>';
		$config["last_link"] = '<i class="bi bi-caret-right-fill"></i>';
		$config["next_link"] = '<i class="bi bi-caret-right"></i>';
		$config["prev_link"] = '<i class="bi bi-caret-left"></i>';
//		$config["num_tag_open"] = '<div>';
//		$config["num_tag_close"] = '</div>';
		$config['attributes'] = array('class' => 'page-item');

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

		$data["links"] = $this->pagination->create_links();

		$data['productos'] = $this->Productos->get_products_and_categories($config["per_page"], $page);

		$this->load->view('ejercicio3', $data);
	}
}
