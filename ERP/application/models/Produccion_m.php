<?php if (! defined('BASEPATH')) exit('No direct scripts access allowed');

class Produccion_m extends CI_Model
{
	function menu()
	{
		$this->db->from('menus');		
		return $this->db->get()->result();
	}
	function servicios(){
		return $this->db->get('servicios')->result();
	}
	function productos(){
		return $this->db->get('productos')->result();	
	}
	function guardar($data,$tabla){
		if(isset($data['id']) and is_numeric($data['id'])){
		$this->db->where("id",$data['id']);
		$success = $this->db->update($tabla,$data);
		}else
			$success = $this->db->insert($tabla,$data);
		return ["status"=>$success];
	}
	
}