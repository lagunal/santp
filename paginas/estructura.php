<?php
	include "../controles/header.php";
	include "../clases/directorioActivo.php";
	$da = new directorioActivo( $_SESSION["ubicacion"] );
	
	include_once "../clases/cargarLog.php";
	$log = new Log();

	include_once "../clases/clad.php";
	$clad = new clad();

	$error = "";


	//INICIO AUTORIZAR PÁGINA ***************
	autorizarPagina("ACTUALIZAR");
	//FIN AUTORIZAR PÁGINA ***************


	if(isset($_POST["btnGuardar"]) && $_POST["btnGuardar"]!="" && isset($_POST["cmbPadre"]) && $_POST["cmbPadre"]!="" && isset($_POST["txtCodigo"]) && $_POST["txtCodigo"]!="" && isset($_POST["txtCarpeta"]) && $_POST["txtCarpeta"]!="" && isset($_POST["txtNombre"]) && $_POST["txtNombre"]!=""){
        if ($_POST["chkPrincipal"] == ''){$Principal = 0;}else{$Principal = 1;}
        if ($_POST["txtOrden"] == '') $_POST["txtOrden"] = 0;
		if( $clad->BuscarCodigoEstructura( $_POST["txtCodigo"] ) == 0 ){
		    $clad->InsertarEstructura($_POST["txtCodigo"], $_POST["cmbPadre"], $_POST["txtCarpeta"], $_POST["txtNombre"], $Principal, $_POST["txtOrden"]);
		}else{
			$error = "Este codigo de estructura ya existe: " . $_POST["txtCodigo"];
		}
	}

	if(isset($_POST["btnModificar"]) && $_POST["btnModificar"]!="" && isset($_POST["cmbPadre"]) && $_POST["cmbPadre"]!="" && isset($_POST["txtCodigo"]) && $_POST["txtCodigo"]!="" && isset($_POST["txtCarpeta"]) && $_POST["txtCarpeta"]!="" && isset($_POST["txtNombre"]) && $_POST["txtNombre"]!=""){
        if ($_POST["chkPrincipal"] == ''){$Principal = 0;}else{$Principal = 1;}
        if ($_POST["txtOrden"] == '') $_POST["txtOrden"] = 0;
		if( $clad->BuscarCodigoPadreEstructura( $_POST["txtCodigoOriginal"] ) == 0 ){
			$clad->ModificarEstructura($_POST["txtCodigo"], $_POST["txtCodigoOriginal"], $_POST["cmbPadre"], $_POST["txtCarpeta"], $_POST["txtNombre"], $Principal, $_POST["txtOrden"]);
		}else{
			$error = "No se puede modificar. Este codigo_estructura tiene hijos asociados: " . $_POST["txtCodigoOriginal"];
		}
	}
	
	if(isset($_POST["txtAccion"])){ 
		if($_POST["txtAccion"]=="e" && isset($_POST["txtCodigo"]) && $_POST["txtCodigo"]!=""){
			if( $clad->BuscarCodigoPadreEstructura( $_POST["txtCodigo"] ) > 0 ){
					$error = "No se puede eliminar. Este codigo_estructura tiene hijos asociados: " . $_POST["txtCodigo"];
			}else{
				$clad->eliminarEstructura($_POST["txtCodigo"]);
			}
		}
		
	}
	
	if (isset($_POST["btnBuscar"]) && $_POST["btnBuscar"] !='') $_SESSION["recarga_filtro"] = $_POST["btnBuscar"];
	if (isset($_POST["cmbEstructura"]) && $_POST["cmbEstructura"] !='') $_SESSION["recarga_combo"] = $_POST["cmbEstructura"];
	
	
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <title><?php echo $config->nombreAplicacion; ?></title>
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>   
	<script language="JavaScript" type="text/javascript" src="../js/formulaire.js"></script>
	<script language="JavaScript" type="text/javascript" src="../js/doPostBack.js"></script>
	<script language="JavaScript" type="text/javascript" src="../js/injectionJS.js"></script>
	<script language="JavaScript" type="text/javascript">
		function cargarValor(codigo, codigo_padre,carpeta,nombre,principal,orden){
			txtCodigoEst = document.getElementById("txtCodigo");
			txtCodigoOri = document.getElementById("txtCodigoOriginal");
			cmbPadres = document.getElementById("cmbPadre");
			txtCarpeta = document.getElementById("txtCarpeta");
			txtNombre = document.getElementById("txtNombre");
			chkPrincipales = document.getElementById("chkPrincipal");
			txtOrden = document.getElementById("txtOrden");
			
			txtCodigoEst.value = codigo;
			txtCodigoOri.value = codigo;
			cmbPadres.value = codigo_padre;
			txtCarpeta.value = carpeta;
			txtNombre.value = nombre;
		    chkPrincipales.value = principal;
			if (principal == 1){ 
			    chkPrincipales.checked = true;
			}else{	
			    chkPrincipales.checked = false;		
			}
			txtOrden.value = orden;
			
		}
		
		function eliminarEstructura(codigo){
			eliminarCampo('txtAccion', 'e', 'form1', 'txtCodigo', codigo);
		}

		function desbloquear(id){
			establecerValor('txtCodigo', id);
			doPostBackValor('form1', 'txtAccion', 'b');
		}
	</script>
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
	    		<table cellpadding="0" cellspacing="0" border="0" width="590px">
					<tr>
						<td colspan="3" height="0px" style="display:none">
							<input type="hidden" id="txtAccion" name="txtAccion"/>
							<input type="hidden" id="txtCodigoOriginal" name="txtCodigoOriginal"/>
							<input type="hidden" id="txtValores" name="txtValores" value=""/>
						</td>
					</tr>
					<tr>
						<td>
      						<?php echo $pres->crearSeparador("Filtrar Normas"); ?>
						</td>
					</tr>
					<tr>
						<td>
		                    <table cellpadding="0" cellspacing="0" border="0">
		                        <tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
		                        <tr>
		                            <td class="Detalle" width="70">
		                            	Código:
		                            </td>
		                            <td colspan="3" width="250px">
		                            	<select id="cmbEstructura" name="cmbEstructura" class="Detalle" style="WIDTH: 150px">
		                                <?php
		                                    $datos = $clad->obtenerCodigoEstructura();
		                                    
		                                    echo $pres->crearCombo($datos, "codigo_estructura", "carpeta", $_SESSION["recarga_combo"]);
		                                ?>
		                            	</select>
		                            </td>
		                        	<td colspan="3">
		                        	</td>
									<td>
										<?php echo $pres->crearBoton("btnBuscar", "Filtrar", "submit", ""); ?>
									</td>						
								</tr>
		                        <tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
		                    </table>
						</td>
					</tr>
					<tr>
						<td class="error">
							<?php echo $error; ?>
						</td>
					</tr>
					<tr>
						<td>
							<?php echo $pres->crearSeparador("Estructura de Normas"); ?>
						</td>
					</tr>
		                        <tr>
									<td width="100%">
									<table cellpadding="0" cellspacing="0" border="0">
										<tr>
											<td class="Detalle" width="10px">
												Código:
											</td>
											<td width="160px">
												<input id="txtCodigo" name="txtCodigo" type="text" value="" size="40" maxlength="100"/>
											</td>
											
											<td class="Detalle" width="70px">
												&nbsp;Código Padre:
											</td>
											<td  width="150px">
												<select id="cmbPadre" name="cmbPadre" class="Detalle" style="WIDTH: 150px">
												<?php
													$datos = $clad->obtenerCodigo();
													
													echo $pres->crearCombo($datos, "codigo_estructura", "codigo_estructura");
												?>
												</select>
											</td>
											<td class="Detalle" width="10px">
												&nbsp;Principal:
											</td>
											<td width="15px">
											    <input type="checkbox" id="chkPrincipal" name="chkPrincipal" value=1>
											</td>
										</tr>
				                        <tr>
											<td height="6px">
											</td>
										</tr>
										<tr>
											<td class="Detalle" width="10px">
												Carpeta:
											</td>
											<td width="160px">
												<input id="txtCarpeta" name="txtCarpeta" type="text" value="" size="40" maxlength="100"/>
											</td>
											<td class="Detalle" width="70px">
												&nbsp;Nombre:
											</td>
											<td width="150px">
												<input id="txtNombre" name="txtNombre" type="text" value="" size="25" maxlength="100"/>
											</td>
											<td class="Detalle" width="10px">
												&nbsp;Orden:
											</td>
											<td width="15px">
												<input id="txtOrden" name="txtOrden" type="text" value="" size="2" maxlength="5"/>
											</td>
										</tr>
				                        <tr>
											<td height="6px">
											</td>
										</tr>									
				                        <tr>
											<td colspan="3" align="right"> 
											<table cellpadding="0" cellspacing="0" border="0">
												<tr>
												<td> 
													<?php echo $pres->crearBoton("btnModificar", "Modificar", "submit", ""); ?>
												</td>
												</tr>
											</table>	
											</td>

											<td colspan="3" align="right"> 
											<table cellpadding="0" cellspacing="0" border="0">
												<tr>
												<td> 
													<?php echo $pres->crearBoton("btnGuardar", "Nuevo", "submit", ""); ?>
												</td>
												</tr>
											</table>	
											</td>

										</tr>									
				                        <tr>
											<td height="16px">
											</td>
										</tr>									
									</table>
									</td>
								</tr>
					<tr>
						<td width="100%">
		                    <table cellspacing="0" cellpadding="0" border="0">
		                    	<tr>
		                    		<td width="20px">
		                    		</td>
		                    		<td class="Titulo" width="200px">
		                    			Código
		                    		</td>
		                    		<td class="Titulo" width="150px">
		                    			Código Padre
		                    		</td>
		                    		<td class="Titulo" width="100px">
		                    			Carpeta
		                    		</td>
		                    		<td class="Titulo" width="150px">
		                    			Nombre
		                    		</td>
		                    	</tr>
							</table>
							<div style="overflow:auto; height:580px; width:600px">
								<table cellspacing="0" cellpadding="0" border="0">
							
			                    <?php
										if(isset($_SESSION["recarga_filtro"]) && $_SESSION["recarga_filtro"]!="" && isset($_SESSION["recarga_combo"]) && $_SESSION["recarga_combo"]!=""){
												$datosEstructura = $clad->obtenerDatosEstructura($_SESSION["recarga_combo"]);
												
												if(isset($datosEstructura[0]) && $datosEstructura[0]!=""){		
														echo $pres->crearTablaEstructura($datosEstructura, "Lista-Fondo1", "Lista-Fondo2");	
												}else{
													$error = "No hay data para este codigo padre";
												}
											}								
			                    	      
			                    ?>
								</table>
							</div>
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