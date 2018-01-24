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
			<?php 
				$texto = "<a id='lnkInicio' href='principal.php' class='link_blanco'>Inicio</a>&nbsp;-&nbsp;" .
						 "<a href='organizacion.php' class='link_blanco'>Organización</a>&nbsp;-&nbsp;" .
						 "<a href='servicios.php' class='link_blanco'>Servicios</a>&nbsp;-&nbsp;" .
						 "<a id='lnkNoticias' href='principal.php?noti=1' class='link_blanco'>Noticias</a>&nbsp;-&nbsp;" .
						 "<a id='lnkUltimas' href='principal.php?rec=1' class='link_blanco' title='ÚLTIMAS NORMAS ACTUALIZADAS O DESARROLLADAS'>Últimas Normas</a>";
				
				echo $pres->crearVentanaInicioSinMenu($texto);
				echo $pres->crearVentanaIntermedia();
			?>
			<table cellpadding="0" cellspacing="0" border="0" width="760px" height="100%">
				<tr>
					<td>
						<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
							<!--
							<tr>
								<td width="180px" valign="top" rowspan="4">
									<img src="../imagenes/SANTP_afiche.jpg">
								</td>
							</tr>
-->
							<tr>
								<td width="760px" height="20px" valign="top">
									<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
										<tr>
											<td width="120px" valign="top">
												<img src="../imagenes/SANTP_afiche.jpg" width="100px" >
											</td>
											<td valign="top" height="20px">
												<form id="form1" method="post" style="margin:0px">
												
													<table cellpadding="0" cellspacing="0" border="0">
														<tr>
															<td width="580px" height="40px" valign="top" class="Titulo" colspan="3">
																MOTOR DE BÚSQUEDA
															</td>
														</tr>
														<tr>
															<td class="Detalle" width="50px">
																Buscar:
															</td>
															<td width="100px">
																<input type="text" id="txtBuscar" name="txtBuscar" size="40" class="Detalle" maxlength="100" value="<?php if(isset($_POST["txtBuscar"])) echo $_POST["txtBuscar"]; ?>" />
															</td>
															<td width="200px">
																<?php echo $pres->crearBoton("btnBuscar", "Buscar", "submit", "style=\"width: 70px\""); ?>
															</td>
														</tr>
														<tr>
															<td></td>
															<td colspan="2">
																<table cellpadding="0" cellspacing="0" border="0">
																	<tr>
																		<td height="25px">
								                                            <input type="checkbox" name="chkBuscarTitulo" id="chkBuscarTitulo" <?php if(isset($_POST["chkBuscarTitulo"])) echo "checked" ?>>
																		</td>
																		<td>
																			<label class="Detalle" for="chkBuscarTitulo">Buscar en el título</label>
																		</td>
																	</tr>
																	<tr>
																		<td height="25px">
								                                            <input type="checkbox" name="chkBuscarContenido" id="chkBuscarContenido" <?php if(isset($_POST["chkBuscarContenido"])) echo "checked" ?>>
																		</td>
																		<td>
																			<label class="Detalle" for="chkBuscarContenido">Buscar en el contenido</label>
																		</td>
																	</tr>
																	<tr>
																		<td height="25px">
								                                            <input type="checkbox" name="chkBuscarCodigo" id="chkBuscarCodigo" <?php if(isset($_POST["chkBuscarCodigo"])) echo "checked" ?>>
																		</td>
																		<td>
																			<label class="Detalle" for="chkBuscarCodigo">Buscar en el código</label>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													
												</form>
			
											</td>
										</tr>
										<tr>
											<td valign="top" height="100%" colspan="3">

<?php
	if(isset($_POST) && isset($_POST["btnBuscar"]) && $_POST["btnBuscar"]!=""){
		$tipoBusqueda = array();
		$datos = array();
		$error = "";
		
		if(isset($_POST["chkBuscarCodigo"])) $tipoBusqueda []= "codigo";
		if(isset($_POST["chkBuscarTitulo"])) $tipoBusqueda []= "titulo";
		if(isset($_POST["chkBuscarContenido"])) $tipoBusqueda []= "contenido";

		if(strlen(trim($_POST["txtBuscar"]))>=3 && count($tipoBusqueda)>0){
			$datos = $clad->obtenerNormas($tipoBusqueda, $_POST["txtBuscar"]);

			if(count($datos)==0)
				$error = "No hay resultados";
		}else{
			$error = "Debe escribir una palabra (de al menos 3 caracteres) y seleccionar alguna opción de búsqueda";
		}
		
		if($error==""){
?>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="3">
						<strong class='Titulo'>Resultado:</strong>
					</td>
				</tr>
				<tr>
					<td height="10px"></td>
				</tr>
				<tr>
					<td class='Titulo' width="30px"></td>
					<td class='Titulo' width="140px">
						Código
					</td>
					<td class='Titulo' width="580px">
						Título de la norma
					</td>
				</tr>
				<tr>
					<td height="5px"></td>
				</tr>

				<?php
					$i = 1;
					foreach($datos as $llave=>$valor)
					{
						//$codigo = str_replace(".pdf", "", strtolower(basename($valor["tx_ruta"])));
						$codigo = $valor["tx_codigo"];

						$rutaDoc = array();
						$rutaDocumento = "";
						$pres->pg_array_parse( $valor["indice"], $rutaDoc ); //Ruta del documento

						$rutaSize = sizeof( $rutaDoc );
						for( $j = 1; $j < $rutaSize; $j++ )
						{
							$rutaDocumento .= "'" . $rutaDoc[$j] . "'";
							if( $j < $rutaSize - 1 ) $rutaDocumento .= " > ";
						}
				?>
					<tr>
						<td class="Detalle">
							<?php echo $i; ?>
						</td>
						<td>
							<b>
								<a href="<?php echo $valor["tx_ruta"]; ?>" target="_blank" class='TextoLink'>
									<?php 
										if($codigo=="")
											echo "N/A";
										else
											echo $codigo;
									?>
								</a>
							</b>
						</td>
						<td>
							<a href="<?php echo $valor["tx_ruta"]; ?>" target="_blank" class="TextoLink">
								<?php
									if(strpos($valor["tx_ruta"], "/esp")!==false) echo "(Grupo Técnico) ";

									if($valor["tx_nombre"]=="")
										echo "N/A";
									else
										echo $valor["tx_nombre"];
								?>
							</a>
							<img src="../imagenes/icon_info.gif" height="13px" title="<?php echo $rutaDocumento; ?>">
						</td>
					</tr>
					<tr>
						<td width="100%" colspan="3" class="linea"></td>
					</tr>
					<tr>
						<td height="4px"></td>
					</tr>
				<?php
						$i++;
					}
				?>

			</table>

<?php
		}else{
?>

			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="100%">
						<strong class='Error'><?php echo $error; ?></strong>
					</td>
				</tr>
			</table>

<?php
		}
	}
?>

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

