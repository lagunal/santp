<?php
	include "../controles/header.php";
/*
	include_once "../clases/clad.php";
	include_once "../clases/presentacion.php";
	$clad = new clad();
	$pres = new presentacion();
*/
	$ruta = "";
	$rutaAtras = "";
	$recientes = false;
	$noticias = false;
	
	//$_SESSION["rutaa"] = $_GET["ruta"];
	
	if(isset($_GET["rec"])) $recientes = true;
	if(isset($_GET["noti"])) $noticias = true;

	if(isset($_GET["ruta"])){
		$ruta = $_GET["ruta"];
	}else{
		$ruta = "santp/";
	}
	
	if($recientes){
		$datos = $clad->obtenerRutasRecientes($ruta);
	}else{
		if($noticias){
			$datos = $clad->obtenerRutas($ruta, 1);
		}else{
			$datos = $clad->obtenerRutas($ruta, 0);
		}
	}

	$actual = $_GET["nombre"];
	//$actual = $_GET["nombrea"] . "-" . $_GET["nombre"];

	echo $_SESSION["rutaa"];
	
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
		}
		

		if($ruta!="santp/"){
			$rec = "";
			if(!isset($_GET["rutaa"]) || trim($_GET["rutaa"])=="") $_GET["rutaa"] = "santp/";
			if($recientes) $rec = "&rec=1";
			if($noticias) $rec = "&noti=1";
			
			$rutaAtras = "?ruta=" . $pres->formatearURLRel($_GET["rutaa"]) . "&nombre=" . $_GET["nombrea"] . $rec;
			
			//Ruta de navegación
			$actualL = explode("-br-", $actual);
			$actual2 = "";
			$cA = count($actualL);
			
			for($k=0; $k<$cA; $k++){
				if($actual2 != "") $actual2 .= "-br-";
				$tab = "";
				
				for($l=0; $l<$k; $l++){
					$tab .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				}
								
				//$actual2 .= $k . " ";
				
				$actual2 .= $tab . $actualL[$k];
			}
			
			echo "<tr>
					<td class='Detalle' colspan=3 width='405px' valign='top'><b>" . str_replace("-br-", "<br>", $actual2) . "</b></td>
					<td>
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
				 </tr>";
		}

		if($c<=1){ //Muestra las normas

			if($recientes)
				$datos = $clad->obtenerArchivosRecientes($ruta);
			else
				$datos = $clad->obtenerArchivos($ruta);
			
			$c = count($datos);

			echo "<tr>
					<td class='Detalle' width='100px'><b>Código</b></td>
					<td class='Detalle' width='270px'><b>Título</b></td>
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
				echo "<tr><td height='2px'></td></tr>";
			}
			
		}else{ //Muestra la estructura de navegación
			
			for($i=0; $i<$c; $i++){
				echo "<tr>
					    <td width='10px'><img src='../imagenes/flechita.gif'></td>
					    <td width='410px'>";
				
				$rut = "";
				$tar = "";

				$rutaA = $_GET["ruta"];
				//$rutaA = $_SESSION["rutaa"];
				
				if($_GET["ruta"]=="santp/")
					$_GET["nombre"] = "";
				
				$nombreA = $_GET["nombre"];
				$url = $datos[$i]["codigo_estructura"];
				
				if(strpos($datos[$i]["codigo_estructura"], "http")===false){
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
				
				if($_GET["nombre"]!=""){
					$nombreRuta .= $_GET["nombre"];
					$nombreRuta .= "-br-";
				}
				
				$nombreRuta .= $datos[$i]["nombre"];
				
				$_SESSION["rutaa"] = $rutaA;
				
				echo "<a href='$rut" . $url . "&rutaa=$rutaA&nombre=" . $nombreRuta . "&nombrea=$nombreA' $tar class='TextoLink'>" . $datos[$i]["nombre"] . "</a>";
				echo "</td></tr>";
				echo "<tr><td height='2px'></td></tr>";
			}
			
		}
	?>
	</table>
</body>
<html>
