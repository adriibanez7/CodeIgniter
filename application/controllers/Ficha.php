<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ficha extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductosModel');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');

	}

	public function index()
	{
		$this->mostrar_nueva_ficha();
	}

	public function mostrar_ficha($id){

		$data['producto'] = $this->ProductosModel->get_product($id);
		$data += $this->cargar_componentes($data);
		$this->load->view('ficha', $data);

	}

	public function mostrar_nueva_ficha(){

		$data = $this->cargar_componentes();
		$this->load->view('ficha', $data);

}

	public function guardado_ok(){
		redirect('listado/mostrar_listado');
	}

	public function guardar(){
		var_dump("GUARDAR");

		$this->validar();
	}


	public function validar(){
		$this->form_validation->set_rules('txNombre', 'Nombre', 'required',
			array('required' => 'Debes proporcionar un %s.')
		);


		$this->form_validation->set_rules('txPrecio', 'Precio', 'required|greater_than_equal_to[10]|less_than_equal_to[999.99]',
			array('required' => 'Debes proporcionar una %s.',
				'greater_than_equal_to' => 'El campo %s no puede ser menor que 10€',
				'less_than_equal_to' => 'El campo %s no puede ser mayor que 999.99€')
		);

		$this->form_validation->set_rules('txCantidad', 'Cantidad', 'required|numeric|is_natural_no_zero',
			array('required' => 'Debes proporcionar una %s.','numeric' => 'El campo %s debe ser un número','is_natural_no_zero'=>'EL campo %s no puede ser 0 o menor')
		);

		$this->form_validation->set_rules('selCategoria', 'Categoria', 'required|is_natural_no_zero',
			array(
				'required' => 'Debes proporcionar una %s.',
				'is_natural_no_zero' => 'Selecciona una %s válida.'
			)
		);

		if ($this->form_validation->run() == FALSE)
		{
			$this->mostrar_ficha($this->input->post('tx_PK_ID_PRODUCTO'));
		}
		else
		{
			$tx_PK_ID_PRODUCTO = $this->input->post('tx_PK_ID_PRODUCTO');
			$txNombre = $this->input->post('txNombre');
			$txMarca = $this->input->post('txMarca');
			$txPrecio = $this->input->post('txPrecio');
			$txCantidad = $this->input->post('txCantidad');
			$selCategoria = $this->input->post('selCategoria');

			$producto = array(
				'NOMBRE' => $txNombre,
				'MARCA' => $txMarca,
				'FK_ID_CATEGORIA' => $selCategoria,
				'CANTIDAD' => $txCantidad,
				'PRECIO' => $txPrecio
			);
			var_dump($producto);
			var_dump($tx_PK_ID_PRODUCTO);

			if (isset($tx_PK_ID_PRODUCTO) && !empty($tx_PK_ID_PRODUCTO)){
				$id_producto = array('PK_ID_PRODUCTO' => $tx_PK_ID_PRODUCTO);
				$this->actualizar_producto($producto,$id_producto);
//				echo "actualizar";
			}else{
				$this->insertar_producto($producto);
//				echo "insertar";
			}
			$this->guardado_ok();

		}
	}

	public function insertar_producto($producto){
		$this->ProductosModel->insert_new_product($producto);

	}
	public function actualizar_producto($producto,$id_producto){
		$this->ProductosModel->update_product($producto,$id_producto);

	}

	public function eliminar_producto($id_producto){
		$this->ProductosModel->delete_product($id_producto);
		redirect('listado/mostrar_listado');
	}

	public function cargar_componentes($data = array()){
		$data['txNombre'] = array(
			'name'          => 'txNombre',
			'id'            => 'txNombre',
			'placeholder'   => 'Nombre'
		);


		$data['txMarca'] = array(
			'name'          => 'txMarca',
			'id'            => 'txMarca',
			'placeholder'   => 'Marca'
		);

		$data['txPrecio'] = array(
			'name'          => 'txPrecio',
			'id'            => 'txPrecio',
			'placeholder'   => 'Precio'
		);

		$data['txCantidad'] = array(
			'name'          => 'txCantidad',
			'id'            => 'txCantidad',
			'placeholder'   => 'Cantidad'
		);

		$categorias = $this->ProductosModel->get_all_categories();
		$data['options']['0'] = 'Selecciona una categoría';

		foreach ($categorias as $categoria) {
			$categoriaId = $categoria['PK_ID_CATEGORIA'];
			$categoriaNombre = $categoria['NOMBRE'];

			$data['options'][$categoriaId] = $categoriaNombre;
		}
		$data['selectedCategoria'] = set_value('selCategoria', $data['producto'][0]['FK_ID_CATEGORIA'] ?? '0');


		$data['btSubmit'] = array(
			'name'          => 'btSubmit',
			'id'            => 'btSubmit',
			'value'         => 'true',
			'type'          => 'submit',
			'content'       => 'Guardar'
		);

		$data['btVolver'] = array(
			'name' => 'btVolver',
			'id' => 'btVolver',
			'value' => 'true',
			'type' => 'button',
			'content' => 'Volver',
		);

		return $data;

	}


}
