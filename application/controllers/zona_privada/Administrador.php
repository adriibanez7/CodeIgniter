<?php

class Administrador extends CI_Controller
{
	public function __construct()
	{
		$this->load->library('session');
	}

	public function index(){
		redirect('/Inicio');
	}

	public function login(){
		if (!isset($this->session)){
			redirect('/Inicio');
		}
	}

}

//Genera un controlador denominado Administrador en el directorio application/controllers/zona_privada. El controlador contendrá:
//
//Una función 'index' que redireccionará al 'controlador 3'.
//Una función 'login' en la cual:
//En caso de existir un usuario ya logueado, redireccione al 'controlador 3'. En caso contrario:
//Deberá obtener los datos enviados desde la 'vista 2'. Se deberán realizar las validaciones oportunas
// (no te conformes con solo realizar las validaciones automáticas).
//Una vez hayas validado todo, obtendrás los datos del administrador que se haya logueado desde base de datos y:
//Guardarás sus datos en sesión, en la variable (key) 'administrador'.
//Redireccionarás al usuario a la página de 'inicio' de la zona privada.
//Una función 'logout' que se ocupará de cerrar sesión. Deberás:
//Eliminar la variable (key) 'administrador' de sesión.
//Redirigir a la página de login.
//Este controlador deberá extender de la librería 'Administrador_Controller'.
