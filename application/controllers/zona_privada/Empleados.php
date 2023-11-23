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
		$config["base_url"] = base_url() . "empleados/listado";
		$config["total_rows"] = $this->Empleados_model->get_employees_count(
			$this->input->post('tx_cod_emple'),
			$this->input->post('tx_nombre'),
			$this->input->post('tx_apellidos')
		);
		$config["per_page"] = $num_registros;
		$config["uri_segment"] = 5;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

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




	public function mostrar_vehiculos($num_registros = 5)
	{
		if ($this->input->post('num_registros')) {
			$num_registros = $this->input->post('num_registros');
		}

//		$this->Administrador_model->add_new_admin('Rodrigo','Muñoz Lanuza','romunoz@gmail.com','1234');


		$config = array();
		$config["base_url"] = base_url() . "empleados/mostrar_vehiculos";
		$config["total_rows"] = $this->Vehiculos_model->get_vehicles_count(
			$this->input->post('tx_marca'),
			$this->input->post('tx_modelo'),
			$this->input->post('tx_matricula')
		);
		$config["per_page"] = $num_registros;
		$config["uri_segment"] = 3;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data["empleados"] = $this->Vehiculos_model->get_all_vehicles(
			$config["per_page"],
			$page,
			$this->input->post('tx_marca'),
			$this->input->post('tx_modelo'),
			$this->input->post('tx_matricula'),
			$this->input->post('order_by'),
			$this->input->post('order_dir'),
		);

		$start = $page + 1;
		$end = min(($page + 1) * $config["per_page"], $config["total_rows"]);
		$total = $config["total_rows"];
		$data["pagination_text"] = "{$start} al {$end} de {$total} vehículos";

		$data["num_registros_selected"] = $num_registros;

		$data['marcas'] = $this->Vehiculos_model->get_marcas();

		$this->load->view('empleados', $data);
	}
}
