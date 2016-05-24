<?php

// SESIONES

defined('BASEPATH') OR exit('No direct script access allowed');

class Configuraciones extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model("Configuraciones");
		$this->load->helper(array('form', 'url'));		
	}

	public function index()
	{		
		$this->load->view("header");
		$this->load->view('inicio');
	}

	public function usuarios()
	{		
		$this->load->view("header");
		$this->load->view('configuraciones/usuarios');
	}
}
