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
						 "<a href='organizacion.php' class='link_blanco_sel'>Organización</a>&nbsp;-&nbsp;" .
						 "<a href='servicios.php' class='link_blanco'>Servicios</a>&nbsp;-&nbsp;" .
						 "<a href='javascript:verNoticiasOtro()' class='link_blanco'>Noticias</a>&nbsp;-&nbsp;" .
						 "<a href='javascript:verUltimasOtro()' class='link_blanco'>Últimas Normas</a>";
				
				echo $pres->crearVentanaInicioSinMenu($texto);
				echo $pres->crearVentanaIntermedia();
			?>
			<table cellpadding="0" cellspacing="0" border="0" width="760px" height="100%">
				<tr>
					<td valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="100%">
							<tr>
								<td width="460px" valign="top">
									<table cellpadding="0" cellspacing="0" border="0" width="100%">
											<tr>
												<td height="5px"></td>
											</tr>
										
										<tr>
											<td valign="top">
												<table cellpadding="0" cellspacing="0" border="0" width="460px">
													<tr>
														<td class="Titulo" colspan="2">
															PROCESO DE NORMALIZACIÓN TÉCNICA CORPORATIVA (NOR)
														</td>
													</tr>
													<tr>
														<td height="5px"></td>
													</tr>
											<TR>
											<td class="Titulo">
											</td>
											</TR>
											<tr>
												<td height="25px"></td>
											</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td class="Detalle">
												<a class="TextoLink" href="http://www.intevep.pdv.com/santp/misionyvision.pdf">
												Para conocer la Visión, Misión, Política y objetivos de calidad del proceso NOR, 
												haga clic aqui</a>
											</td>
										</tr>
										<tr>
											<td height="150px"></td>
										</tr>
										<tr>
											<td>
												<img src="../imagenes/SANTP_afiche.jpg">
											</td>
										</tr>
									</table>
								</td>
								<td width="5px" class="Fondo-puntoVe-2"></td>
								<td width="285px" valign="top">
									

									<table cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td height="5px"></td>
										</tr>
										<tr>
											<td  class="Titulo" align="right">
												MAPA DE PROCESOS NOR
											</td>
										</tr>
										<tr>
											<td height="10px"></td>
										</tr>
										<tr>
											<td align="right">
												<a href='http://www.intevep.pdv.com/santp/imagenes/Mapa_NOR.png' class='TextoLink' target="_blank">Mapa de Procesos</a>  
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
													<EMBED SRC="../imagenes/banner_SANTP.swf" WIDTH="280" HEIGHT="320"></EMBED>
												</OBJECT>
											</td>
										</tr>
									</table>
									
									
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
