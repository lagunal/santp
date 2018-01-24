<?php
	include "../controles/header.php";

	include_once "../clases/cargarLog.php";
	$log = new Log();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title><?php echo $config->nombreAplicacion; ?></title>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>   
	<script language="JavaScript" type="text/javascript" src="../js/injectionJS.js"></script>
	<script language="JavaScript" type="text/javascript" src="../js/noticias.js"></script>
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
			<?php 
				$texto = "<a href='principal.php' class='link_blanco'>Inicio</a>&nbsp;-&nbsp;" .
						 "<a href='organizacion.php' class='link_blanco'>Organización</a>&nbsp;-&nbsp;" .
						 "<a href='servicios.php' class='link_blanco'>Servicios</a>&nbsp;-&nbsp;" .
						 "<a href='javascript:verNoticias(1)' class='link_blanco'>Noticias</a>&nbsp;-&nbsp;" .
						 "<a href='javascript:verNoticias(2)' class='link_blanco' title='ÚLTIMAS NORMAS ACTUALIZADAS O DESARROLLADAS'>Últimas Normas</a>";
						 
				
				echo $pres->crearVentanaInicioSinMenu($texto);
				echo $pres->crearVentanaIntermedia();
			?>
			<table cellpadding="0" cellspacing="0" border="0" width="760px" height="100%">
				<tr>
					<td valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td width="510px" valign="top">
									<table cellpadding="0" cellspacing="0" border="0" width="100%">
										<tr>
											<td valign="top">
												<table cellpadding="0" cellspacing="0" border="0" width="460px">
													<tr>
														<td valign="top" height="370px">

<?php
	$ruta = "../controles/indiceNormas.php";
	
	if(isset($_GET["noti"]) && $_GET["noti"]==1){
		$ruta .= "?noti=1";
	}

	if(isset($_GET["rec"]) && $_GET["rec"]==1){
		$ruta .= "?rec=1";
	}
?>

<iframe id="frmNormas" src="<?php echo $ruta;?>" frameborder="no" style="width: 505px; height:530px; border:0; marginheight:0; marginwidth:0; scrolling:no">
</iframe>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
								<td width="5px" class="Fondo-puntoVe-2"></td>
								<td width="235px" valign="top">
									
								<form id="form1" method="post" style="margin:0px" action="buscador.php">
								
									<table cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td colspan="3" class="Titulo">
												BUSCADOR
											</td>
										</tr>
										<tr>
											<td height="10px"></td>
										</tr>
										<tr>
											<td class="Detalle" width="40px">
												Buscar:
											</td>
											<td width="130px">
												<input type="text" name="txtBuscar" value="" size="19" class="Detalle" maxlength="40"/>
											</td>
											<td width="80px">
												<?php echo $pres->crearBoton("btnBuscar", "Buscar", "submit", "style=\"width: 55px\""); ?>
											</td>
										</tr>
										<tr>
											<td></td>
											<td colspan="2">
												<table cellpadding="0" cellspacing="0" border="0">
													<tr>
														<td>
				                                            <input type="checkbox" name="chkBuscarCodigo" id="chkBuscarCodigo" checked>
														</td>
														<td>
															<label class="Detalle" for="chkBuscarCodigo">Buscar en el código</label>
														</td>
													</tr>
													<tr>
														<td>
				                                            <input type="checkbox" name="chkBuscarTitulo" id="chkBuscarTitulo">
														</td>
														<td>
															<label class="Detalle" for="chkBuscarTitulo">Buscar en el título</label>
														</td>
													</tr>
													<tr>
														<td>
				                                            <input type="checkbox" name="chkBuscarContenido" id="chkBuscarContenido">
														</td>
														<td>
															<label class="Detalle" for="chkBuscarContenido">Buscar en el contenido</label>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td height="10px"></td>
										</tr>
										<tr>
											<td colspan="3" align="right">
												<table class="Fondonorma" border="0" width="85px" height="110px">
													<tr>
														<td></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="3" align="right">
												<OBJECT HEIGHT="77">
													<PARAM NAME="MOVIE" VALUE="banner_SANTP.swf">
													<param name="quality" value="high">
													<EMBED SRC="../imagenes/banner_SANTP.swf" WIDTH="250" HEIGHT="300"></EMBED>
												</OBJECT>
											</td>
										</tr>
									</table>
									
								</form>
									
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
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
