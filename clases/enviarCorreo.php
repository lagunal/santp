<?php

include_once("class.clienteSoCorreo.php");
include_once( "../config.php" );

function enviarCorreo( $id, $nombre, $destinatario )
{
	$config = new config();
	$sw = new clienteSoCorreo( $config->rutaWSCorreo );

	$mensaje = "El Proceso de Normalización Técnica Corporativa, ha recibido una solicitud de elaboración o revisión de normas técnicas PDVSA, emitida por $nombre, Indicador $id, de fecha: " . date( "d/m/Y g:i a " ); ;

	$ret = $sw->enviarCorreoElectronico( '883328d7c49b773b42767f9fea66c91f', 
						'Solicitud de Elaboración o revisión de normas técnicas PDVSA en el SANTP',
						$destinatario,
						$mensaje );

	return $ret->codigoMensaje;
}

?>
