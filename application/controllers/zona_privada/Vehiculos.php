<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vehiculos extends Administrador_Controller
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

	public function listado($num_registros = 5)
	{

		if ($this->input->post('num_registros')) {
			$num_registros = $this->input->post('num_registros');
		}

		$config = array();
		$config["base_url"] = base_url() . "zona_privada/vehiculos/listado";
		$config["total_rows"] = $this->Vehiculos_model->get_vehicles_count(
			$this->input->post('tx_marca'),
			$this->input->post('tx_modelo'),
			$this->input->post('tx_matricula')
		);
		$config["per_page"] = $num_registros;
		$config["uri_segment"] = 4;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$data["vehiculos"] = $this->Vehiculos_model->get_all_vehicles(
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
		$data["pagination_text"] = "{$start} al {$end} de {$total} vehiculos";

		$data["num_registros_selected"] = $num_registros;

		$data['marcas'] = $this->Vehiculos_model->get_marcas();

		$this->load->view('administracion/vehiculos/listado', $data);
	}

	public function ficha($id_vehiculo = null)
	{
		if ($id_vehiculo) {
			$data['vehiculo'] = $this->Vehiculos_model->get_vehicle($id_vehiculo);
		} else {
			$data['vehiculo'] = null;
		}

//		var_dump($data);
		$this->load->view('administracion/vehiculos/ficha', $data);
	}


	public function guardar()
	{

		$id_vehiculo = $this->input->post("tx_PK_ID_VEHICULO");

		$this->form_validation->set_rules('tx_marca', 'Marca', 'required',
			array('required' => 'Debes proporcionar un %s.')
		);

		$this->form_validation->set_rules('tx_modelo', 'Modelo', 'required',
			array('required' => 'Debes proporcionar un %s.')
		);

		$this->form_validation->set_rules('tx_matricula', 'Matricula', 'required',
			array('required' => 'Debes proporcionar un %s.')
		);

		$this->form_validation->set_rules('tx_ubicacion', 'Ubicacion', 'required',
			array('required' => 'Debes proporcionar un %s.')
		);


		if (!$this->form_validation->run()) {
			$this->ficha();
		} else {
			if (!$id_vehiculo) {
				$tx_marca = $this->input->post('tx_marca');
				$tx_modelo = $this->input->post('tx_modelo');
				$tx_matricula = $this->input->post('tx_matricula');
				$tx_ubicacion = $this->input->post('tx_ubicacion');

				$vehiculo = array(
					'MARCA' => $tx_marca,
					'MODELO' => $tx_modelo,
					'MATRICULA' => $tx_matricula,
					'UBICACION' => $tx_ubicacion,
				);

				$this->insertar_vehiculo($vehiculo);
			} else {
				$tx_PK_ID_VEHICULO = $this->input->post('tx_PK_ID_VEHICULO');
				$tx_marca = $this->input->post('tx_marca');
				$tx_modelo = $this->input->post('tx_modelo');
				$tx_matricula = $this->input->post('tx_matricula');
				$tx_ubicacion = $this->input->post('tx_ubicacion');

				$vehiculo = array(
					'MARCA' => $tx_marca,
					'MODELO' => $tx_modelo,
					'MATRICULA' => $tx_matricula,
					'UBICACION' => $tx_ubicacion,
				);

				$this->actualizar_vehiculo($vehiculo,$tx_PK_ID_VEHICULO);
			}
			$this->guardado_ok();
		}


	}

	public function insertar_vehiculo($vehiculo)
	{
		$this->Vehiculos_model->insert_new_vehicle($vehiculo);

	}

	public function actualizar_vehiculo($vehiculo, $id_vehiculo)
	{
		$this->Vehiculos_model->update_vehicle($vehiculo, $id_vehiculo);

	}

	private function guardado_ok()
	{
		redirect('zona_privada/vehiculos/listado');
	}


}
