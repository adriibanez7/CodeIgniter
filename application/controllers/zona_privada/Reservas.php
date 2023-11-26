<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reservas extends Administrador_Controller
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
		$config["base_url"] = base_url() . "zona_privada/reservas/listado";
		$config["total_rows"] = $this->Reservas_model->get_reservas_count(
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

		$data["reservas"] = $this->Reservas_model->get_all_reservas(
			$config["per_page"],
			$page,
			$this->input->post('tx_marca'),
			$this->input->post('tx_modelo'),
			$this->input->post('tx_matricula'),
			$this->input->post('tx_nom_emple'),
			$this->input->post('tx_ape_emple'),
			$this->input->post('tx_fecha_desde'),
			$this->input->post('tx_fecha_hasta'),
			$this->input->post('tx_estado'),
			$this->input->post('order_by'),
			$this->input->post('order_dir'),
		);

//		var_dump($this->input->post());

		$start = $page + 1;
		$end = min(($page + 1) * $config["per_page"], $config["total_rows"]);
		$total = $config["total_rows"];
		$data["pagination_text"] = "{$start} al {$end} de {$total} reservas";

		$data["num_registros_selected"] = $num_registros;

		$data['marcas'] = $this->Vehiculos_model->get_marcas();
		$estados = $this->Reservas_model->get_estados();
		$data['opciones'] = array('' => 'Selecciona un estado');
		foreach ($estados as $estado) {
			$data['opciones'][$estado['PK_ID_ESTADO_RESERVA']] = $estado['NOMBRE_ESTADO'];
		}

		$this->load->view('administracion/reservas/listado', $data);
	}

	public function aceptar_reserva($id_reserva) {
		$this->Reservas_model->accept_reserva($id_reserva);

		redirect('zona_privada/reservas/listado');
	}

	public function rechazar_reserva($id_reserva) {
		$this->Reservas_model->deny_reserva($id_reserva);

		redirect('zona_privada/reservas/listado');
	}



//	public function guardar()
//	{
//		$id_empleado = $this->input->post("tx_PK_ID_EMPLEADO");
//
//		$this->form_validation->set_rules('tx_nombre', 'Nombre', 'required',
//			array('required' => 'Debes proporcionar un %s.')
//		);
//
//		$this->form_validation->set_rules('tx_apellidos', 'Apellidos', 'required',
//			array('required' => 'Debes proporcionar un %s.')
//		);
//
//		$this->form_validation->set_rules('tx_fecha_nacimiento', 'Fecha Nacimiento', 'callback_date_valid');
//
//
//		if (!$this->form_validation->run()) {
//			$this->ficha();
//		} else {
//			if (!$id_empleado) {
//				$tx_nombre = $this->input->post('tx_nombre');
//				$tx_apellidos = $this->input->post('tx_apellidos');
//				$tx_fecha_nacimiento = $this->input->post('tx_fecha_nacimiento');
//
//				$empleado = array(
//					'NOMBRE' => $tx_nombre,
//					'APELLIDOS' => $tx_apellidos,
//					'FECHA_NACIMIENTO' => $tx_fecha_nacimiento,
//					'COD_EMPLEADO' => $this->Empleados_model->generar_cod_emple(),
//				);
//
//				$this->insertar_empleado($empleado);
//			} else {
//				$tx_PK_ID_EMPLEADO = $this->input->post('tx_PK_ID_EMPLEADO');
//				$tx_nombre = $this->input->post('tx_nombre');
//				$tx_apellidos = $this->input->post('tx_apellidos');
//				$tx_fecha_nacimiento = $this->input->post('tx_fecha_nacimiento');
//
//				$empleado = array(
//					'NOMBRE' => $tx_nombre,
//					'APELLIDOS' => $tx_apellidos,
//					'FECHA_NACIMIENTO' => $tx_fecha_nacimiento,
//				);
//
//				$this->actualizar_empleado($empleado,$tx_PK_ID_EMPLEADO);
//			}
//			$this->guardado_ok();
//		}
//
//
//	}

//	public function insertar_empleado($empleado)
//	{
//		$this->Empleados_model->insert_new_employee($empleado);
//
//	}
//
//	public function aceptar_reserva($id_reserva)
//	{
//		$this->Reservas_model->acept_reserva($id_reserva);
//
//	}

	function date_valid()
	{
		$fecha_nac = $this->input->post('tx_fecha_nacimiento');

		if (empty($fecha_nac)) {
			$this->form_validation->set_message('date_valid', 'La fecha de nacimiento no puede estar vacía');
			return false;
		}

		$fechaNacimientoDT = new DateTime($fecha_nac);
		$fechaActual = new DateTime();

		if ($fechaActual->diff($fechaNacimientoDT)->y < 18) {
			$this->form_validation->set_message('date_valid', 'La fecha de nacimiento puede ser menor que 18 años');
			return false;
		}
		return true;
	}


	private function guardado_ok()
	{
		redirect('zona_privada/reservas/listado');
	}


}
