<?php
	include "../controles/header.php";

	include_once "../clases/cargarLog.php";
	$log = new Log();
	
	include_once "../clases/clad.php";
	$clad = new clad();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title><?php echo $config->nombreAplicacion; ?></title>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>   
	<script language="JavaScript" type="text/javascript" src="../js/injectionJS.js"></script>
</head>
<body>
<table width="760px" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<?php echo $pres->crearEncabezado($config->nombreAplicacion); ?>
		</td>
	</tr>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
			<tr>
				<td>
				<?php 
					//$titulo = "<a href='principal.php' class='link_blanco'>Inicio</a>";
					$texto = "<a id='lnkInicio' href='principal.php' class='link_blanco'>Inicio</a>&nbsp;-&nbsp;" .
							 "<a href='organizacion.php' class='link_blanco'>Organización</a>&nbsp;-&nbsp;" .
							 "<a href='servicios.php' class='link_blanco_sel'>Servicios</a>&nbsp;-&nbsp;" .
							 "<a id='lnkNoticias' href='principal.php?noti=1' class='link_blanco'>Noticias</a>&nbsp;-&nbsp;" .
							 "<a id='lnkUltimas' href='principal.php?rec=1' class='link_blanco' title='ÚLTIMAS NORMAS ACTUALIZADAS O DESARROLLADAS'>Últimas Normas</a>" . 
							 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='login.php' class='link_blanco'>Salir</a>";
								 
					echo $pres->crearVentanaInicio($texto);
					include "../controles/menu.php";
					echo $pres->crearVentanaIntermedia();
				?>
				<form id="form1" method="post" style="margin:0px">
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td height="8px"></td>
						</tr>
						<tr>
							<td align="center">
								<OBJECT HEIGHT="77">
									<PARAM NAME="MOVIE" VALUE="banner_SANTP.swf">
									<param name="quality" value="high">
									<EMBED SRC="../imagenes/banner_SANTP.swf" WIDTH="380" HEIGHT="420"></EMBED>
								</OBJECT>
							</td>
						</tr>
					</table>
				</form>
				<?php echo $pres->crearVentanaFin(); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $pres->crearPie(); ?>
		</td>
	</tr>
</table>
</body>
</html>