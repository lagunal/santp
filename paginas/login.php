<?php
session_start();

//print_r ( $_SERVER );

include_once "../clases/injectionPHP.php";

include "../clases/presentacion.php";
include "../clases/clad.php";
include "../clases/directorioActivo.php";
include_once "../clases/cargarLog.php";

if(!isset($_SESSION["intentos"])) $_SESSION["intentos"] = 0;

//$_SESSION["intentos"] = 0;

//$_SESSION["id"] = "";
$error = "";

$pres = new presentacion();
$config = new config();
$clad = new clad($config->queryString);
$log = new Log();

if($_POST && $_POST['btnEntrar']!="")
{
	if( is_numeric( @$clad->consultarBloqueoUsuario($_POST['txtID']) ) )
	{
		if($clad->consultarBloqueoUsuario($_POST['txtID'])==0)
		{
			$da = new directorioActivo( $_POST["cmbUbicacion"] );
		
			if( $da->validarCuenta( $_POST['txtID'], $_POST['txtClave'] ) ) 
			{
				//session_regenerate_id();
				session_unset();
			
				//session_start();
		
				unset($_SESSION["intentos"]);
			
				$id = strtoupper(trim($_POST['txtID']));
				$numero = date("U");
				$nombreSesion = $id . "_" . $numero;
			
				$clad->crearSesion($id, $nombreSesion);
	
				$_SESSION["id"] = $id;
				$_SESSION["pass"] = $_POST['txtClave'];
				$_SESSION["ubicacion"] = $_POST["cmbUbicacion"];
				$_SESSION["nombre"] = $nombreSesion;
			
				header("location: principal.php");
	
				$log->guardarLog($log->logAccesos, "LOGIN", "OK");
			}else{
				$error = "Usuario y/o contraseña inválidas";

				$log->guardarLog($log->logAccesos, "LOGIN", $_POST['txtID'] . " NO");
			}
		}else{
			$error = "Usuario bloqueado";
		
			$log->guardarLog($log->logAccesos, "LOGIN", $_POST['txtID'] . " NO");
		}
	} else {
		$error = "Problemas de conexión con la base de datos, intente luego";
	}
	
	if($error!=""){
		if( $_SESSION["intentos"]>=5){
			$clad->bloquearUsuario($_POST['txtID'], 1);
?>


<html>
<head>
<link rel="shortcut icon" href="../favicon.ico">
<link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/login-form.css" />
<link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/pdvsaStyle.css" rel="stylesheet">
<title><?php echo $config->nombreAplicacion; ?></title><td></td>
</head>
<body>
    <table height="100%" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    	<tr>
    		<td height="100%" width="100%">

		    	<table border="0" align="center" cellpadding="0" cellspacing="0">
		    		<tr>
		    			<td>
							<OBJECT HEIGHT="77">
								<PARAM NAME="MOVIE" VALUE="../imagenes/Banner700x70_SANTP.swf">
								<EMBED SRC="../imagenes/Banner700x70_SANTP.swf" WIDTH="705" HEIGHT="70"></EMBED>
							</OBJECT>
		    			</td>
		    		</tr>
		    		<tr>
						<td id="formulario" align="center">
			                <h3>Autenticación requerida</h3>
			                <form method="post" action="login.php" style="margin:0px">
			                    <table cellpadding="2" align="center" border="0">
			                        <tr>
			                        	<td colspan="2" height="80px" align="center" style="color:Red;">
			                        		Se alcanzó el número máximo de intentos.
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
</body>
</html>


<?php
			exit;
		}else{
			$_SESSION["intentos"]++;
		}
	}
}else{
	/*
	if(isset($_SESSION["token"]))
		CerrarSesion($_SESSION["token"]);
	*/
}
?>
<html>
<head>
<link rel="shortcut icon" href="../favicon.ico">
<link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/login-form.css" />
<link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" type="text/javascript" src="../js/injectionJS.js"></script>
<title><?php echo $config->nombreAplicacion; ?></title>
</head>
<body>
    <table height="100%" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    	<tr>
    		<td height="100%" width="100%">

		    	<table border="0" align="center" cellpadding="0" cellspacing="0">
		    		<tr>
		    			<td>
							<OBJECT HEIGHT="77">
								<PARAM NAME="MOVIE" VALUE="../imagenes/Banner700x70_SANTP.swf">
								<EMBED SRC="../imagenes/Banner700x70_SANTP.swf" WIDTH="705" HEIGHT="70"></EMBED>
							</OBJECT>
		    			</td>
		    		</tr>
		    		<tr>
						<td id="formulario" align="center">
			                <h3>»Autenticación requerida«</h3>
			                <form id="form1" method="post" action="login.php" style="margin:0px">
			                    <table cellpadding="2" align="center" border="0">
			                        <tr>
			                            <td>Usuario:</td>
			                            <td>
			                            	<input value="<?php if(isset($_POST['txtID'])) echo $_POST['txtID']; ?>" type="text" name="txtID" class="edit" maxlength="20">
			                            </td>
			                        </tr>
			                        <tr>
			                            <td>Contraseña:</td>
			                            <td>
			                                <input value="<?php if(isset($_POST['txtClave'])) echo $_POST['txtClave']; ?>" type="password" name="txtClave" class="edit" maxlength="20">
			                            </td>
			                        </tr>
			                        <tr>
			                            <td>Desde:</td>
			                            <td>
							<table>
								<TR>
									<TD width="5px">
									</TD>
									<TD>
										<select name="cmbUbicacion" id="cmbUbicacion" class="detalle" style="width:220px">
										<?php 
											if( isset( $_POST["cmbUbicacion"] ) ) {
												$sel = $_POST["cmbUbicacion"];
											}else{
												$sel = 1;
											}
							
											$datos = array(
													array( "nombre" => "PDVSA", "codigo" => 1 ),
													array( "nombre" => "Pequiven", "codigo" => 3 ),
													array( "nombre" => "Estados Unidos - Houston", "codigo" => 2 )
													);
											echo $pres->crearCombo($datos, "codigo", "nombre", $sel); 
										?>
										</select>
									</TD>
								</TR>
							</table>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td height="20px"></td>
			                        </tr>
			                        <tr>
			                        	<td></td>
			                            <td align="center" colspan="2">
			                     			<div class="Principio-Boton"></div>
			                     			<input name="btnEntrar" type="submit" value="Ingresar" class="Boton">
										    <div class="Final-Boton"></div>
			                            </td>
			                        </tr>
			                        <tr>
			                            <td height="20px"></td>
			                        </tr>
			                        <tr>
			                        	<td colspan="2" align="center" style="color:Red;">
											<?php
												echo $error;
											?>
			                        	</td>
			                        </tr>
			                    </table>
			                </form>
			                <table cellpadding="0" align="center" border="0" width="100%">
				                <tr>
			                    	<td colspan="2" align="right">
			                        	Si no conoce su usuario pulse
			                        	<a style="color: rgb(255, 0, 0);" href="http://activacion.pdvsa.com">aquí</a>&nbsp;&nbsp;
			                    	</td>
			                    </tr>
			                </table>
						</td>
		    		</tr>
		    	</table>
    		</td>
    	</tr>
    </table>
</body>
</html>
