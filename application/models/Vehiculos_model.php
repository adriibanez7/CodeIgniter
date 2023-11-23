<?php

class Vehiculos_model extends CI_Model {

	public function get_vehicles_count($marca = null, $modelo = null, $matricula = null)
	{
		if ($marca !== null) {
			$this->db->like('MARCA', $marca);
		}

		if ($modelo !== null) {
			$this->db->like('MODELO', $modelo);
		}

		if ($matricula !== null) {
			$this->db->like('MATRICULA', $matricula);
		}

		return $this->db->count_all_results('VEHICULO');
	}


	public function get_vehicle($id_vehiculo)
	{
		$this->db->select();
		$this->db->where('PK_ID_VEHICULO',$id_vehiculo);
		return $this->db->get('VEHICULO')->result_array();
	}

	public function get_all_vehicles($limit, $offset,$marca = null, $modelo = null, $matricula = null,$order_by = '',$order_dir = '')
	{
		$this->db->select();

		if ($marca !== null) {
			$this->db->like('MARCA', $marca);
		}

		if ($modelo !== null) {
			$this->db->like('MODELO', $modelo);
		}

		if ($matricula !== null) {
			$this->db->like('MATRICULA', $matricula);
		}
		$this->db->limit($limit, $offset);

		$order_dir = !empty($order_dir) ? $order_dir : 'asc';
		$this->db->order_by($order_by, $order_dir);

		return $this->db->get('VEHICULO')->result_array();
	}

	public function get_marcas()
	{
		$this->db->distinct();
		$this->db->select('MARCA');
		$query = $this->db->get('VEHICULO');

		$marcas = array('' => 'Seleccione una marca');
		foreach ($query->result() as $row) {
			$marcas[$row->MARCA] = $row->MARCA;
		}

		return $marcas;
	}






}
