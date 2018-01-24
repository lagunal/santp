<?php
	/****  Clase para acceso a datos de la aplicacion ****/

	//require_once $_SERVER["DOCUMENT_ROOT"] . '/SInsup/Clases/clsOracle.php';
	require_once ("clsPostgreSQL.php");

     class clsDato {

		//Miembros:
		private $bd;

		//Metodos:
		public function __construct() {
			$config = new config();
			
			$conex=	pg_connect();
			$this->bd = new clsPostgreSQL('','','','','');
		}

function insertarPrueba($txruta,$txfecha,$txcodigo,$txnombre){
			try{
				$query="insert into datos_santp (tx_ruta,tx_fecha,tx_codigo,tx_nombre) values ('".$txruta."','".$txfecha."','".$txcodigo."','".$txnombre."')";
				 "QUERY:" . $query;		
				$this->bd->ExecuteNonQuery($query);
				return true;
	
			} catch (Exception $e) {
				throw new Exception("Ha ocurrido un error al insertar el dato");
				return false;
			}

		}

		function existePrueba($txcodigo){
			$data=$this->bd->ExecuteSQL("SELECT count(txcodigo) FROM datos_santp where txcodigo='". $txcodigo."' ");

			$result = @pg_fetch_array($data,0);
			 $existe=$result[0];

			if ($existe>0) return true;
			else return false;
		}
		function 
modificarPrueba($txruta,$txfecha,$txcodigo,$txnombre){
			try{
				$this->bd->ExecuteNonQuery("update datos_santp set 
				tx_ruta='".$txruta."',tx_fecha='".$txfecha."',tx_direccion='".$txcodigo."',tx_nombre='".$txnombre."' where tx_codigo='". $txcodigo."' ");
				return true;
			} catch (Exception $e) {
				throw new Exception("Ha ocurrido un error al modificar el dato");
				return false;
			}

		}
		function eliminarPrueba($txcodigo){			
			try{				
				$this->bd->ExecuteNonQuery("delete from datos_santp where txcodigo='" . $txcodigo."' ");							
				return true;
			} catch (Exception $e) {
				throw new Exception("Ha ocurrido un error al eliminar el dato");
				return false;
			}
				}  
		function obtenerPrueba($txcodigo){
			$data=$this->bd->ExecuteSQL("SELECT * FROM datos_santp where txcodigo='".$txcodigo."' ");
			return  $data;
		} 
		
		
     function listarDatos(){
			$data=$this->bd->ExecuteSQL("SELECT * FROM datos_santp");
			return  $data;
		}
		
		function numfilas()
		{
			$data=$this->bd->ExecuteSQL("SELECT count(txcodigo) FROM datos_santp");

			$result = @pg_fetch_array($data,0);
			$existe=$result[0];

			return $existe;
		}
    }
  ?>
