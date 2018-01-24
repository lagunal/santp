<?php
class SolicitanteBD extends Conexion
{
	private $usuario;
	private	$vectorUsuarios	=	Array();	
	
    public function __construct()
	 {
		$this->usuario=new Solicitante();
	 }
	 
	//Devuelve los datos del usuario a utilizar para la conexion con la base de datos
	public function getUsuario(){
		return $this->usuario;
	}
	
	//Iniciliza los datos del usuario a utilizar para la conexion con la base de datos
	public function setUsuario(Usuario $usuario){
		 $this->usuario=$usuario;
	}
	
	 //funcion para ejecutar una consulta sobre la tabla t_usuario
	 public function ejecutarSelect()
	 {

	 		$sentencia=$this->crearSelect("t_solicitante","*","","");	
	 		$resultado=$this->ejecutarSentencia($sentencia);
	 		
	 		return $resultado;
	 		
	 	
	 }
	  //funcion para retornar si existe un usuario en la base de datos
	 public function validarUsuarioBD()
	 {
	 	$sentencia=$this->crearSelect("t_solicitante","tx_indicador","tx_indicador='".$this->usuario->getIndicador()."'","");	 	 
	    $filas=$this->numeroFilas($sentencia);	
	    echo "<br> Filas".$filas;
	    if ($filas)
	    	return true;
	    else
	    	return false;	 
	 }
	 
	 public function consultarIdUsuario($idUsuario)//consulta por ID
	 {
	 	return $this->consultarUsuario($idUsuario,null,null);
	 }
	  public function consultarXNombre($nombre)//consulta por NOMBRE
	 {
	 	return $this->consultarUsuario(null,$nombre,null);
	 }
	 public function consultarXIndicador($indicador)//Consulta por INDICADOR
	 {
	 	return $this->consultarUsuario(null,null,$indicador);
	 }
	 
	  public function consultarUsuario($idUsuario,$nombre,$indicador) 
	 	{	 	
	 	    $order='id_usuario';
	 	    $where='';
	 	    
	 	    if($idUsuario!=null)
	 	    {
	 	    	$where="id_usuario=".$idUsuario;
	 	    }
	 	    if($nombre!=null)
	 	    {
	 	    	if($where!=''){
	 	    	$where.=" AND tx_nombre='".$nombre."'";
				$order='tx_nombre';}
	 	    	else{
	 	    	$where="tx_nombre='".$nombre."'";	
				$order='tx_nombre';} 	    	
	 	    }
	 		if($indicador!=null)
	 	    {
	 	    	if($where!=''){
					$where.=" AND tx_indicador='".$indicador."'";
					$order='tx_nombre';}
	 	    	else{
					$where="tx_indicador='".$indicador."'";
					$order='tx_indicador';  }  	
	 	    }		
			
			 
	 		$sentencia		=	$this->crearSelect("t_solicitante","*",$where,$order);
	 	    $numRegistro	=	$this->numeroFilas($sentencia);
			
	 	    	 	 	 
	 	    
	 	    if ($numRegistro)
	 	    {		
	 			$resultado=$this->ejecutarSentencia($sentencia);
				
		 	    for($num=0;$num<=$numRegistro-1;$num++) 
	    		{	    		
		    		$datos[$num]	=	pg_fetch_array($resultado,$num,PGSQL_ASSOC);
		    		$usuario_aux		=	new Solicitante();
										
		    		$usuario_aux->setIdUsuario			($datos[$num]["id_usuario"]);
		    		$usuario_aux->setNombre             ($datos[$num]["tx_nombre"]);
		    		$usuario_aux->setIndicador			($datos[$num]["tx_indicador"]);
					$usuario_aux->setTelefono			($datos[$num]["tx_telf"]);
					$usuario_aux->setCorreo				($datos[$num]["tx_correo"]);
					$usuario_aux->setCelular			($datos[$num]["tx_celular"]);
					
					$usuario_aux->setNombre_sup			($datos[$num]["nombre_sup"]);
					$usuario_aux->setTelefono_sup       ($datos[$num]["telefono_sup"]);
					$usuario_aux->setIndicador_sup      ($datos[$num]["indicador_sup"]);
					
					$this->vectorUsuarios[$num]	=	$usuario_aux;
	    		}
	 		
	 	
	 		return  $this->vectorUsuarios; 	
	 	    }
	 		else
	 		{
	 			//echo"No existen registros";
				return NULL;
	 		}
	 		
	}
	
	public function InsertarUsuario(Solicitante $c)
       {    
		  try
		  {
					
					$Tx1=$c->getIndicador();
					$Tx2=$c-> getNombre();
					$Tx3=$c->getTelefono();
					$Tx4=$c->getIndicador()."@pdvsa.com";
					$Tx5=$c->getCelular();
					
					$Tx7=$c->getNombre_sup();
					$Tx8=$c->getTelefono_sup();
					$Tx9=$c->getIndicador_sup();
					$columnas=$this->get_commas(false,'tx_nombre','tx_indicador','tx_telf','tx_correo','tx_celular','nombre_sup','telefono_sup','indicador_sup');
					$valores=$this->get_commas(true,"$Tx2","$Tx1","$Tx3","$Tx4","$Tx5","$Tx7","$Tx8","$Tx9");
					$result=$this->ejecutarInsert('t_solicitante',$columnas,$valores);
					
							
					return $result;
					
			}catch (Exception $e) 
			{						
				return "error en la sentencia";
					
			}//fin try/catch	

       }
}
?>