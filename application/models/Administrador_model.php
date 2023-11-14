<?php

class Administrador_model extends CI_Model
{
	public function get_value($clave)
	{
		if (is_int($clave)) {
			$this->db->where('PK_ID_ADMINISTRADOR', $clave);
		} else {
			$this->db->where('EMAIL', $clave);
		}

		$query = $this->db->get('ADMINISTRADOR');

		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return null;
		}
	}


}
