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


	public function insertar_Usuario($data)
	{
		$this->db->insert('usuarios',$data);
		return $this->db->insert_id();
	}


	public function verificar_Usuario($username)
	{
		$this->db->select("COUNT(id) as res");
		$this->db->from("usuarios");
		$this->db->where('username', $username);
		$query = $this->db->get();

		return $query->result();
	}


	// Trabaja recibiendo el field que se modificó y su nuevo valor
	// Uno por uno, no el arreglo completo del ROW
	public function actualizar_Usuario($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('usuarios', $data); 

		return $this->db->affected_rows();
	}

	public function actualizar_Password($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('usuarios', $data); 

		return $this->db->affected_rows();
	}


	function traer_Usuarios()
	{
		$this->db->select("usuarios.id");
		$this->db->select("CONCAT(empleados.nombre, ' ', empleados.a_paterno, ' ', empleados.a_materno) as Empleado");
		$this->db->select("username");
		$this->db->select("usuarios.id_perfil AS 'id_perfil'");
		$this->db->select("id_sucursal AS 'id_sucursal'");
		$this->db->select("usuarios.status AS 'status'");
		
		$this->db->from("usuarios");

		$this->db->join("perfiles", "usuarios.id_perfil = perfiles.id");
		$this->db->join("empleados", "usuarios.id_empleado = empleados.id");
		
		$this->db->order_by('usuarios.id', 'asc'); 
		$query = $this->db->get();

		return $query->result();
	}

	// FIN DE FUNCIONES PARA USUARIOS //////////////////////////////////////////////





	// FUNCIONES PARA PERMISOS //////////////////////////////////////////////

	public function traer_Permisos()
	{
		$this->db->select("*");
		$this->db->from("perfiles");

		$query = $this->db->get();

		return $query->result();
	}

	public function traer_Perfiles_Campos()
	{
		$this->db->select("COLUMN_NAME");
		$this->db->from("INFORMATION_SCHEMA.COLUMNS");

		$this->db->where('TABLE_SCHEMA', "stackerp");
		$this->db->where('TABLE_NAME', "perfiles");
		$this->db->where('COLUMN_NAME !=', "id");
		$this->db->where('COLUMN_NAME !=', "perfil");

		$query = $this->db->get();
		$query = $query->result();

		return $query;
	}

	// Trabaja recibiendo el field que se modificó y su nuevo valor
	// Uno por uno, no el arreglo completo del ROW
	public function actualizar_Perfil($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('perfiles', $data); 

		return $this->db->affected_rows();
	}

	public function insertar_Perfil($data)
	{
		$this->db->insert('perfiles',$data);
		return $this->db->insert_id();
	}

	public function verificar_Perfil($perfil)
	{
		$this->db->select("COUNT(id) as res");
		$this->db->from("perfiles");
		$this->db->where('perfil', $perfil);
		$query = $this->db->get();

		return $query->result();
	}


	// FIN DE FUNCIONES PARA PERMISOS //////////////////////////////////////////////

	
}