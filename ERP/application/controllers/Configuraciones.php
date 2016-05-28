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

		$this->load->view("header");
		$this->load->view('configuraciones/usuarios', $data);
	}

	// FUNCIÓN PARA LLENAR LA TABLA CON LOS USUARIOS
	public function get_Usuarios()
	{
		echo json_encode($this->configuraciones_m->traer_Usuarios());
	}


	public function nuevo_Usuario()
	{

		$data = array('id_empleado'=> $this->input->post("empleado"),
					  'id_perfil' => $this->input->post("perfil"),
					  'id_sucursal' => $this->input->post("sucursal"),
					  'username' => $this->input->post("username"), 
					  'password' => md5($this->input->post("password1"))
			);

		echo json_encode($this->configuraciones_m->insertar_Usuario($data));
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
