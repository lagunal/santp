<?php
include "postgresqlHelper.php";
include_once "../config.php";
  
class clad{
	private $pgHelper;

	private $ruta;
	
	function clad($conString=""){
		$this->ruta = "http://www.intevep.pdv.com/";
		
        if($conString==""){
            $conf = new config();
            $conString = $conf->queryString;
        }
        
        $this->pgHelper = new postgresqlHelper($conString);
    }

    public function setConectionString($conString){
        $this->conectionString=$conString;
    }

//BUSCADOR
	private function crearAND($patron, $datos){
		$and=false;
		$cadena = " ( ";
		
		$datos = strtolower($datos);
		$trozos = explode(" ", $datos);

		foreach($trozos as $llave=>$valor){
			if($valor!=""){
				if($and) $cadena .= " AND ";

				$cadena .= str_replace("$", $valor, $patron);
			
				$and = true;
			}
		}
		$cadena .= " ) OR ";
		
		return $cadena;
	}

	private function crearOR($patron, $datos, $and=false){
		$cadena = "";
		
		$datos = strtolower($datos);
		$trozos = explode(" ", $datos);

		foreach($trozos as $llave=>$valor){
			if($valor!=""){
				if($and) $cadena .= " OR ";

				$cadena .= str_replace("$", $valor, $patron);
			
				$and = true;
			}
		}
		
		return $cadena;
	}
	
	public function obtenerNormas($tipo, $palabras){
		$query =  "SELECT DISTINCT tx_nombre, tx_ruta, tx_codigo, ";
		$query .= "
			array(
				SELECT nombre 
				FROM prueba_santp, t_estructura
				WHERE 
				codigo_norma = ps.codigo_norma AND
				upper(tx_ruta) like upper( '" . $this->ruta . "' || codigo_estructura || '%' )
				ORDER BY length(codigo_estructura)
			) as indice ";
		$query .= "FROM prueba_santp ps, t_estructura WHERE visible=1 AND ( ";

		$palabra = trim($palabras);

		foreach($tipo as $llave=>$valor){
			switch ($valor){
				case "codigo":
					$query .= $this->crearAND(" (LOWER(tx_codigo) LIKE '%$%' OR tx_ruta LIKE ('%$%')) ", $palabra );
					$condicion = true;
				break;
				case "titulo":
					$query .= $this->crearAND(" LOWER(tx_nombre) LIKE '%$%' ", $palabra );
					$condicion = true;
				break;
				case "contenido":
					$query .= $this->crearAND(" prue_col_idx @@@ to_tsquery ('$:B') ", $palabra );
					$condicion = true;
				break;
			}
		}

		$query = substr( $query, 0, strlen( $query ) - 3 );

		$query .= ") AND upper(tx_ruta) like upper( '" . $this->ruta . "' || codigo_estructura || '%')";
							
		$query .= " ORDER BY tx_codigo ASC;";

		//echo $query;
		
		return $this->pgHelper->obtenerDatos($query);
	}


//PÁGINA PRINCIPAL
    public function obtenerPadre($ruta){
		$query = "SELECT codigo_padre FROM t_estructura WHERE codigo_estructura = '$ruta'";

        return $this->pgHelper->obtenerEscalar($query);
    }
	
    public function obtenerRutas($ruta, $tipo){
		$query = "SELECT * FROM t_estructura WHERE codigo_padre like '$ruta' AND tipo = $tipo ORDER BY orden, nombre";

        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerRutasRecientes($ruta){
		$query = "SELECT DISTINCT est.* FROM t_estructura est, prueba_santp ps
					WHERE visible=1 AND 
					codigo_padre like '$ruta' AND tipo<>1 AND ps.tx_ruta like '%' || est.codigo_estructura || '%'
					AND (position(substring(to_char(date_part('year', now())-1, '9999') from 4 for 2) IN tx_fecha)>0 OR 
				    position(substring(to_char(date_part('year', now()), '9999') from 4 for 2) IN tx_fecha)>0)
					ORDER BY orden, codigo_estructura";

		//echo $query;
        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerRutasPrincipales(){
        $query = "SELECT * FROM t_estructura WHERE principal=1 ORDER BY codigo_estructura";

        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerArchivos($ruta){
    	$ruta = $this->ruta . $ruta;
		
        //$query = "SELECT tx_ruta, tx_nombre, tx_codigo FROM prueba_santp WHERE tx_ruta<>'' ORDER BY 1";
	$query = "SELECT tx_ruta, tx_nombre, tx_codigo, fecha, revision FROM prueba_santp 
			  WHERE visible=1 AND upper(tx_ruta) like upper('$ruta%') ORDER BY 3,2";

	//echo $query;
        return $this->pgHelper->obtenerDatos($query);
    }

    public function obtenerArchivosRecientes($ruta){
        //$query = "SELECT tx_ruta, tx_nombre, tx_codigo FROM prueba_santp WHERE (date_part('year', now()) - date_part('year', fecha))=1";
		/*$query = "SELECT tx_ruta, tx_nombre, tx_codigo FROM prueba_santp WHERE 
					position(substring(to_char(date_part('year', now())-1, '9999') from 4 for 2) IN tx_fecha)>0 OR 
					position(substring(to_char(date_part('year', now()), '9999') from 4 for 2) IN tx_fecha)>0";*/

    	$ruta = $this->ruta . $ruta;
		
        //$query = "SELECT tx_ruta, tx_nombre, tx_codigo FROM prueba_santp WHERE tx_ruta<>'' ORDER BY 1";
		$query = "SELECT tx_ruta, tx_nombre, tx_codigo, fecha, revision FROM prueba_santp 
					WHERE visible=1 AND tx_ruta like '$ruta%' AND
					(position(substring(to_char(date_part('year', now())-1, '9999') from 4 for 2) IN tx_fecha)>0 OR 
					position(substring(to_char(date_part('year', now()), '9999') from 4 for 2) IN tx_fecha)>0)
					ORDER BY 1";

	//echo $query;
        return $this->pgHelper->obtenerDatos($query);
    }


//SESIONES
    public function consultarBloqueoUsuario($id){
    	return $this->pgHelper->obtenerEscalar("SELECT count(*) FROM t_usuarios SET WHERE id='$id' AND bloqueado=1;");
    }

    public function bloquearUsuario($id, $bloqueo){
    	return $this->pgHelper->actualizarDatos("UPDATE t_usuarios SET bloqueado=$bloqueo WHERE id='$id';");
    }

    public function crearSesion($id, $nombre){
    	if($this->consultarSesion($id)!=0){
    		//$this->pgHelper->actualizarDatos("DELETE FROM t_sesion WHERE id='$id';");
		$this->pgHelper->actualizarDatos("UPDATE t_sesion set valido='false' WHERE id='$id';");
    	}

       	return $this->pgHelper->actualizarDatos("INSERT INTO t_sesion (id, nombre_sesion) VALUES ('$id', '$nombre');");
    }

    public function cerrarSesion( $id )
    {
	$this->pgHelper->actualizarDatos("UPDATE t_sesion set valido='false' WHERE id='$id';");
    }

    public function consultarSesion($id){
        //$query = "SELECT count(*) FROM t_sesion WHERE id='$id';";
        $query = "SELECT count(*) FROM t_sesion WHERE id='$id' and valido='true';";

        return $this->pgHelper->obtenerEscalar($query);
    }

    //Consulta si la sección sigue activa
    public function consultarSesionNombre($id, $nombre)
    {
	include_once "presentacion.php";

	$pres = new presentacion();
	$ret = 0;
	$now = 0;

	$query = "SELECT fecha_ultima_accion FROM t_sesion WHERE id='$id' AND nombre_sesion='$nombre' AND valido='true';";
        $fecha = $this->pgHelper->obtenerEscalar($query);

	if( $fecha != "" )
	{
	    $query = "SELECT now()";
            $now = $this->pgHelper->obtenerEscalar($query);

	    //Pasaron más de 15 minutos, cerrar sesión
	    if( $pres->dateTimeDiff( $now, $fecha ) >= 15 )
	    {
                 $this->cerrarSesion( $id );
	    } else {
	         $query = "UPDATE t_sesion SET fecha_ultima_accion = now() WHERE id='$id' AND nombre_sesion='$nombre' AND valido='true';";
                 $fecha = $this->pgHelper->actualizarDatos($query);
                 $ret = 1;
            }
	}

	return $ret;
    }

    public function consultarSesionesTotal( ){
        $query = "SELECT count(*) FROM t_sesion;";

        return $this->pgHelper->obtenerEscalar($query);
    }

    public function consultarVisitasPeriodo( $fechai, $fechaf ){
        $query = "SELECT count(*) FROM t_sesion WHERE fecha_ultima_accion BETWEEN to_timestamp('$fechai 00:00:00', 'DD/MM/YYYY HH24:MI:SS') AND to_timestamp('$fechaf 23:59:59', 'DD/MM/YYYY HH24:MI:SS')";

        return $this->pgHelper->obtenerEscalar($query);
    }


//Logging de errores
    public function agregarError($num_err, $cadena_err, $archivo_err, $linea_err, $errcontext){
        return $this->pgHelper->actualizarDatos("SELECT func_insert_error($1, $2, $3, $4, $5);", array($num_err, $cadena_err, $archivo_err, $linea_err, $errcontext));
    }

    
//Opciones
    public function obtenerConfiguracion($id){
        $query = "SELECT DISTINCT cp.codigo_usuario, cp.actualizar, cp.rangografico, ce.codigo_equipo, mostrar FROM t_configuracion_personal cp, t_configuracion_equipos ce WHERE UPPER(cp.codigo_usuario)=UPPER(ce.codigo_usuario) AND UPPER(cp.codigo_usuario)=UPPER('$id');";

        return $this->pgHelper->obtenerDatos($query);
    }
    
    
//Acceso
    public function obtenerAcceso($id){
        $query = "SELECT acceso FROM t_lista_acceso WHERE codigo_usuario = '$id';";
        
        return $this->pgHelper->obtenerEscalar($query);
    }

//USUARIO
    public function obtenerRoles(){
        $query = "SELECT * FROM t_rol";

        return $this->pgHelper->obtenerDatos($query);
    }

	private function obtenerArreglo($datos){
		$res = array();
		
		foreach($datos as $llave=>$valor){
			foreach($valor as $llave2=>$valor2){
				$res[]= $valor2;
			}
		}
		
		return $res;
	}

   	public function buscarUsuariosAdministradores(){
    	$query = "SELECT count(id) FROM t_usuarios WHERE codigo_rol=3;";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }

    public function buscarRolUsuario($id){
    	$query = "SELECT t_usuarios.codigo_rol FROM t_usuarios WHERE id= LOWER('$id');";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }
	
    public function buscarRecursosUsuario($id){
    	$query = "SELECT re.nombre_recurso FROM t_usuarios us, t_rol ro, t_recurso re, t_rol_recurso rr WHERE us.id = LOWER('$id') AND us.codigo_rol = ro.codigo_rol AND ro.codigo_rol = rr.codigo_rol AND rr.codigo_recurso = re.codigo_recurso;";
    	
    	return $this->obtenerArreglo($this->pgHelper->obtenerDatos($query));
    }

    public function obtenerUsuariosRoles(){
        $query = "select * from t_usuarios us, t_rol ro WHERE us.codigo_rol = ro.codigo_rol;";

        return $this->pgHelper->obtenerDatos($query);
    }
    
    public function buscarUsuario($id){
    	$query = "SELECT count(id) FROM t_usuarios WHERE id=LOWER('$id');";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }

    public function eliminarUsuarioRol($id){
    	$query = "DELETE FROM t_usuarios WHERE id=LOWER('$id');";
    	
        return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

    public function actualizarUsuarioRol($id, $rol){
    	$id = strtolower($id);

    	$query = "";
    	
    	if($this->buscarUsuario($id)==0){
    		$query = "INSERT INTO t_usuarios (id, codigo_rol) VALUES ('$id', $rol);";
    	}else{
    		$query = "UPDATE t_usuarios SET codigo_rol=$rol WHERE id=LOWER('$id')";
    	}
    	 
        return $this->pgHelper->actualizarDatos($query,array(),$id);
    }

    public function actualizarCorreo( $correo )
    {
	if( $this->pgHelper->obtenerEscalar("SELECT COUNT(*) FROM t_admin_santp") == 0 )
    		$query = "INSERT INTO t_admin_santp (correo_solicitud) VALUES ('$correo');";
	else
    		$query = "UPDATE t_admin_santp SET correo_solicitud='$correo';";
    	
        return $this->pgHelper->actualizarDatos($query,array(),$correo);
    }

    public function obtenerCorreo( )
    {
	$query = "SELECT correo_solicitud FROM t_admin_santp";
    	
        return $this->pgHelper->obtenerEscalar($query);
    }

//PAGINA ESTRUCTURA
    public function obtenerCodigoEstructura(){
        $query = "select codigo_estructura, codigo_estructura || '  -  ' || nombre as carpeta from t_estructura where principal = 1;";                

        return $this->pgHelper->obtenerDatos($query);
    }
	
	public function obtenerDatosEstructura($codigo){
        //$query = "select * from t_estructura where codigo_padre like '$codigo%' order by codigo_padre, codigo_estructura, orden;";                
		$query = "select b.* from ( select * from connectby( 't_estructura', 'codigo_estructura', 'codigo_padre', '$codigo', 0, '-' ) AS ( codigo_estructura text, codigo_padre text, nivel int, rama text ) ) as a, t_estructura b where a.codigo_estructura = b.codigo_estructura;";
        return $this->pgHelper->obtenerDatos($query);
    }
	
	public function obtenerCodigoPadre($codigo){
        $query = "select distinct codigo_padre from t_estructura;";                

        return $this->pgHelper->obtenerDatos($query);
    }
	public function obtenerCodigo($codigo){
        $query = "select codigo_estructura from t_estructura;";                

        return $this->pgHelper->obtenerDatos($query);
    }
    public function BuscarCodigoEstructura($codigo){
    	$query = "SELECT count(codigo_estructura) FROM t_estructura WHERE codigo_estructura=('$codigo');";
    	
    	return $this->pgHelper->obtenerEscalar($query);
    }
    public function InsertarEstructura($codigo, $padre, $carpeta, $nombre, $principal, $orden){
    	$query = "";
    	
   		$query = "INSERT INTO t_estructura (codigo_estructura, codigo_padre, carpeta, nombre, principal, orden, tipo) VALUES ('$codigo', '$padre', '$carpeta', '$nombre', $principal, $orden, 0);";

		return $this->pgHelper->actualizarDatos($query,array(),$codigo);
    }
    public function ModificarEstructura($codigo, $codigoOriginal, $padre, $carpeta, $nombre, $principal, $orden){
    	$query = "";
    	
   		$query = "UPDATE t_estructura SET codigo_estructura='$codigo', codigo_padre = '$padre', carpeta = '$carpeta', nombre = '$nombre', principal = $principal, orden = $orden, tipo = 0  WHERE codigo_estructura=('$codigoOriginal')";

        return $this->pgHelper->actualizarDatos($query,array(),$codigo);
    }
	
    public function BuscarCodigoPadreEstructura($codigo){
    	$query = "SELECT count(codigo_padre) FROM t_estructura WHERE codigo_padre=('$codigo');";

    	return $this->pgHelper->obtenerEscalar($query);
    }
    public function eliminarEstructura($codigo){
    	$query = "DELETE FROM t_estructura WHERE codigo_estructura=('$codigo');";
    	
        return $this->pgHelper->actualizarDatos($query,array(),$id);
    }
}
?>
