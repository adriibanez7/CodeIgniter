<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehiculos extends CI_Controller {

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
		$this->mostrar_vehiculos();
	}

	public function mostrar_vehiculos($num_registros = 5)
	{
		$num_registros = $this->input->post('num_registros')
			? $this->input->post('num_registros')
			: $num_registros;


//		$this->Administrador_model->add_new_admin('Adrián','Ibáñez Montalvo','adrian.ibanez@circulargo.com','1234');

		$config = array(
			'base_url' => base_url() . 'vehiculos/mostrar_vehiculos',
			'total_rows' => $this->Vehiculos_model->get_vehicles_count(
				$this->input->post('tx_marca'),
				$this->input->post('tx_modelo'),
				$this->input->post('tx_matricula')
			),
			'per_page' => $num_registros,
			'uri_segment' => 3,
			'first_link' => '<<',
			'last_link' => '>>',
			'next_link' => '>',
			'prev_link' => '<'
		);

		$this->pagination->initialize($config);
		$page = $this->uri->segment(3, 0);

		$data = array(
			'vehiculos' => $this->Vehiculos_model->get_all_vehicles(
				$config['per_page'],
				$page,
				$this->input->post('tx_marca'),
				$this->input->post('tx_modelo'),
				$this->input->post('tx_matricula'),
				$this->input->post('order_by'),
				$this->input->post('order_dir')
			),
			'pagination_text' => sprintf("%d al %d de %d vehículos",
				$page + 1,
				min(($page + 1) * $config['per_page'], $config['total_rows']),
				$config['total_rows']
			),
			'num_registros_selected' => $num_registros,
			'marcas' => $this->Vehiculos_model->get_marcas()
		);

		$this->load->view('vehiculos', $data);
	}

	public function ver($id_vehiculo)
	{
		$data['vehiculo'] = $this->Vehiculos_model->get_vehicle($id_vehiculo);
		if (!$data['vehiculo']){
			redirect(base_url());
			exit();
		}

		$reservas = $this->Reservas_model->get_reservas_by_vehicle($id_vehiculo);

		$data['reservas'] = $reservas;

		$this->load->view('ficha', $data);

	}

	public function reservar($id_vehiculo)
	{
		if(!$this->Vehiculos_model->get_vehicle($id_vehiculo)){
			redirect(base_url());
		}

		$data['id_vehiculo'] = $id_vehiculo;

		$empleados = $this->Empleados_model->get_all_employees_dropdown();

		$data['op_emple'] = array();
		foreach ($empleados as $empleado) {
			$data['op_emple'][$empleado['PK_ID_EMPLEADO']] = $empleado['NOMBRE']. ' ' .$empleado['APELLIDOS'];
		}

		$this->load->view('reserva', $data);
	}

	public function guardar(){

//		$data['id_vehiculo'] = $id_vehiculo;

		$empleados = $this->Empleados_model->get_all_employees();

		$data['op_emple'] = array();
		foreach ($empleados as $empleado) {
			$data['op_emple'][$empleado['PK_ID_EMPLEADO']] = $empleado['NOMBRE']. ' ' .$empleado['APELLIDOS'];
		}

		$this->form_validation->set_rules('fecha_desde', 'Fecha Desde', 'callback_date_valid');

		$this->form_validation->set_rules('fecha_hasta', 'Fecha Hasta', 'callback_date_valid',
			array(
				'required' => 'Debes proporcionar un %s.',));

		$this->form_validation->set_rules('s_empleados', 'Empleados', 'required',
			array(
				'required' => 'Debes proporcionar un %s.')
		);

		if (!$this->form_validation->run())
		{
//			$this->reservar();
//			var_dump('ERROR VALIDACION');
//			$data['$id_vehiculo'] = $id_vehiculo;
			$this->load->view('reserva',$data);
			return;
		}
		else
		{
			$tx_PK_ID_VEHICULO = $this->input->post('id_vehiculo');
			$txFechaDesde = $this->input->post('fecha_desde');
			$txFechaHasta = $this->input->post('fecha_hasta');
			$s_empleados = $this->input->post('s_empleados');

			$reserva = array(
				'FK_ID_VEHICULO' => $tx_PK_ID_VEHICULO,
				'FK_ID_EMPLEADO' => $s_empleados,
				'FECHA_DESDE' => $txFechaDesde,
				'FECHA_HASTA' => $txFechaHasta
			);
//			var_dump($reserva);
			$this->Reservas_model->insertar_reserva($reserva);
			redirect(base_url());
//			var_dump("SIN ERRORES");

		}
	}

	function date_valid() {
		$fecha_desde = $this->input->post('fecha_desde');
		$fecha_hasta = $this->input->post('fecha_hasta');

		if (empty($fecha_desde)) {
			$this->form_validation->set_message('date_valid', 'Esta fecha no puede estar vacía');
			return false;
		}

		if (empty($fecha_hasta)) {
			$this->form_validation->set_message('date_valid', 'Esta fecha no puede estar vacía');
			return false;
		}

		if ($this->Reservas_model->check_solapamiento($fecha_desde, $fecha_hasta)) {
			$this->form_validation->set_message('date_valid', 'Existe solapamiento en las fechas indicadas');
			return false;
		}

		if (strtotime($fecha_hasta) < strtotime($fecha_desde)) {
			$this->form_validation->set_message('date_valid', 'Fecha hasta no puede ser menor que Fecha desde');
			return false;
		}

		if ($fecha_hasta == $fecha_desde) {
			$this->form_validation->set_message('date_valid', 'Las fechas no pueden ser iguales');
			return false;
		}

		$fecha_actual = date('Y-m-d');
		if ($fecha_desde < $fecha_actual || $fecha_hasta < $fecha_actual) {
			$this->form_validation->set_message('date_valid', 'Las fechas no pueden ser menores que el día actual');
			return false;
		}

		return true;
	}
}
