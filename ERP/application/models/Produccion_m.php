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
	function guardar($data){
		if(isset($data['id']) and is_numeric($data['id'])){
		$this->db->where("id",$data['id']);
		$success = $this->db->update('servicios',$data);
		}else
			$success = $this->db->insert('servicios',$data);
		return ["status"=>$success];
	}
	
}