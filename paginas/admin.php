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
	autorizarPagina("USUARIOS");
	//FIN AUTORIZAR PÁGINA ***************


	if(isset($_POST["btnGuardar"]) && $_POST["btnGuardar"]!=""){
		$datos = $da->obtenerUsuarioID( $_POST["txtID"], $_SESSION["id"], $_SESSION["pass"] );
		
		if(isset($datos[0]) && $datos[0]!=""){
			$clad->actualizarCorreo( $_POST["txtID"] . "@pdvsa.com" );
		}else{
		    	$error = "El id no es correcto";
		}
	}
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
		function cargarValor(id, rol){
			txtId = document.getElementById("txtID");
			cmbRol = document.getElementById("cmbRoles");
			
			txtId.value = id;
			cmbRol.value = rol;
		}
		
		function eliminarRol(id){
			eliminarCampo('txtAccion', 'e', 'form1', 'txtCodigo', id);
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
							<input type="hidden" id="txtCodigo" name="txtCodigo" value="<?php if(isset($_POST["txtCodigo"])) echo $_POST["txtCodigo"]; ?>"/>
							<input type="hidden" id="txtValores" name="txtValores" value=""/>
						</td>
					</tr>
					<tr>
						<td>
      						<?php echo $pres->crearSeparador("Usuarios"); ?>
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
		                            <td class="Detalle" width="70px">
		                            	ID:
		                            </td>
		                            <td width="250px">
		                            	<input id="txtID" name="txtID" type="text" value="" size="25" maxlength="25"/>
		                            </td>
		                        </tr>
		                        <tr>
		                        	<td height="10px"></td>
		                        </tr>
		                        <tr>
		                        	<td colspan="3">
		                        	</td>
		                        	<td>
							<?php echo $pres->crearBoton("btnGuardar", "Guardar", "submit", ""); ?>
						</td>
		                        </tr>
		                        <tr>
		                            <td height="6px">
		                            </td>
		                        </tr>
		                        <tr>
		                            <td height="6px" class="Detalle">
						Correo actual: <?php echo $clad->obtenerCorreo(); ?>
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
