<?php header('Content-type: text/html; charset=utf-8');  ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../styles/pdvsastyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php
include_once "../config.php";


//INICIO AUTORIZAR PÁGINA ***************
session_start();

include_once "../clases/clad.php";
include_once "../clases/cargarLog.php";

$recurso = "ACTUALIZAR";

$log = new Log();
$clad = new clad();

$recursos = $clad->buscarRecursosUsuario($_SESSION["id"]);
$res = array_search($recurso, $recursos);

if($res!==false){
	$log->guardarLog($log->logAccesos, $recurso, "OK");
	echo "ok";
}else{
	$log->guardarLog($log->logAccesos, $recurso, "NO");
	exit;
}
//FIN AUTORIZAR PÁGINA ***************

$config = new config();

// -------------------------------------- cadena de conexion ------------------------------------ //
// Conexion, seleccion de base de datos
$conn = pg_connect($config->queryString);
if (!$conn) {
	echo "Error al Conectar.\n";
	exit;
}


//$cmd = "rm /tmp/*.pdf*";
//echo "exit: " . shell_exec($cmd);
//exit;

$ini = "SELECT tx_ruta, tx_fecha, tx_codigo, tx_nombre, codigo_norma, fecha, revision, visible FROM prueba_santp WHERE length( tx_body ) = 0 AND visible = 1 ORDER BY codigo_norma DESC";
//$ini = "SELECT tx_ruta, tx_fecha, tx_codigo, tx_nombre, codigo_norma, fecha, revision, visible FROM prueba_santp WHERE codigo_norma = 92630 ORDER BY codigo_norma DESC";

$datos = pg_query($ini);
$filas = pg_num_rows($datos);

$res = array();
        
for( $i=0; $i<$filas; $i++ )
{
	//echo $i .", ";
	$res = pg_fetch_array($datos, $i, PGSQL_ASSOC);

	// -------------------------------------- Recupero la información del formulario ------------------------------------//
	
	$codigo = $res['codigo_norma'];
	$ruta = $res['tx_ruta'];
	$ruta = str_replace( "http://www.intevep.pdv.com", "http://129.90.20.14", $res['tx_ruta'] );
	//$ruta = str_replace( "%20", " ", $res['tx_ruta'] );
	//-------------------------------------------------------------------------------------------------------------------// 

	if( trim( $ruta ) != '' )
	{
		$archivo = basename($ruta);
	
		// ------ Transformo de .pdf a .txt ------------------------------//
		//$cmd= "/usr/bin/pdftotext 'document/$cont[$i]' -enc UTF-8 -"; //transformo el archivo a .txt
	
		$salida = shell_exec( "wget -q $ruta -P /tmp" );
		$salida = pg_escape_string($salida);

		//$cmd = "/usr/bin/pdftotext /tmp/$archivo -enc UTF-8 - 2>&1";
		shell_exec( "touch /tmp/file_santp.txt" );
		$salida = shell_exec( "/usr/bin/pdftotext /tmp/$archivo -enc UTF-8 - > /tmp/file_santp.txt" );

		$file = fopen( "/tmp/file_santp.txt", "r" );
		$salida = stream_get_contents($file);
		$salida = pg_escape_string($salida);
		$salida = trim( $salida );

		//echo $salida;
		//echo "<br>";

		shell_exec( "rm /tmp/$archivo" );
		shell_exec( "rm /tmp/file_santp.txt" );
		//echo shell_exec( "y | rm /tmp/*.pdf*" );

		// ---------------------------Guardo en base de datos------------------------------------ //

		pg_query( "UPDATE prueba_santp SET tx_body = '$salida' WHERE codigo_norma=$codigo;" );

		$actu = "UPDATE prueba_santp SET 
				prue_col_idx = setweight (to_tsvector(coalesce(tx_nombre, '')),'A') || setweight (to_tsvector(coalesce(tx_body, '')),'B')
			 WHERE codigo_norma=$codigo;";
	}
	else
	{
		$actu = "UPDATE prueba_santp SET 
				prue_col_idx = '',
				tx_body = 'sin ruta'
			WHERE codigo_norma=$codigo;";
	}

	pg_query($actu);

	echo "ok: " . $codigo . "<br>";
}

?>

