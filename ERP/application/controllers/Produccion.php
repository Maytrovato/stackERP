<?php

// SESIONES

defined('BASEPATH') OR exit('No direct script access allowed');

class Produccion extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("Produccion_m");
		$this->load->helper(array('form', 'url'));		
	}

	public function index()
	{		
		$this->load->view("header");
		$this->load->view('inicio');
	}

	public function servicios()
	{	
		$this->load->view("header");
		$this->load->view('produccion/servicios');
	}
	public function getServicios(){
		$data = $this->Produccion_m->servicios();
		$this->json($data);
	}
	public function saveServicios(){
		$data =  $this->input->post();
		$respuesta = $this->Produccion_m->guardar($data);
		$this->json($respuesta);
	}
	public function productos()
	{		
		$this->load->view("header");
		$this->load->view('produccion/productos');
	}
	function json($data){
		header("Content-type: application/json; charset-utf-8");
		echo json_encode($data);
	}
}
