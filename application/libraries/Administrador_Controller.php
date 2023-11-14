<?php

class Administrador_Controller extends MY_Controller
{
	protected $administrador;
	protected $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		if (!isset($this->session)){
			session_start();
		}
		if (!$this->session->userdata($this->administrador)){
			redirect('/login', 'refresh');
		}else{
			$this->data['administrador'] = &$this->administrador;
		}

	}
}

$this->load->library('Administrador_Controller');
