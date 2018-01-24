<?php
class Solicitante
{
	private $indicador;
	private $indicador_sup;
	private $contrasena;
	private $nombreApellido;
	private $nombre_sup;
	private $telefono;
	private $telefono_sup;
	private $correo;
	private $idUsuario;
	private $celular;
	private $unidad;

	private $supervisor;
	private $nombreSupervisor;
	private $telefonoSupervisor;

	//Supervisor
	public function getSupervisor(){
		return $this->supervisor;
	}
	public function setSupervisor($supervisor){
		$this->supervisor=$supervisor;
	}

	public function getNombreSupervisor(){
		return $this->nombreSupervisor;
	}
	public function setNombreSupervisor($supervisor){
		$this->nombreSupervisor=$supervisor;
	}

	public function getTelefonoSupervisor(){
		return $this->telefonoSupervisor;
	}
	public function setTelefonoSupervisor($ext){
		$this->telefonoSupervisor=$ext;
	}
	
	
	public function __construct()
	{	
	}
	//retorna el indicador unico del usuario en la intranet
	public function getIndicador(){
		return $this->indicador;
	}
	//inicializa el indicador unico del usuario en la intranet
	public function setIndicador($indicador){
			$this->indicador=$indicador;
	}
	
	//retorna el indicador unico del usuario en la intranet
	public function getIndicador_sup(){
		return $this->indicador_sup;
	}
	//inicializa el indicador unico del usuario en la intranet
	public function setIndicador_sup($indicador){
		$this->indicador_sup=$indicador;
	}
	
	//retorna la contraseña  del usuario en la intranet
	public function getContrasena(){
		return $this->contrasena;
	}
	//inicializa la contraseña  del usuario en la intranet
	public function setContrasena($contrasena){
		$this->contrasena=$contrasena;
	}

	//retorna el nombre y apellido del usuario en la intranet
	public function getNombre(){
		return $this->nombreApellido;
	}
	//inicializa el nombre y apellido del usuario en la intranet
	public function setNombre($nombreApellido){
		$this->nombreApellido=$nombreApellido;
	}
	
	//retorna el nombre y apellido del usuario en la intranet
	public function getNombre_sup(){
		return $this->nombre_sup;
	}
	//inicializa el nombre y apellido del usuario en la intranet
	public function setNombre_sup($nombre_sup){
		$this->nombre_sup=$nombre_sup;
	}

	//retorna la compa�ia asociada al usuario en la intranet
	public function getCelular(){
		return $this->celular;
	}
	//inicializa la compa�ia asociada al usuario en la intranet
	public function setCelular($celular){
		$this->celular=$celular;
	}
	
	//retorna el telefono asociada al usuario en la intranet
	public function getTelefono(){
		return $this->telefono;
	}
	//inicializa el telefono asociada al usuario en la intranet
	public function setTelefono($telefono){
		$this->telefono=$telefono;
	}
	
	//retorna el telefono asociada al usuario en la intranet
	public function getTelefono_sup(){
		return $this->telefono_sup;
	}
	//inicializa el telefono asociada al usuario en la intranet
	public function setTelefono_sup($telefono){
		$this->telefono_sup=$telefono;
	}
	//retorna el email asociada al usuario en la intranet
	public function getCorreo(){
		return $this->correo;
	}
	//inicializa el email asociada al usuario en la intranet
	public function setCorreo($correo){
		$this->correo=$correo;
	}
	
	
	public function	getIdUsuario(){
		return $this->idUsuario;
	}
	
	public function	setIdUsuario($idUsuario){
		$this->idUsuario	=	$idUsuario;
	}
}
?>