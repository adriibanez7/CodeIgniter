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

	public function check_solapamiento($fecha_desde,$fecha_hasta){
		$this->db->select();
		$this->db->where_in('FK_ID_ESTADO', array(1,2));
		$this->db->where("('$fecha_desde' BETWEEN fecha_desde AND fecha_hasta) OR ('$fecha_hasta' BETWEEN fecha_desde AND fecha_hasta) OR ('$fecha_desde' <= fecha_desde AND '$fecha_hasta' >= fecha_hasta)");

		return $this->db->get('RESERVA')->num_rows() > 0;
	}
	public function insertar_reserva($reserva){
		$this->db->insert('RESERVA', $reserva);
	}
}
