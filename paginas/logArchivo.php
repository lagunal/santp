<?php
include "../controles/header.php";

include_once "../clases/clad.php";
$clad = new clad();

include_once "../clases/cargarLog.php";
$log = new Log();

//INICIO AUTORIZAR PÁGINA ***************
autorizarPagina("LOG");
//FIN AUTORIZAR PÁGINA ***************

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title><?php echo $config->nombreAplicacion; ?></title>
	<link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>   
	<script language="JavaScript" type="text/javascript" src="../js/doPostBack.js"></script>
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
			<?php 
				$titulo = "<a id='lnkInicio' href='principal.php' class='link_blanco'>Inicio</a>&nbsp;-&nbsp;" .
						 "<a href='organizacion.php' class='link_blanco'>Organización</a>&nbsp;-&nbsp;" .
						 "<a href='servicios.php' class='link_blanco_sel'>Servicios</a>&nbsp;-&nbsp;" .
						 "<a id='lnkNoticias' href='principal.php?noti=1' class='link_blanco'>Noticias</a>&nbsp;-&nbsp;" .
						 "<a id='lnkUltimas' href='principal.php?rec=1' class='link_blanco' title='ÚLTIMAS NORMAS ACTUALIZADAS O DESARROLLADAS'>Últimas Normas</a>" . 
						 "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='login.php' class='link_blanco'>Salir</a>";

                echo $pres->crearVentanaInicio($titulo);
				include "../controles/menu.php";
				echo $pres->crearVentanaIntermedia();
			?>
			<form id="form1" method="post" style="margin:0px">
				<table height="100%" border="0" align="left" cellpadding="0" cellspacing="0">
					<tr>
						<td style="display:none">
							<input id="txtCodigo" name="txtCodigo" type="hidden" value="<?php if(isset($_POST["txtCodigo"])) echo $_POST["txtCodigo"]; ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $pres->crearSeparador("Archivo de accesos"); ?>
						</td>
					</tr>
					<tr>
						<td valign="top">
							<table height="100%" border="0" align="left" cellpadding="0" cellspacing="0">
								<tr>
									<td class="Sub-Titulo" width="90px">
										Archivo:
									</td>
									<td>
										<select name="cmbResultado" id="cmbResultado" onchange="javascript:doPostBack('form1');" class="Detalle" style="width:100px">
										<?php
											$log = new Log();
										
											$datos = array(
														array("", "Seleccione"),
														array($log->logAccesos, "Accesos"),
														array($log->logQuery, "Querys"),
														array($log->logError, "Errores")
													);
											
											$def = "";
											
											if(isset($_POST["cmbResultado"]))
												$def = $_POST["cmbResultado"];
											
											echo $pres->crearComboArray2($datos, $def);
										?>
									</select>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height="15px"></td>
					</tr>
					<tr>
						<td width="100%">
							<div style="overflow:auto; height:660px">
								<table cellpadding="0" cellspacing="0" border="0">
									<tr>
										<td width="580px" class="Sub-Titulo">Datos</td>
									</tr>
									<?php
										if(isset($_POST["cmbResultado"]) && $_POST["cmbResultado"]!=""){
											$datos = $log->cargarLog($_POST["cmbResultado"]);
											
											echo $pres->crearTablaLog($datos, "Lista-Fondo1", "Lista-Fondo2", false, false);
										}
									?>
								</table>
							</div>
						</td>
					</tr>
					<tr>
						<td height="100%"></td>
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