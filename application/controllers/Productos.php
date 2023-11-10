<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

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
		$this->mostrar_ficha();
	}

	public function mostrar_ficha(){

		$data['categorias'] = $this->ProductosModel->get_all_categories();
		$data = $this->cargar_componentes();
		$this->load->view('ficha', $data);

}

	public function guardado_ok(){
		echo 'Guardado correctamente'; die;
	}

	public function guardar(){

		$txNombre = $this->input->post('txNombre');
		$txMarca = $this->input->post('txMarca');
		$txPrecio = $this->input->post('txPrecio');
		$txCantidad = $this->input->post('txCantidad');
		$selCategoria = $this->input->post('selCategoria');

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
			$this->mostrar_ficha();
		}
		else
		{
			$this->guardado_ok();
		}
	}

	public function cargar_componentes(){
		$data['txNombre'] = array(
			'name'          => 'txNombre',
			'id'            => 'txNombre',
			'value'         => set_value('txNombre'),
			'placeholder'   => 'Nombre'
		);


		$data['txMarca'] = array(
			'name'          => 'txMarca',
			'id'            => 'txMarca',
			'value'         => set_value('txMarca'),
			'placeholder'   => 'Marca'
		);

		$data['txPrecio'] = array(
			'name'          => 'txPrecio',
			'id'            => 'txPrecio',
			'value'         => set_value('txPrecio'),
			'placeholder'   => 'Precio'
		);

		$data['txCantidad'] = array(
			'name'          => 'txCantidad',
			'id'            => 'txCantidad',
			'value'         => set_value('txCantidad'),
			'placeholder'   => 'Cantidad'
		);

		$categorias = $this->ProductosModel->get_all_categories();
		$data['options']['0'] = 'Selecciona una categoría';

		foreach ($categorias as $categoria) {
			$categoriaId = $categoria['PK_ID_CATEGORIA'];
			$categoriaNombre = $categoria['NOMBRE'];

			$data['options'][$categoriaId] = $categoriaNombre;
		}
		$data['selectedCategoria'] = set_value('selCategoria', '0');


		$data['btSubmit'] = array(
			'name'          => 'btSubmit',
			'id'            => 'btSubmit',
			'value'         => 'true',
			'type'          => 'submit',
			'content'       => 'Guardar'
		);

		return $data;

	}


}
