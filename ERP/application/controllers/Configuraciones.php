<?php

// SESIONES

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuraciones extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("configuraciones_m");
		$this->load->helper(array('form', 'url'));		
	}

	public function index()
	{		
		$this->load->view("header");
		$this->load->view('inicio');
	}


	// VISTA DE USUARIOS
	public function usuarios()
	{		
		$data["empleados"] = json_encode($this->configuraciones_m->traer_Empleados());
		$data["perfiles"] = json_encode($this->configuraciones_m->traer_Perfiles());

	//echo "<prev>";
		//print_r( $data["perfiles"]);

		$this->load->view("header");
		$this->load->view('configuraciones/usuarios', $data);
	}

	// FUNCIÓN PARA LLENAR LA TABLA CON LOS USUARIOS
	public function getUsuarios()
	{
		echo json_encode($this->configuraciones_m->traer_Usuarios());
	}

	public function getPerfiles()
	{
		echo json_encode($this->configuraciones_m->traer_Perfiles());		
	}



	// FIN DE VISTA DE USUARIOS





	public function permisos()
	{		
		$this->load->view("header");
		$this->load->view('configuraciones/permisos');
	}

	public function json($data)
	{
		header("Content-type: application/json; charset-uft-8");
		echo json_encode($data);
	}
}
