<?php
class Reservas_model extends CI_Model {

	public function get_reservas_by_vehicle($id_vehiculo)
	{
		$this->db->select();
		$this->db->join("EMPLEADO","EMPLEADO.PK_ID_EMPLEADO = RESERVA.FK_ID_EMPLEADO");
		$this->db->join("ESTADO_RESERVA","ESTADO_RESERVA.PK_ID_ESTADO_RESERVA = RESERVA.FK_ID_ESTADO");
		$this->db->where('FK_ID_VEHICULO', $id_vehiculo);
		return $this->db->get('RESERVA')->result_array();
	}

	public function get_reservas_count($marca = null, $modelo = null, $matricula = null,$nombre_empleado = null,$ape_empleado = null,$fecha_desde = null,$fecha_hasta = null,$estado = null )
	{
		$this->db->select();
		$this->db->join("EMPLEADO","EMPLEADO.PK_ID_EMPLEADO = RESERVA.FK_ID_EMPLEADO");
		$this->db->join("ESTADO_RESERVA","ESTADO_RESERVA.PK_ID_ESTADO_RESERVA = RESERVA.FK_ID_ESTADO");
		$this->db->join("VEHICULO","VEHICULO.PK_ID_VEHICULO = RESERVA.FK_ID_VEHICULO");

		if ($marca !== null) {
			$this->db->like('MARCA', $marca);
		}

		if ($modelo !== null) {
			$this->db->like('MODELO', $modelo);
		}

		if ($matricula !== null) {
			$this->db->like('MATRICULA', $matricula);
		}

		if ($nombre_empleado !== null) {
			$this->db->like('EMPLEADO.NOMBRE', $nombre_empleado);
		}

		if ($ape_empleado !== null) {
			$this->db->like('EMPLEADO.APELLIDOS', $ape_empleado);
		}

		if ($fecha_desde !== null) {
			$this->db->like('FECHA_DESDE', $fecha_desde);
		}

		if ($fecha_hasta !== null) {
			$this->db->like('FECHA_HASTA', $fecha_hasta);
		}

		if ($estado !== null) {
			$this->db->like('NOMBRE_ESTADO', $estado);
		}

		return $this->db->count_all_results('RESERVA');
	}

	public function get_all_reservas($limit = 5, $offset = 5,$marca = null, $modelo = null, $matricula = null,$nombre_empleado = null,$ape_empleado = null,$fecha_desde = null,$fecha_hasta = null,$estado = null ,$order_by = '',$order_dir = '')
	{
		$this->db->select();
		$this->db->join("EMPLEADO","EMPLEADO.PK_ID_EMPLEADO = RESERVA.FK_ID_EMPLEADO");
		$this->db->join("ESTADO_RESERVA","ESTADO_RESERVA.PK_ID_ESTADO_RESERVA = RESERVA.FK_ID_ESTADO");
		$this->db->join("VEHICULO","VEHICULO.PK_ID_VEHICULO = RESERVA.FK_ID_VEHICULO");

		if ($marca !== null) {
			$this->db->like('MARCA', $marca);
		}

		if ($modelo !== null) {
			$this->db->like('MODELO', $modelo);
		}

		if ($matricula !== null) {
			$this->db->like('MATRICULA', $matricula);
		}

		if ($nombre_empleado !== null) {
			$this->db->like('EMPLEADO.NOMBRE', $nombre_empleado);
		}

		if ($ape_empleado !== null) {
			$this->db->like('EMPLEADO.APELLIDOS', $ape_empleado);
		}

		if ($fecha_desde !== null) {
			$this->db->like('FECHA_DESDE', $fecha_desde);
		}

		if ($fecha_hasta !== null) {
			$this->db->like('FECHA_HASTA', $fecha_hasta);
		}

		if ($estado !== null) {
			$this->db->like('FK_ID_ESTADO', $estado);
		}

		$this->db->limit($limit, $offset);

		$order_dir = !empty($order_dir) ? $order_dir : 'asc';
		$this->db->order_by($order_by, $order_dir);

		return $this->db->get('RESERVA')->result_array();
	}

	public function check_solapamiento($fecha_desde,$fecha_hasta){
		$this->db->select();
		$this->db->where_in('FK_ID_ESTADO', array(1,2));
		$this->db->where("('$fecha_desde' BETWEEN fecha_desde AND fecha_hasta) OR ('$fecha_hasta' BETWEEN fecha_desde AND fecha_hasta) OR ('$fecha_desde' <= fecha_desde AND '$fecha_hasta' >= fecha_hasta)");

		return $this->db->get('RESERVA')->num_rows() > 0;
	}
	public function insertar_reserva($reserva){
		$this->db->insert('RESERVA', $reserva);
	}

	public function aceptar_reserva($reserva,$id_reserva){

	}

	public function denegar_reserva($reserva,$id_reserva){

	}

	public function get_estados(){
		return $this->db->get('ESTADO_RESERVA')->result_array();
	}
}
