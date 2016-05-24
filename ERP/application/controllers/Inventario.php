<?php

// SESIONES

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("Inventario_m");
		$this->load->helper(array('form', 'url'));		
	}

	public function index()
	{		
		$this->load->view("header");
		$this->load->view('inicio');
	}

	public function empleados()
	{		
		$this->load->view("header");
		$this->load->view('inventario/general');
	}
}
