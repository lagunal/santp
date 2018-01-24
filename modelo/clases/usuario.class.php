<?php
class Usuario
{
	private $indicador;
	private $contrasena;
	private $nombreApellido;
	private $nombre_sup;
	private $correo;
	private $idUsuario;
	
	
	
	
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
	
	
	
	//retorna el email asociada al usuario en la intranet
	public function getCorreo(){
		return $this->correo;
	}
	//inicializa el email asociada al usuario en la intranet
	public function setCorreo($correo){
		$this->correo=$correo;
	}
	
	
	public function	getIdUsuario()
	{
		return $this->idUsuario;
	}
	
	public function	setIdUsuario($idUsuario)
	{
		$this->idUsuario	=	$idUsuario;
	}
}

?>