<?php
include_once "../config.php";

class Conexion
{
	private $nombreBD;
	private $contrasenaBD;
	private $hostBD;
	private $puertoBD;
	private $conexionBD;
	private $resultadoBD;
	
	public function __construct(){
		
	}
	
	//retorna el nombre de la base de datos
	public function getNombreBD(){
		return $this->nombreBD;
	}
	//inicializa el nombre de la base de datos
	public function setNombreBD($nombreBD){	
			$this->nombreBD=$nombreBD;		
	}
	//retorna la contrase�a de la base de datos
	public function getContrasenaBD(){
		return $this->contrasenaBD;
	}
	//inicializa la contrase�a de la base de datos
	public function setContrasenaBD($contrasenaBD){	
			$this->contrasenaBD=$contrasenaBD;		
	}
	//retorna el host de la conexion a la base de datos
	public function getHostBD(){
		return $this->hostBD;
	}
	//inicializa el host de la conexion a la base de datos
	public function setHostBD($hostBD){	
			$this->hostBD=$hostBD;		
	}
	//retorna el puerto de la conexion a la base de datos
	public function getPuertoBD(){
		return $this->puertoBD;
	}
	//inicializa el puerto de la conexion a la base de datos
	public function setPuertoBD($puertoBD){	
			$this->puertoBD=$puertoBD;		
	}
	
	//funcion para conectar al servidor de base de datos devuelve true o false
	private function conectarBD() {
		//$conex=	pg_connect("hostaddr=".$this->hostBD." port=".$this->puertoBD." user=".$this->nombreBD." password=" .$this->contrasenaBD);
		$config = new config();
		
		$conex=	pg_connect($config->queryString);
		
		if ($conex){	
			return  $conex;
		}else{
			echo"Error en ejecutar la conexion";
			return 	$conex;
		}
	}
	
	//ejecutar una consulta en base de datos , Agregaci�n,modificaci�n,eliminaci�n y busqueda.
	public function ejecutarSentencia($sentencia)
	{

			//echo "<br> BD".$sentencia;
			$this->conexionBD=$this->conectarBD();
			$resultadoBD = pg_query($this->conexionBD, $sentencia);
			return $resultadoBD;
	}
	
	
	//ejecuta una sentencia y devuelve el numero de filas afectadas 
	public function numeroFilas($sentencia)
	{
			$this->conexionBD=$this->conectarBD();		
			
			$resultado = pg_query($this->conexionBD,$sentencia);			
			if ($resultado) {
				$numeroFilas = pg_num_rows($resultado);
				
				return $numeroFilas ;
			}
			
	}
	//funcion para la creacion de consultas de seleccion sobre tablas
	function crearSelect($table, $columns, $where='', $order='')
	{
		$tmp = "SELECT $columns FROM $table";
		if($where!=''){
			$tmp.=" WHERE $where";
		}
		if($order!=''){
			$tmp.=" ORDER BY $order";
		}
		return $tmp;
    }
	
		//funcion para la creacion de consultas de seleccion sobre tablas categoria taxonomica (IN)
	function crearSelectIn($table, $columns, $where='', $order='',$campoIn='',$cadena='')
	{
		$tmp = "SELECT $columns FROM $table";
		if($where!=''){
			$tmp.=" WHERE $where";
		}		
		if($cadena!='')
		{		
			$letras=array();			
			$letras=explode("-",$cadena);			
											
			if($where!='')
			{			
				$tmp.=" AND SUBSTR($campoIn,1,1) IN ('$letras[0]','$letras[1]','$letras[2]')";
			}
			else
			{
				$tmp.=" WHERE SUBSTR($campoIn,1,1) IN ('$letras[0]','$letras[1]','$letras[2]')";
			}		
		}
		if($order!=''){
			$tmp.=" ORDER BY $order";
		}
		return $tmp;
    }
    	
//-INSERT- $columns=get_commas(...)   $values=get_commas(...)
function ejecutarInsert($table, $columns, $values)
{
	$this->conexionBD=$this->conectarBD();	
	$sentencia= "INSERT INTO $table ($columns) VALUES ($values)";	
	//echo "<br> BD".$sentencia;
	$resultadoInsert	=	$this->ejecutarSentencia($sentencia);
	//$resultadoInsert=pg_query($this->conexionBD,$sentencia);
	
	return $resultadoInsert; // Retorna FALSE si ocurre un error
}

//-UPDATE- $values=get_mult_set(...)   $where=get_mult_set(...) o get_simp_set(...)
function ejecutarUpdate($table, $values, $where)
{
	$this->conexionBD=$this->conectarBD();	
	$sentencia= "UPDATE $table SET $values WHERE $where";
	$resultadoUpdate=pg_query($this->conexionBD,$sentencia);
	
	return $resultadoUpdate;
}

//-DELETE-  $where=get_mult_set(...) o get_simp_set(...)
function ejecutarDelete($table, $where='')
{	
	$this->conexionBD=$this->conectarBD();	
	$sentencia = "DELETE FROM $table";
	if($where!=''){
		$sentencia.=" WHERE $where";
	}
	$resultadoDelete	=	$this->ejecutarSentencia($sentencia);
	//$resultadoDelete=pg_query($this->conexionBD,$sentencia);
	return $resultadoDelete;
}

//- get_commas(true|false, 1, 2, 4...) true pone comillas  => '1','2','4'...
function get_commas()
{
	$a=func_get_args();
	$com = $a[0];
	return $this->get_commasA(array_slice($a, 1, count($a)-1), $com);
}

//- como get_commas pero devuelve entre comas el array pasado
function get_commasA($arr_in, $comillas=true){
	$temp='';
	$coma="'";
	if(!$comillas) $coma=''; //-el 1er param==true, metemos comas

	foreach($arr_in as $arg){
	   if($temp!='')  $temp.=","; 
	   if(substr($arg,0,2)=='!!'){ //- Si empieza por !! no le pongo comas...
			$temp.=substr($arg,2); continue;
	   }
	   $temp.="$coma".$arg."$coma";
	}
	return $temp;
}

//- Devuelve una asignacion (por defecto) simple entre comillas  X='1' 
function get_simp_set($col, $val, $sign='=', $comillas=true){
	$cm="'";
	if(!$comillas) $cm='';
	if(substr($val,0,2)=='!!'){ //- Si empieza por !! no le pongo comas...
		$val=substr($val,2); $cm='';
	}
	return $col."$sign $cm".$val."$cm";
}

//-Mezcla cada valor de $a_cols, con uno de $a_vals   "X='1', T='2'...
//- ej:  con $simb='or'  X='1' or T='2'...
//- ej:  con $sign='>'   X>'1' or T>'2'...
function get_mult_set($a_cols, $a_vals, $simb=',', $sign='=', $comillas=true){
	$temp='';
	for($x=0;$x<count($a_cols);$x++){
		if($temp!='')  $temp.=" $simb ";
	   $temp.= $this->get_simp_set($a_cols[$x],$a_vals[$x], $sign, $comillas);
	}
	return $temp;
}

//funcion que retorna si existe un registro en la base de datos.
public function comprobarExistencia($columna,$pk,$tabla)
{			
		$sentencia = "SELECT $columna FROM $tabla WHERE $columna= '".$pk."'";				
		$this->conexionBD=$this->conectarBD();							
		$resultado = pg_query($this->conexionBD,$sentencia);		
		$registros=pg_num_rows($resultado);
		return $registros;
}


//funcion que retorna si existe un registro en la base de datos dado varios parametros
public function comprobarExistenciaVP($columna,$pk,$tabla)
{			
			$sentencia = "SELECT $columna FROM $tabla WHERE ".$pk."";						
			$registros=$this->numeroFilas($sentencia);
			return $registros;		
		
}

//funcion de paginacion de registros
public function paginar($tabla,$where,$orderBy,$limiteRegistros,$desdeRegistro)
{
	$sentencia="SELECT * FROM $tabla";
	
	if($where!='')
	{
		$sentencia.=" WHERE $where ";
	}
	
	$sentencia.="ORDER BY $orderBy ASC LIMIT $limiteRegistros OFFSET $desdeRegistro";
	
	
	return $sentencia;
}



}
?>
