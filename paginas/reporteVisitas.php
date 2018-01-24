<?php
    include "../controles/header.php";

    include_once "../clases/cargarLog.php";
    $log = new Log();

	//INICIO AUTORIZAR PÁGINA ***************
	autorizarPagina("REPORTES");
	//FIN AUTORIZAR PÁGINA ***************
?>

<html xmlns="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" xml:lang="es" lang="es">
    <head>
        <meta name="generator" content="HTML Tidy, see www.w3.org" />

        <title><?php echo $config->nombreAplicacion; ?></title>
        <link rel="shortcut icon" href="../favicon.ico" />
        <link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
        <link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/tab-view.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script language="JavaScript" type="text/javascript" src="../js/injectionJS.js"></script>
	<script language="JavaScript" type="text/javascript" src="../js/calendario.js"></script>
	</head>

    <body>
        <table width="760px" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                	<?php echo $pres->crearEncabezado($config->nombreAplicacion); ?></td>
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
                    <form id="datos" style="margin:0px" method="post">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td height="10px"></td>
                                <td style="display:none"><input type="hidden" name="accionUsuario" id="accionUsuario" /> </td>
                            </tr>
                            <tr>
                                <td valign="top">

<span class="Titulo" >
	REPORTE DE VISITAS DE SANTP
</span>
<br>
<br>

<table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
	<tr>
		<td class="Detalle">
			Fecha inicio:
		</td>
		<td>
			<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td>
					<input name="txtFechaInicio" type="text" maxlength="10" class="Detalle" size="12" value="<?php echo $_POST['txtFechaInicio']; ?>" >
				</td>
				<td>
					<a href="javascript:abrirCalendario('txtFechaInicio')"><img src="../imagenes/calendario.gif" border="0"></a>
				</td>
			</tr>
			</table>
		</td>
		<td class="Detalle">
			Fecha fin:
		</td>
		<td>
			<table cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td>
					<input name="txtFechaFin" type="text" maxlength="10" class="Detalle" size="12" value="<?php echo $_POST['txtFechaFin']; ?>" >
				</td>
				<td>
					<a href="javascript:abrirCalendario('txtFechaFin')"><img src="../imagenes/calendario.gif" border="0"></a>
				</td>
			</tr>
			</table>
		</td>
		<td>
		        <input type="submit" name="Submit" value="Enviar" style="width:80px">
		</td>
	</tr>
	<tr>
		<td height="40px">
		</td>
	</tr>
	<tr>
		<td colspan="5" class="Titulo">
			Número de visitas para el período: 
			<?php 
				$error = false;
				$f1 = $pres->convertirFechaDA( $_POST["txtFechaInicio"] );
				$f2 = $pres->convertirFechaDA( $_POST["txtFechaFin"] );
				
				if( ( $f1 != "" ) && ( $f2 != "" ) )
				{
					$f1 = strtotime( $f1 );
					$f2 = strtotime( $f2 );

					if( ( $f1 <= $f2 ) ) {
						echo $clad->consultarVisitasPeriodo( $_POST["txtFechaInicio"], $_POST["txtFechaFin"] );	
					} else {
						$error = true;
					}
				} else {
					$error = true;
				}
				
				if( $error ) echo "<br><br>El rango de fechas no es correcto";
			?>
		</td>
	</tr>
</table>

<br>
<br>
                                	
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php echo $pres->crearVentanaFin(); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $pres->crearPie(); ?></td>
            </tr>
        </table>
    </body>
</html>
