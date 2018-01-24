<?php
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header('Content-Type: text/html; charset=utf-8'); 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);

	if( !isset($_SERVER["HTTP_REFERER"]) || $_SERVER["HTTP_REFERER"]==""){
		header("Location: ../paginas/login.php");
		die();
	}

    session_start();
    extract($_POST);
    extract($_GET);

	header("Cache-Control: private");
    
    include_once "../clases/injectionPHP.php";
    include_once "../clases/autenticar.php";
    include_once "../clases/presentacion.php";
    include_once "../config.php";

    $aut = new autenticacion();
    $aut->autenticar();
    
    $pres = new presentacion();
    $config = new config();
    $clad = new clad();
    
    //SESIONES ACTIVAS
    if( $clad->consultarSesionNombre($_SESSION["id"], $_SESSION["nombre"])==0 ){
    	header("Location: ../paginas/login.php");
    	die();
    }

/*	
	error_reporting(E_USER_ERROR | E_USER_WARNING | E_USER_NOTICE);

	$gestor_errores_anterior = set_error_handler("miGestorErrores");

    function miGestorErrores($num_err, $cadena_err="", $archivo_err="", $linea_err="", $errcontext=""){
        if (error_reporting() == 0 || $num_err == 2048) {
            return;
        }
		
		$log = new Log();
        
        $log->guardarLog($log->logError, "ERRORES", "$num_err, $cadena_err, $archivo_err, $linea_err");
    }
*/

	//cargar();
	
	function autorizarPagina($recurso){
		include_once "../clases/clad.php";
		include_once "../clases/cargarLog.php";

		$log = new Log();
		$clad = new clad();

		$recursos = $clad->buscarRecursosUsuario($_SESSION["id"]);
		$res = array_search($recurso, $recursos);
		
		if($res!==false){
			$log->guardarLog($log->logAccesos, $recurso, "OK");
		}else{
			$log->guardarLog($log->logAccesos, $recurso, "NO");
			exit;
		}
	}
?>
<script language="JavaScript" type="text/javascript">
if(window.history.forward(1) != null){
	window.history.forward(1);
}
</script>
