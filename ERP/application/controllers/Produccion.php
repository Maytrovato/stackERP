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
	public function save(){
		$data =  $this->input->post();
		$tabla = $data['tabla'];
		unset($data['tabla']);
		$respuesta = $this->Produccion_m->guardar($data,$tabla);
		$this->json($respuesta);
	}
	public function productos()
	{		
		$this->load->view("header");
		$this->load->view('produccion/productos');
	}
	public function getProductos(){
		$data = $this->Produccion_m->productos();
		$this->json($data);
	}

	function json($data){
		header("Content-type: application/json; charset-utf-8");
		echo json_encode($data);
	}
}
