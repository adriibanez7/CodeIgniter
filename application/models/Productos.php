<?php

class Productos extends CI_Model {
	public function get_all_products()
	{
		return $this->db->get('PRODUCTO')->result_array();
	}

	public function get_all_categories()
	{
		return $this->db->get('CATEGORIA')->result_array();
	}

	public function get_products_and_categories()
	{
		$this->db->join("CATEGORIA","PRODUCTO.FK_ID_CATEGORIA = CATEGORIA.PK_ID_CATEGORIA","LEFT");
		$this->db->order_by("PRODUCTO.NOMBRE","DESC");
		return $this->db->get('PRODUCTO')->result_array();
	}

	public function get_products_with_category_zapatillas()
	{
		$this->db->join("CATEGORIA C","P.FK_ID_CATEGORIA = C.PK_ID_CATEGORIA","LEFT");
		$this->db->where('C.NOMBRE', 'Zapatillas');
		return $this->db->get('PRODUCTO P')->result_array();
	}
	public function get_products_starts_with_category_zapa()
	{
		$this->db->join("CATEGORIA C","P.FK_ID_CATEGORIA = C.PK_ID_CATEGORIA","LEFT");
		$this->db->like('P.NOMBRE', 'Zapa', 'after');
		return $this->db->get('PRODUCTO P')->result_array();
	}

	public function get_avg_price_products()
	{
		$this->db->join("CATEGORIA C", "P.FK_ID_CATEGORIA = C.PK_ID_CATEGORIA", "LEFT");
		$this->db->select_avg("P.PRECIO", "PRECIO_MEDIO");
		return $this->db->get('PRODUCTO P')->result_array();
	}


	public function get_products_in_category()
	{
		$this->db->select('C.PK_ID_CATEGORIA, C.NOMBRE AS NOMBRE_CATEGORIA, COUNT(P.PK_ID_PRODUCTO) AS NUMERO_DE_PRODUCTOS');
		$this->db->from('CATEGORIA C');
		$this->db->join('PRODUCTO P', 'C.PK_ID_CATEGORIA = P.FK_ID_CATEGORIA',"LEFT");
		$this->db->group_by('C.PK_ID_CATEGORIA, C.NOMBRE');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get_category_more_10_products() {
		$this->db->select('C.PK_ID_CATEGORIA, C.NOMBRE AS NOMBRE_CATEGORIA, COUNT(P.PK_ID_PRODUCTO) AS NUMERO_DE_PRODUCTOS');
		$this->db->from('CATEGORIA C');
		$this->db->join('PRODUCTO P', 'C.PK_ID_CATEGORIA = P.FK_ID_CATEGORIA', 'LEFT');
		$this->db->group_by('C.PK_ID_CATEGORIA, C.NOMBRE');
		$this->db->having('NUMERO_DE_PRODUCTOS >', 10);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function insert_2_new_products() {
		$data = array(
			'NOMBRE' => 'Gorra verde',
			'MARCA' => 'Adidas',
			'FK_ID_CATEGORIA' => 2,
			'CANTIDAD' => 10,
			'PRECIO' => 19.99
		);

		$this->db->insert('PRODUCTO', $data);

		$data = array(
			'NOMBRE' => 'Zapatillas Air Force 1',
			'MARCA' => 'Nike',
			'FK_ID_CATEGORIA' => 1,
			'CANTIDAD' => 5,
			'PRECIO' => 124.99
		);

		$this->db->insert('PRODUCTO', $data);
	}

	public function update_product_7()
	{
		$this->db->update('PRODUCTO', array('MARCA' => "Jack & Jones",'CANTIDAD' => 8,'PRECIO' => 350.99), array('PK_ID_PRODUCTO' => 7));
	}

}
