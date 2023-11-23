<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Empleados extends Administrador_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('table');
		$this->load->library('pagination');
		$this->load->library('session');
		$this->load->model('Vehiculos_model');
		$this->load->model('Reservas_model');
		$this->load->model('Empleados_model');
		$this->load->model('Administrador_model');
	}
	public function index()
	{
		self::listado();
	}

    public function listado($num_registros = 5){

		if ($this->input->post('num_registros')) {
			$num_registros = $this->input->post('num_registros');
		}

		$config = array();
		$config["base_url"] = base_url() . "zona_privada/empleados/listado";
		$config["total_rows"] = $this->Empleados_model->get_employees_count(
			$this->input->post('tx_cod_emple'),
			$this->input->post('tx_nombre'),
			$this->input->post('tx_apellidos')
		);
		$config["per_page"] = $num_registros;
		$config["uri_segment"] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$data["empleados"] = $this->Empleados_model->get_all_employees(
			$config["per_page"],
			$page,
			$this->input->post('tx_cod_emple'),
			$this->input->post('tx_nombre'),
			$this->input->post('tx_apellidos'),
			$this->input->post('order_by'),
			$this->input->post('order_dir'),
		);
//
//		var_dump($page);
//		var_dump($page+1);

		$start = $page + 1;
		$end = min(($page + 1) * $config["per_page"], $config["total_rows"]);
		$total = $config["total_rows"];
		$data["pagination_text"] = "{$start} al {$end} de {$total} empleados";

		$data["num_registros_selected"] = $num_registros;

//		 $this->data .= $data['empelados'];
//		var_dump($this->data);

        $this->load->view('administracion/empleados/listado', $data);
    }


}
