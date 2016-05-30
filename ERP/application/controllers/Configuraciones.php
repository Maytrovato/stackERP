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
		$username = $this->input->post("username");

		$existe = $this->verificar_existencia_usuario($username);

		
		//print_r($existe);

		if ($existe == 0) // NO EXISTE EL USUARIO
		{
			$data = array('id_empleado'=> $this->input->post("empleado"),
						  'id_perfil' => $this->input->post("perfil"),
						  'id_sucursal' => $this->input->post("sucursal"),
						  'username' => $username, 
						  'password' => md5($this->input->post("password1"))
				);

			echo json_encode($this->configuraciones_m->insertar_Usuario($data));			
		}
		else if ($existe > 0)// EXISTE EL USUARIO
		{
			echo 0;
		}
	}

	public function editar_Usuario()
	{
		$id = $this->input->post("id");
		$field = $this->input->post("field");		
		$value = $this->input->post("value");

		if ($field == "username")
		{
			$existe = $this->verificar_existencia_usuario($value);

			if ($existe == 0)  // NO EXISTE EL USUARIO
			{
				$data = array($field => $value);
				echo json_encode($this->configuraciones_m->actualizar_Usuario($id, $data));
			}
			else if ($existe > 0) // EXISTE EL USUARIO
			{
				echo 0;
			}
		}
		else 
		{
			$data = array($field => $value);
			echo json_encode($this->configuraciones_m->actualizar_Usuario($id, $data));
		}

	}

	public function verificar_existencia_usuario($username)
	{
		$results = $this->configuraciones_m->verificar_Usuario($username);

		foreach($results as $res)
		{
			$result = $res->res;
		}
		return $result;
	}

	public function editar_Usuario()
	{
		$id = $this->input->post("id");
		$field = $this->input->post("field");
		$value = $this->input->post("value");
		
		$data = array($field => $value);
		echo json_encode($this->configuraciones_m->actualizar_Usuario($id, $data));				
	}


	public function editar_Password()
	{
		$id = $this->input->post("id");
		$pass = $this->input->post("password");

		$data = array("password" => md5($pass) );
		echo json_encode($this->configuraciones_m->actualizar_Password($id, $data));			
	}

	public function editar_Password()
	{
		$id = $this->input->post("id");
		$pass = $this->input->post("password");

		$data = array("password" => md5($pass) );
		echo json_encode($this->configuraciones_m->actualizar_Password($id, $data));			
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
