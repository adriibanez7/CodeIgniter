<?php

class Productos extends CI_Model {

	public function get_products_and_categories()
	{
		$this->db->select('P.NOMBRE AS NOMBRE_PRODUCTO, P.MARCA, P.PRECIO, C.NOMBRE AS NOMBRE_CATEGORIA');
		$this->db->join("CATEGORIA C", "P.FK_ID_CATEGORIA = C.PK_ID_CATEGORIA", "LEFT");
		$this->db->order_by("NOMBRE_PRODUCTO", "DESC");
		return $this->db->get('PRODUCTO P')->result_array();
	}


}
