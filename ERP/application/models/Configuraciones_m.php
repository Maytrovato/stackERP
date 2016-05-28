<?php if (! defined('BASEPATH')) exit('No direct scripts access allowed');

class Configuraciones_m extends CI_Model
{


	// FUNCIONES PARA USUARIOS //////////////////////////////////////////////

	function traer_Empleados()
	{		
		//$this->db->select('id, CONCAT(nombre, " ", a_paterno, " ", a_materno) AS empleados');
		$this->db->select('id, CONCAT(nombre, " ", a_paterno, " ", a_materno) as value');
		$this->db->where('status', '1'); 
		$query = $this->db->get('empleados'); 
		$query = $query->result();
		
		return $query;
	}

	function traer_Perfiles()
	{		
		//$this->db->select('id, CONCAT(nombre, " ", a_paterno, " ", a_materno) AS empleados');
		$this->db->select('id , perfil AS value');
		$this->db->order_by('perfil', 'asc'); 
		$query = $this->db->get('perfiles'); 
		$query = $query->result();
		
		return $query;
	}

	/*function traer_Empleados2()
	{
		$this->db->select("nombre");
		$this->db->from('empleados');		
		return $this->db->get()->result();
	}  */

	public function insertar_Usuario($data)
	{
		$this->db->insert('usuarios',$data);
		return $this->db->insert_id();
	}


	function traer_Usuarios()
	{
		$this->db->select("usuarios.id");
		$this->db->select("CONCAT(empleados.nombre, ' ', empleados.a_paterno, ' ', empleados.a_materno) as Empleado");
		$this->db->select("username AS Usuario");
		$this->db->select("usuarios.id_perfil AS 'Perfil'");
		$this->db->select("id_sucursal AS 'Sucursal'");
		$this->db->select("usuarios.status AS 'Estado'");
		
		$this->db->from("usuarios");

		$this->db->join("perfiles", "usuarios.id_perfil = perfiles.id");
		$this->db->join("empleados", "usuarios.id_empleado = empleados.id");
		
		echo $this->db->last_query();		

		$query = $this->db->get();

		return $query->result();
	}

	// FIN DE FUNCIONES PARA USUARIOS //////////////////////////////////////////////
	
}