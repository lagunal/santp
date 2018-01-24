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
	
	$config = new config();
	
	// -------------------------------------- cadena de conexion ------------------------------------ //
	// Conexion, seleccion de base de datos
	$conn = pg_connect($config->queryString);
	  if (!$conn) {
	    echo "Error al Conectar.\n";
	    exit;
	  }
	//-------------------------------- Fin ---------------------------------------------------//
	
	// -------------------------------------- Tomo la Ip de la maquina ------------------------------------ //
	function ipreal(){
	  if ($_SERVER){
	      if ($_SERVER["HTTP_X_FORWARDED_FOR"])
	          $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	      else
	          if ( $_SERVER["HTTP_CLIENT_IP"] )
	              $ip = $_SERVER["HTTP_CLIENT_IP"];
	          else
	              $ip = $_SERVER["REMOTE_ADDR"];
	  }else{
	      if( getenv( "HTTP_X_FORWARDED_FOR" ) )
	          $ip = getenv( "HTTP_X_FORWARDED_FOR" );
	      else
	          if( getenv( "HTTP_CLIENT_IP" ) )
	              $ip = getenv( "HTTP_CLIENT_IP" );
	          else
	              $ip = getenv( "REMOTE_ADDR" );
	  }
	  
	  return $ip;
	}
	
	$ip = ipreal();
	//-------------------------------- Fin ---------------------------------------------------//
	 
	// -------------------------------------- Recupero la información del formulario ------------------------------------//
	$nombre=$_POST['nomb'];
	$ruta=$_POST['ruta'];
	$mes=$_POST['mes'];
	$year=$_POST['year'];
	$revision=$_POST['revi'];
	$codigo=$_POST['codi'];
	$archivo_name=$_POST['archivo_name'];
	$fecha="Rev. "."$revision"." / "."Fecha "."$mes "."$year";
	$ruta_archivo="http://www.intevep.pdv.com/santp/"."$ruta";
	//-------------------------------------------------------------------------------------------------------------------// 

	//---------------- Grabar el archivo en la carpeta raiz para luego -------------------------//
	//---------------- Proceder a indexarlo ----------------------------------------------------//
/*
	 $extension = explode(".",$archivo_name);
	 $archivo_name1="http://"."$ip"."/"."$extension[0]"."." ."$extension[1]";
	 $archivo=$archivo_name1;
	 
	 echo $archivo;
	 
	 //echo $extension[0];
		if($extension[1] =="pdf"){
			//if(!@copy($archivo, "document/"."$extension[0]"."." ."$extension[1]")){
			if(!copy($archivo, "document/"."$extension[0]"."." ."$extension[1]")){
				echo  "<script>alert('Error al copiar el archivo.');</script>";
				//echo "<script>document.location.href='../paginas/index.php';</script>";
			}
		}else{
			echo "Solo se debe Cargar archivos con extensión .pdf";
		}
	exit;
*/
	// -------------------------------- Fin --------------------------------------------------- // 
	 
	 // ------------- Leer el Nombre de los Archivos .pdf para luego transformarlos ---------------- //
	$i=0;
	foreach (glob("document//*.pdf") as $nombre_archivo) {
			$archivo = explode("//", $nombre_archivo);
			$cont[$i] = $archivo[1];
			$numero = count($cont);
			$i = $i + 1;
		}
	// ------------------------------------------------------------------------------------------ //

	echo $i;
	exit;
	
	// ------ Transformo de .pdf a .txt ------------------------------//
		for($i=0 ;$i<$numero; $i++){
			$cmd= "/usr/bin/pdftotext 'document/$cont[$i]' -enc UTF-8 -"; //transformo el archivo a .txt
	    	$salida = shell_exec("$cmd");
			$salida = pg_escape_string ($salida);
	// ------------------------------------------------------------------------------------------ //
	
	// ---------------------------Guardo en base de datos------------------------------------ //

			$ini = "Insert Into prueba_santp Values('$ruta_archivo', '$fecha', '$codigo', '$nombre', '$salida')";
			pg_query($ini);
		}
		
		$actu="UPDATE prueba_santp SET prue_col_idx = setweight (to_tsvector(coalesce(tx_nombre, '')),'A') ||
				setweight (to_tsvector(coalesce(tx_body, '')),'B');";
		pg_query($actu);
		echo  "<script>alert('La Carga se realizo satisfactoriamente.');</script>";
		echo "<script>document.location.href='../paginas/index.php';</script>";
		
	// ---------------------------------------------------------------------------------------------------- //
		
		//CREATE FUNCTION mytable_ft_trigger() RETURNS trigger AS $$
	//BEGIN
	  //new.tsv :=
	     //setweight(to_tsvector('tx_nombre', 
		 	//coalesce(new.field1,'')), 'A') ||
	    // setweight(to_tsvector('tx_body', 
		 	//coalesce(new.field2,'')), 'B');
	 // return new;
	//END;
	//$$ LANGUAGE plpgsql;
	//CREATE TRIGGER tsvectorupdate BEFORE INSERT OR UPDATE
	//ON prueba_santp FOR EACH ROW EXECUTE PROCEDURE mytable_ft_trigger();
?>
</body>
</html>