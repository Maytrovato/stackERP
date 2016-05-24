<?php

// SESIONES

defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("Compras_m");
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
		$this->load->view('compras/nueva_compra');
	}
}
