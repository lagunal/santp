<?php
class EncuestaBD extends Conexion
{
	private $encuesta;
	private	$vectorEncuesta=Array();	
		
	 public function __construct()
	 {
	 	$this->encuesta=new Encuesta();
	 }
	 
	
	//Devuelve los datos resulatdo a utilizar para la conexion con la base de datos
	public function getEncuesta(){
		return $this->encuesta;
	}
	
	
	//Iniciliza los datos del usuario a utilizar para la conexion con la base de datos
	public function setEncuesta(Encuesta $encuesta){
		 $this->encuesta=$encuesta;
	}
	
	 //funcion para ejecutar una consulta sobre la tabla t_usuario
	 public function ejecutarSelect()
	 {

	 		$sentencia=$this->crearSelect("t_encuesta","*","","");	
	 		$resultado=$this->ejecutarSentencia($sentencia);
	 		
	 		return $resultado;
	 	
	 }
	 
	 
	 public function consultarEncuestas()//consulta por ID
	 {
	 	return $this->consultarEncuestas();
	 }
	 
	 
	 
	  public function consultarEncuesta( $fechai, $fechaf ) 
	 	{	 	
	 	    $order='id_encuesta';
	 	    $where='';
			 
	 		$sentencia		=	$this->crearSelect("t_encuesta","*"," fe_fecha BETWEEN to_timestamp('$fechai 00:00:00', 'DD/MM/YYYY HH24:MI:SS') AND to_timestamp('$fechaf 23:59:59', 'DD/MM/YYYY HH24:MI:SS' ) ",$order);
	 	    $numRegistro	=	$this->numeroFilas($sentencia);
	 	    	 	 	 
	 	  
	 	    if ($numRegistro)
	 	    {		
	 			$res=$this->ejecutarSentencia($sentencia);
		 	    for($num=0;$num<=$numRegistro-1;$num++) 
	    		{	    		
		    		$datos[$num]	=	pg_fetch_array($res,$num,PGSQL_ASSOC);
		    		$resultado_aux		=	new Encuesta();
										
		    		$resultado_aux->setIdEncuesta		($datos[$num]["id_encuesta"]);
					$resultado_aux->setTx1					($datos[$num]["tx_1"]);
		    		$resultado_aux->setTx2					($datos[$num]["tx_2"]);
					$resultado_aux->setTx3					($datos[$num]["tx_3"]);
					$resultado_aux->setTx4					($datos[$num]["tx_4"]);
					$resultado_aux->setTx5					($datos[$num]["tx_5"]);
					$resultado_aux->setTx6					($datos[$num]["tx_6"]);
					$resultado_aux->setTx7					($datos[$num]["tx_7"]);
					$resultado_aux->setTx8  				($datos[$num]["tx_8"]);
					$resultado_aux->setTx_sugerencias		($datos[$num]["tx_sugerencias"]);
					
					 
					$this->vectorEncuesta[$num]	=	$resultado_aux;
	    		}
	 		
	 	
	 		return  $this->vectorEncuesta; 	
	 	    }
	 		else
	 		{
	 			//echo"No existen registros";
				return NULL;
	 		}
	 		
	}
	//funcion de insertar los datos de encuesta
       public function InsertarEncuesta(Encuesta  $c)
       {    
		  try
		  {
					
					$Tx1=$c->getTx1();
					$Tx2=$c->getTx2();
					$Tx3=$c->getTx3();
					$Tx4=$c->getTx4();
					$Tx5=$c->getTx5();
					$Tx6=$c->getTx6();
					$Tx7=$c->getTx7();
					$Tx8=$c->getTx8();
					
					$suge=$c->getTx_sugerencias();
					
					
					 
					$columnas=$this->get_commas(false,'tx_1','tx_2','tx_3','tx_4','tx_5','tx_6','tx_7','tx_8','tx_sugerencias');
					$valores=$this->get_commas(true,"$Tx1","$Tx2","$Tx3","$Tx4","$Tx5","$Tx6","$Tx7","$Tx8","$suge");
							
					
					$result=$this->ejecutarInsert('t_encuesta',$columnas,$valores);
					
							
					return $result;
					
			}catch (Exception $e) 
			{						
				return "error en la sentencia";
					
			}//fin try/catch	

       }
	
	 public function CantidadRegistro() 
	 	{	 	
	 	    $order='';
	 	    $where='';
	 	    
	 	    
	 		$sentencia		=	$this->crearSelect("t_encuesta","*",$where,$order);
	 	    $numRegistro	=	$this->numeroFilas($sentencia);
	 	    	 	 	 
	 	    return( $numRegistro);
		}
	 	   
	
}
?>
