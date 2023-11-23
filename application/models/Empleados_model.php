<?php
class Empleados_model extends CI_Model {

	public function get_all_employees_dropdown(){
		$this->db->select();
		return $this->db->get('EMPLEADO')->result_array();
	}

	public function get_employees_count($cod_emple = null, $nombre = null, $apellidos = null)
	{
		if ($cod_emple !== null) {
			$this->db->like('COD_EMPLEADO', $cod_emple);
		}

		if ($nombre !== null) {
			$this->db->like('NOMBRE', $nombre);
		}

		if ($apellidos !== null) {
			$this->db->like('APELLIDOS', $apellidos);
		}

		return $this->db->count_all_results('EMPLEADO');
	}


	public function get_employee($id_emple)
	{
		$this->db->select();
		$this->db->where('PK_ID_EMPLEADO',$id_emple);
		return $this->db->get('EMPLEADO')->result_array();
	}

	public function get_all_employees($limit = 5, $offset = 5,$cod_emple = null, $nombre = null, $apellidos = null,$order_by = '',$order_dir = '')
	{
		$this->db->select();

		if ($cod_emple !== null) {
			$this->db->like('COD_EMPLEADO', $cod_emple);
		}

		if ($nombre !== null) {
			$this->db->like('NOMBRE', $nombre);
		}

		if ($apellidos !== null) {
			$this->db->like('APELLIDOS', $apellidos);
		}
		$this->db->limit($limit, $offset);

		$order_dir = !empty($order_dir) ? $order_dir : 'asc';
		$this->db->order_by($order_by, $order_dir);

		return $this->db->get('EMPLEADO')->result_array();
	}
}

