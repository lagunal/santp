<?php
	include_once "../config.php";
	
     class clsPostgreSQL {

		//Miembros:
		public $strUsuario;
		public $strPassword;
		public $strHost;
		public $strPort;
		public $strDbname;
		private $conexion;

		//Metodos:
		public function __construct($Usuario,$Password,$Host,$Port,$Dbname) {
		   $this->strUsuario = $Usuario;
		   $this->strPassword = $Password;
		   $this->strHost = $Host;
		   $this->strPort = $Port;
		   $this->strDbname = $Dbname;
		}

		private function conectar() {
			$config = new config();
			
			return  pg_connect($config->queryString);
		}

		//ejecutar un query y devolver data
		public function ExecuteSQL($tx_query)
		{

			$this->conexion=$this->conectar();
			$result = @pg_query($this->conexion, $tx_query);
			return $result;
		}

		//ejecuta un query (insert,update y delete) y devuelve el numero de filas afectadas
		public function ExecuteNonQuery($tx_query)
		{
			$this->conexion=$this->conectar();

			$result = @pg_query($this->conexion, $tx_query);
			if ($result) {
				$cmdtuples = pg_affected_rows($result);
				return $cmdtuples;
			}
			else
				throw new Exception("Ha ocurrido un error al tratar de efectuar una 
operaci�n sobre la base de datos");
		}

		//ejecutar un query parametrizado y devuelve la data
		public function ExecuteSQL_Params($tx_query,$params)
		{
			$this->conexion=$this->conectar();
			$result = pg_query($this->conexion, $tx_query);
			return $result;
		}

		//ejecutar store procedure
		public function StoreProcedure($procedure,$params)
		{
		   $sql = 'select "' . $proc . '"(';

		   $sql .= $params[0][2] == 'numeric' ? $params[0][1] : "'" . 
str_replace("'","''",$params[0][1]) . "'";
		   $len = count($params);
		   for ($i = 1; $i < $len; $i ++)
		   {
			   $sql .= ',';
			   $sql .= $params[$i][2] == 'numeric' ? $params[$i][1] : "'" . 
str_replace("'","''",$params[$i][1]) . "'";
		   }
		   $sql .= ')';
			$this->conexion=$this->conectar();
			$result = pg_query($this->conexion, $sql);
			return $result;
		}

		public function StoreProcedure2($procedure)
		{

			$this->conexion=$this->conectar();
			$result = pg_query($this->conexion, "select " . $procedure . "()");
			return $result;
		}
		/*
		 * generate sql statements to call db-server-side stored procedure(or 
function)
		 * @parameter    string    $proc        stored procedure name.
		 * @parameter    array    $paras        parameters, 2 dimensions array.
		 * @return        string    $sql = 'select "proc"(para1,para2,para3);'
		 * @example    pg_prepare('userExists',
		 *                            array(
		 *                                array('userName','chin','string'),
		 *                                array('userId','7777','numeric')
		 *                            )
		 * )
		 */
		private function pg_prepare($proc, $paras)
		{
		   return $sql;
		}



    }
  ?>
