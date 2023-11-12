<?php

class ProductosModel extends CI_Model {

	public function get_products_count()
	{
		return $this->db->count_all('PRODUCTO');
	}

	public function get_product($id)
	{
		$this->db->select('PRODUCTO.PK_ID_PRODUCTO, PRODUCTO.NOMBRE AS NOMBRE_PRODUCTO, PRODUCTO.MARCA, PRODUCTO.CANTIDAD,PRODUCTO.PRECIO,PRODUCTO.FK_ID_CATEGORIA,CATEGORIA.NOMBRE AS NOMBRE_CATEGORIA');
		$this->db->join("CATEGORIA","PRODUCTO.FK_ID_CATEGORIA = CATEGORIA.PK_ID_CATEGORIA");
		$this->db->where('PRODUCTO.PK_ID_PRODUCTO',$id);
		return $this->db->get('PRODUCTO')->result_array();
	}

	public function get_all_products($limit, $offset)
	{
		$this->db->limit($limit, $offset);
		return $this->db->get('PRODUCTO')->result_array();
	}

	public function get_all_categories()
	{
		return $this->db->get('CATEGORIA')->result_array();
	}

	public function get_products_and_categories($limit, $offset)
	{
		$this->db->select('PRODUCTO.PK_ID_PRODUCTO, PRODUCTO.NOMBRE AS NOMBRE_PRODUCTO, PRODUCTO.MARCA, PRODUCTO.CANTIDAD,PRODUCTO.PRECIO,PRODUCTO.FK_ID_CATEGORIA,CATEGORIA.NOMBRE AS NOMBRE_CATEGORIA');
		$this->db->join("CATEGORIA","PRODUCTO.FK_ID_CATEGORIA = CATEGORIA.PK_ID_CATEGORIA");
		$this->db->order_by('PRODUCTO.PK_ID_PRODUCTO', 'ASC');
		$this->db->limit($limit, $offset);
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

	public function insert_new_product($producto) {

		$this->db->insert('PRODUCTO', $producto);
	}

	public function update_product($producto,$PK_ID_PRODUCTO)
	{
		$this->db->update('PRODUCTO', $producto, $PK_ID_PRODUCTO);
	}

	public function delete_product($id){
		$this->db->delete('PRODUCTO', array('PK_ID_PRODUCTO' => $id));
	}

}
