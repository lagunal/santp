<?php
	//include "../controles/header.php";

	include_once "../clases/clad.php";
	include_once "../clases/presentacion.php";
	include_once "../clases/autenticar.php";
	$clad = new clad();
	$pres = new presentacion();
	$aut = new autenticacion();
	
	
	
	if(!$aut->estaAutenticado()){
    	die();
    }
	
	$ruta = "";
	$rutaAtras = "";
	$recientes = false;
	$noticias = false;
	$base = 'santp/';

	if(isset($_GET["rec"])) $recientes = true;
	if(isset($_GET["noti"])) $noticias = true;

	if(isset($_GET["ruta"])) $ruta = $_GET["ruta"];
	else $ruta = $base;
	
	if($recientes){
		$datos = $clad->obtenerRutasRecientes($ruta);
	}else{
		if($noticias){
			$datos = $clad->obtenerRutas($ruta, 1);
		}else{
			$datos = $clad->obtenerRutas($ruta, 0);
		}
	}

	$padreActual = $clad->obtenerPadre($ruta);
	
	$c = count($datos);
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<table border="0" cellpadding="0" cellspacing="0">
	<?php
		if($noticias){
			echo "<tr>
					<td colspan=2 class='Titulo'>INFORMACIÓN DE INTERÉS</td>
				 </tr>
				 <tr><td height=5px></td></tr>";
		}else if(!$recientes){
			echo "<tr>
					<td colspan=2 class='Titulo'>ÍNDICE DE NORMAS TÉCNICAS DE PDVSA</td>
				 </tr>
				 <tr><td height=5px></td></tr>";
		}else{
			echo "<tr>
					<td colspan=2 class='Titulo'>ÚLTIMAS NORMAS ACTUALIZADAS O DESARROLLADAS</td>
				 </tr>
				 <tr><td height=5px></td></tr>";
		}
		
		if($ruta != $base){
			$rec = "";
			if(!isset($padreActual) || trim($padreActual)==""){
				$padreActual = $base;
			}else{
				$padreActual = urlencode($padreActual);
			}
			
			if($recientes) $rec = "&rec=1";
			if($noticias) $rec = "&noti=1";
			
			//Ruta de navegación
			$actualL = explode("-br-", $_GET["nombre"]);
			$actual2 = "";
			$cA = count($actualL);
			
			for($k=0; $k<$cA; $k++){
				if($actual2 != "") $actual2 .= "-br-";
				$tab = "";
				
				for($l=0; $l<$k; $l++) $tab .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
								
				$actual2 .= $tab . $actualL[$k];
			}

			//Nombre anterior
			array_pop($actualL);
			$nombreA = implode('-br-', $actualL);
			$rutaAtras = "?ruta=$padreActual&nombre=$nombreA" . $rec;
						
			echo "<tr>
					<td class='Detalle' colspan=3 width='445px' valign='top'><b>" . str_replace("-br-", "<br>", $actual2) . "</b></td>
					<td valign='top'>
						<table border='0' cellpadding='0' cellspacing='0'>
							<tr>
								<td>
									<a href='$rutaAtras'>
										<img src='../imagenes/flecha-izq.gif'>
									</a>
								</td>
								<td width='1px'><td>
								<td valign='middle'>
									<a href='$rutaAtras' class='TextoLink'>atrás</a>
								</td>
							</tr>
						</table>
					</td>
				 </tr>
				 <tr>
				 	<td height=5px></td>
				 </tr>
				 <tr>
				 	<td height=5px class='linea' colspan='5'></td>
				 </tr>
				 <tr>
				 	<td height=5px></td>
				 </tr>";
		}


		if($c<1){ //Muestra las normas

			if($recientes)
				$datos = $clad->obtenerArchivosRecientes($ruta);
			else
				$datos = $clad->obtenerArchivos($ruta);
			
			$c = count($datos);

			echo "<tr>
					<td class='Detalle' width='110px'><b>Código</b></td>
					<td class='Detalle' width='260px'><b>Título</b></td>
					<td class='Detalle' width='30px' align='center'><b>Rev</b></td>
					<td class='Detalle' width='40px' align='center'><b>Fecha</b></td>
				 </tr>
				 <tr>
				 	<td height=5px>
					</td>
				 </tr>";
				 
			for($i=0; $i<$c; $i++){
				echo "<tr>";
				$link = "<a href='" . $datos[$i]["tx_ruta"] ."' class='TextoLink' target='_blank'>";
				
				echo "<td>$link" . $datos[$i]["tx_codigo"] . "</a></td>";
				echo "<td class='Detalle'>$link" . $datos[$i]["tx_nombre"] . "</a></td>";
				echo "<td class='Detalle' align='center'>" . $datos[$i]["revision"] . "</td>";
				echo "<td class='Detalle' align='center'>" . $datos[$i]["fecha"] . "</td>";

				echo "</tr>";

				echo "<tr><td class='linea' colspan=5></td></tr>";
				echo "<tr><td height='3px'></td></tr>";
			}
			
		}else{ //Muestra la estructura de navegación
			
			for($i=0; $i<$c; $i++){
				echo "<tr>
					    <td width='10px'><img src='../imagenes/flechita.gif'></td>
					    <td width='450px'>";
				
				$rut = "";
				$tar = "";

				if($_GET["ruta"] == $base)
					$_GET["nombre"] = "";
				
				$url = $datos[$i]["codigo_estructura"];
				
				$http = strpos($datos[$i]["codigo_estructura"], "http");
				
				if($http===false){
					if($recientes){
						$rut = "?rec=1&ruta=";
					}else{
						if($noticias)
							$rut = "?noti=1&ruta=";
						else
							$rut = "?ruta=";
					}
					
					$url = $pres->formatearURL($url);
				}else{
					$tar = "target='_blank'";
				}
				
				$nombreRuta = "";
				
				if($_GET["nombre"] != ""){
					$nombreRuta .= $_GET["nombre"];
					$nombreRuta .= "-br-";
				}
				
				$nombreRuta .= $datos[$i]["nombre"];
				
				//echo "<a href='$rut" . $url . "&nombre=" . $nombreRuta . "&nombrea=$nombreA' $tar class='TextoLink'>" . $datos[$i]["nombre"] . "</a>";
				if($http===false){
					echo "<a href='$rut" . $url . "&nombre=" . $nombreRuta . "' $tar class='TextoLink'>" . $datos[$i]["nombre"] . "</a>";
				}else{
					echo "<a href='$url' $tar class='TextoLink'>" . $datos[$i]["nombre"] . "</a>";
				}
				
				echo "</td></tr>";
				echo "<tr><td height='4px'></td></tr>";
			}
			
		}
	?>
	</table>
</body>
<html>
