<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
//
//class Ficha extends CI_Controller {
//
//	public function __construct()
//	{
//		parent::__construct();
//		$this->load->library('table');
//		$this->load->helper('url');
//		$this->load->helper('html');
//		$this->load->library('pagination');
//		$this->load->model('Vehiculos_model');
//		$this->load->model('Reservas_model');
//	}
//
//	public function ver($id_vehiculo)
//	{
//		$data['vehiculo'] = $this->Vehiculos_model->get_vehicle($id_vehiculo);
//		if (!$data['vehiculo']){
//			redirect('http://172.17.0.3/Base/CodeIgniter-3.1.13/');
//			exit();
//		}
//
//		$reservas = $this->Reservas_model->get_reservas_by_vehicle($id_vehiculo);
//
//		$data['reservas'] = $reservas;
//
//		$this->load->view('ficha', $data);
//	}
//
//}
