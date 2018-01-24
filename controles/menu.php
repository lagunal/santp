<?php
$recursos = array();

if(isset($_SESSION["id"])) $recursos = $clad->buscarRecursosUsuario($_SESSION["id"]);

$opciones = array(
                array("Formato de Solicitud de &nbsp;&nbsp;&nbsp;Elaboración o Revisión &nbsp;&nbsp;&nbsp;de Norma", "formatoSolicitud.php"),
                array("Encuesta de Satisfacción &nbsp;&nbsp;&nbsp;del Usuario</strong>", "encuestaUsuario.php"),
                array("Reportes de Solicitud", "reportesSolicitud.php", "REPORTES"),
                array("Reportes de Encuesta", "reportesEncuesta.php", "REPORTES"),
                array("Reportes de Visitas", "reporteVisitas.php", "REPORTES"),
                array("Formato de Actualización &nbsp;&nbsp;&nbsp;de Indexado", "actualizacionIndexado.php", "ACTUALIZAR"),
                array("Formato de Edición de &nbsp;&nbsp;&nbsp;Datos", "edicionDatos.php", "ACTUALIZAR"),
		array("Estructura de Normas", "estructura.php", "ACTUALIZAR"),
                array("Usuarios", "usuarios.php", "USUARIOS"),
                array("Administración", "admin.php", "USUARIOS"),
                array("Registro de accesos", "logArchivo.php", "LOG")
            );

$c = count($opciones);

for($i=0; $i<$c; $i++){
	$mostrar = false;
	
	if(isset($opciones[$i][2]) && $opciones[$i][2]!=""){
		$res = array_search($opciones[$i][2], $recursos);

		if($res!==false) $mostrar = true;
	}else{
		$mostrar = true;
	}
		
	if($mostrar){
	    echo "<a href=\"" . $opciones[$i][1] . "\" class=\"Contenedor-Texto-Menu\">" .
	    		"<span class=\"Text-menu\">" .
		    			$opciones[$i][0] 
	    		. "</span>" .
	    	 "</a>";
	
	    if($opciones[$i][0]!="")
	        echo "<span class=\"PuntoHo_Cortico\"></span>";
	    else
	        echo "<span></span><span class=\"Text-menu\">&nbsp;</span>";
	}
}
?>
