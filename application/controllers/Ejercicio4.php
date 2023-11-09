<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ejercicio4 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
	}

	public function index()
	{
		$this->mostrar_ejercicio4();
	}

	public function mostrar_ejercicio4(){

		$attributes = array('class' => 'form_ej4', 'id' => 'form_ej4','name'=>'form_ej4','method'=>'POST','action'=>'http://172.17.0.3/Base/CodeIgniter-3.1.13/');
		echo form_open('ejercicio4', $attributes);

		$hidden = array('randomID' => rand(0,999));
		echo form_open('ejercicio4', '', $hidden);

		$attributes1 = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;'
		);

		echo form_label('Campo1', 'Campo1', $attributes1);
		$input_primero = array(
			'name'          => 'campo1',
			'id'            => 'campo1',
			'class'            => 'campo1',
			'value'         => 'Campo1',
			'maxlength'     => '100',
			'size'          => '50',
			'style'         => 'width:50%',
			'placeholder' =>'Soy el campo 1'
		);
		echo form_input($input_primero);

		$attributes2 = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;',
		);

		echo form_label('campo2', 'campo2', $attributes2);
		$input_segundo = array(
			'name'          => 'campo2',
			'id'            => 'campo2',
			'class'            => 'campo2',
			'value'         => 'Campo2',
			'maxlength'     => '100',
			'size'          => '50',
			'style'         => 'width:50%',
			'placeholder' =>'Soy el campo 2'
		);

		echo form_input($input_segundo);

		$attributes3 = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;',
		);

		echo form_label('textarea', 'textarea', $attributes3);
		$input_text_area = array(
			'name'          => 'textarea',
			'id'            => 'textarea',
			'class'            => 'textarea',
			'value'         => 'Textarea',
			'maxlength'     => '100',
			'size'          => '50',
			'style'         => 'width:50%',
			'placeholder' =>'Soy el textarea'
		);
		echo form_textarea($input_text_area);


		$attributes4 = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;',
		);

		echo form_label('Select', 'Select', $attributes4);
		$options = array(
			'0'         => 'Selecciona una opción',
			'1'         => 'Opción 1',
			'2'           => 'Opción 2',
			'3'         => 'Opción 3',
			'4'        => 'Opción 4',
		);

		echo form_dropdown('options', $options, 'large');

		$attributes5 = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;',
		);

		echo form_label('Peras', 'Peras', $attributes5);
		$ch1 = array(
			'name'          => 'ch1',
			'id'            => 'ch1',
			'class'            => 'ch1',
			'value'         => 'accept',
			'checked'       => TRUE,
			'style'         => 'margin:10px'
		);
		echo form_checkbox($ch1);

		$attributes6 = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;',
		);

		echo form_label('Patatas', 'Patatas', $attributes6);
		$ch2 = array(
			'name'          => 'ch2',
			'id'            => 'ch2',
			'class'            => 'ch2',
			'value'         => 'accept',
			'checked'       => FALSE,
			'style'         => 'margin:10px'
		);
		echo form_checkbox($ch2);

		$attributes7 = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;',
		);
		echo form_label('Coliflores', 'Coliflores', $attributes7);
		$ch3 = array(
			'name'          => 'ch3',
			'id'            => 'ch3',
			'class'            => 'ch3',
			'value'         => 'accept',
			'checked'       => TRUE,
			'style'         => 'margin:10px'
		);
		echo form_checkbox($ch3);

		$attributes8 = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;',
		);

		echo form_label('1', '1', $attributes8);
		$rad1 = array(
			'name'          => 'rad1',
			'id'            => 'rad1',
			'class'            => 'rad1',
			'value'         => 'accept',
			'checked'       => FALSE,
			'style'         => 'margin:10px'
		);
		echo form_radio($rad1);

		$attributes9 = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;',
		);

		echo form_label('2', '2', $attributes9);
		$rad2 = array(
			'name'          => 'rad2',
			'id'            => 'rad2',
			'class'            => 'rad2',
			'value'         => 'accept',
			'checked'       => FALSE,
			'style'         => 'margin:10px'
		);
		echo form_radio($rad2);

		$attributes10 = array(
			'class' => 'mycustomclass',
			'style' => 'color: #000;',
		);

		echo form_label('3', '3', $attributes10);
		$rad3 = array(
			'name'          => 'rad3',
			'id'            => 'rad3',
			'class'            => 'rad3',
			'value'         => 'accept',
			'checked'       => FALSE,
			'style'         => 'margin:10px'
		);
		echo form_radio($rad3);

		$button = array(
			'name'          => 'button',
			'id'            => 'button',
			'value'         => 'true',
			'type'          => 'button',
			'content'       => 'Botón con evento JS'
		);
		$js = 'onClick="alert(`Evento onclick activado`)"';

		echo form_button($button,'Botón con evento JS',$js);

		echo form_close();

		$this->load->view('ejercicio4');
	}
}
