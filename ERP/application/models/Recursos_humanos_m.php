<?php if (! defined('BASEPATH')) exit('No direct scripts access allowed');

class Recursos_humanos_m extends CI_Model
{
	function menu()
	{
		$this->db->from('menus');		
		return $this->db->get()->result();
	}
	
}