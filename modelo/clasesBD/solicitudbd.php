<?php
class solicitudbd extends Conexion
{
	private $solicitud;
	private	$vectorSolicitud=Array();	
		
	public function __construct(){
		$this->usuario=new Solicitud();
	}
	 
	//Devuelve los datos resulatdo a utilizar para la conexion con la base de datos
	public function getSolicitud(){
		return $this->solicitud;
	}
	
	//Iniciliza los datos del usuario a utilizar para la conexion con la base de datos
	public function setSolicitud(Solicitud $solicitud){
		$this->solicitud=$solicitud;
	}
	
	//funcion para ejecutar una consulta sobre la tabla t_usuario
	public function ejecutarSelect(){
		$sentencia=$this->crearSelect("t_solicitud","*","","");	
	 	$resultado=$this->ejecutarSentencia($sentencia);
	 		
	 	return $resultado;
	}
	 
	 
	public function consultarSolicitudes($idSolicitud)//consulta por ID
	{
		return $this->consultarSolicitud($idSolicitud,null,0);
	}
	 
	public function consultarSolicitudesFe($fe,$cambio)//consulta por ID
	{
		return $this->consultarSolicitud(null,$fe,$cambio);
	}

	public function consultarSolicitud($idSolicitud,$fecha,$cambio) {
 	    $order='id_solicitud';
 	    $where='';
		 	    
 	    if($idSolicitud!=null){
 	    	$where="id_solicitud=".$idSolicitud;
 	    }
		
 	    if(($fecha!=null)&&($cambio==0)){
 	    	if($where!=''){
 	    	$where.=" AND fecha='".$fecha."'";
			$order='';}
 	    	else{
 	    	$where="fecha='".$fecha."'";	
			$order='';} 	    	
 	    }
		
		if(($fecha!=null)&&($cambio==1)){
 	    	if($where!=''){
 	    	$where.=" AND fecha like '".$fecha."'";
			$order='';}
 	    	else{
 	    	$where="fecha like '".$fecha."'";	
			$order='';} 	    	
 	    }
 		
 		$sentencia		=	$this->crearSelect("t_solicitud","*",$where,$order);
		//echo $sentencia;
 	    $numRegistro	=	$this->numeroFilas($sentencia);
 	    	 	 	 
 	    if ($numRegistro){		
 			$res=$this->ejecutarSentencia($sentencia);

	 	    for($num=0;$num<=$numRegistro-1;$num++){	    		
	    		$datos[$num]	=	pg_fetch_array($res,$num,PGSQL_ASSOC);
	    		$resultado_aux		=	new Solicitud();
									
	    		$resultado_aux->setIdSolicitud		($datos[$num]["id_solicitud"]);
				$resultado_aux->setIdUsuario   	    ($datos[$num]["id_usuario"]);
	    		$resultado_aux->setTx1					($datos[$num]["tx_1"]);
	    		$resultado_aux->setTx2					($datos[$num]["tx_2"]);
				$resultado_aux->setTx3					($datos[$num]["tx_3"]);
				$resultado_aux->setTx4					($datos[$num]["tx_4"]);
				$resultado_aux->setTx5					($datos[$num]["tx_5"]);
				$resultado_aux->setTx6					($datos[$num]["tx_6"]);
				$resultado_aux->setTx7					($datos[$num]["tx_7"]);
				$resultado_aux->setTx8  				($datos[$num]["tx_8"]);
				$resultado_aux->setFecha				($datos[$num]["fecha"]);
				$resultado_aux->setTx_Lugar				($datos[$num]["tx_lugar"]);
				$resultado_aux->setUnidad		        ($datos[$num]["tx_unidad"]);
				$resultado_aux->setVerificado	        ($datos[$num]["verificado"]);
				 
				$this->vectorSolicitud[$num]	=	$resultado_aux;
    		}
 		
	 		return  $this->vectorSolicitud; 	
 	    }else{
 			//echo"No existen registros";
			return NULL;
 		}
	}
	
	//funcion de insertar los datos de encuesta
    public function InsertarDatos(Solicitud  $c,$id_usu){
		try{
			$Tx1=$c->getTx1();
			$Tx2=$c->getTx2();
			$Tx3=$c->getTx3();
			$Tx4=$c->getTx4();
			$Tx5=$c->getTx5();
			$Tx6=$c->getTx6();
			$Tx7=$c->getTx7();
			$Tx8=$c->getTx8();
			$fe=$c->getFecha();
			$lugar=$c->getTx_Lugar();
			$uni=$c->getUnidad();
			$ve=$c->getVerificado();
			$columnas=$this->get_commas(false,'tx_1','tx_2','tx_3','tx_4','tx_5','tx_6','tx_7','tx_8','fecha','tx_lugar','id_usuario','tx_unidad','verificado');
			$valores=$this->get_commas(true,"$Tx1","$Tx2","$Tx3","$Tx4","$Tx5","$Tx6","$Tx7","$Tx8","$fe","$lugar","$id_usu","$uni","$ve");
					
			$result=$this->ejecutarInsert('t_solicitud',$columnas,$valores);
		
			return $result;
			
		}catch (Exception $e){						
			return "error en la sentencia";
		}//fin try/catch	
	}
	
	 public function CantidadRegistro($fecha){
 	    $order='';
 	    $where='';
		if($fecha!=null)
 	    {
 	    	if($where!=''){
 	    	$where.=" AND fecha::text like '".$fecha."'";
			$order='';}
 	    	else{
 	    	$where="fecha::text like '".$fecha."'";	
			$order='';}
 	    }
 		
 		$sentencia		=	$this->crearSelect("t_solicitud","*",$where,$order);
		//echo $sentencia;
		$numRegistro	=	$this->numeroFilas($sentencia);
 		 	    	 	 	 
 	    return( $numRegistro);
	}
	 	
	public function EliminarSolicitud($id){
       try{
			   $where="id_solicitud='".$id."'";
			   $result=$this->ejecutarDelete('t_solicitud',$where);				
			   	   
			      return $result;
			   
		}catch (Exception $e) {
			return "error al insertar";
		}//fin try/catch	
	}
	   
   /* consultar paginar */
	public function consultarCatePaginar($fecha,$registros,$proxRegistro){	 	
 	    $order='fecha';
 	    $where='';

		if($fecha!=null){
 	    	if($where!='')
 	    	$where.=" AND fecha::text like '".$fecha."'";
 	    	else
 	    	$where="fecha::text like '".$fecha."'";	 	    	
 	    }
					
			
		try{
			$sent		=	$this->paginar("t_solicitud",$where,"id_solicitud",$registros,$proxRegistro);
			
		    $numRegistro	=	$this->numeroFilas($sent);
			
			if ($numRegistro){
				$resultado=$this->ejecutarSentencia($sent);
				for($num=0;$num<=$numRegistro-1;$num++)
				{
					$datos[$num]	=	pg_fetch_array($resultado,$num,PGSQL_ASSOC);
					$resultado_aux	=	new Solicitud();
										
					$resultado_aux->setIdSolicitud		($datos[$num]["id_solicitud"]);
					$resultado_aux->setIdUsuario   	    ($datos[$num]["id_usuario"]);
					$resultado_aux->setTx1					($datos[$num]["tx_1"]);
					$resultado_aux->setTx2					($datos[$num]["tx_2"]);
					$resultado_aux->setTx3					($datos[$num]["tx_3"]);
					$resultado_aux->setTx4					($datos[$num]["tx_4"]);
					$resultado_aux->setTx5					($datos[$num]["tx_5"]);
					$resultado_aux->setTx6					($datos[$num]["tx_6"]);
					$resultado_aux->setTx7					($datos[$num]["tx_7"]);
					$resultado_aux->setTx8  				($datos[$num]["tx_8"]);
					$resultado_aux->setFecha				($datos[$num]["fecha"]);
					$resultado_aux->setTx_Lugar				($datos[$num]["tx_lugar"]);
					$resultado_aux->setUnidad		        ($datos[$num]["tx_unidad"]);
					 
					$this->vectorSolicitud[$num]	=	$resultado_aux;
				}
			
				return  $this->vectorSolicitud; 	
			}else{
				return null;
			}
	 	}catch (Exception $e) {
				return "Excepción";
		}//fin try/catch
	} 


	public function modificar($id_sol){
		$where="";
		$where='id_solicitud='.$id_sol;
		$array_cols	= 	array( 'verificado');
	    $array_vals	= 	array(1);				
	    $result		=	$this->ejecutarUpdate("t_solicitud",$this->get_mult_set($array_cols, $array_vals),$where);
		return  $result;
	}
	
	public function obtenerSolicitudes(){
		$datos = $this->ejecutarSentencia("SELECT * FROM t_solicitud sd, t_solicitante se WHERE sd.id_usuario = se.id_usuario");

        $filas = pg_num_rows($datos);
        $res = array();
        
        for($i = 0; $i < $filas; $i++)
            $res[] = pg_fetch_array($datos, $i, PGSQL_ASSOC);
        
        return $res;
	}
	
}

?>