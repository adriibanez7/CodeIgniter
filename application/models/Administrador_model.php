<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Administrador_model extends CI_model{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id_administrador){
        $this->db->where("PK_ID_ADMINISTRADOR", $id_administrador);
        return $this->db->get("ADMINISTRADOR")->row_array();
    }

    public function get_usuario($campo, $valor){
        $this->db->where($campo, $valor);
        return $this->db->get("ADMINISTRADOR")->row_array();
    }

	public function add_new_admin($nombre,$apellidos,$email,$pass){
		$this->db->set(array('NOMBRE' => $nombre,'APELLIDOS' => $apellidos,'EMAIL' => $email,'PASSWORD' => hash("sha256", $pass)));
		$this->db->insert('ADMINISTRADOR');
	}
}
