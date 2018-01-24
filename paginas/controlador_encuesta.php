<html xmlns="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" xml:lang="es" lang="es">
    <head>
        <meta name="generator" content="HTML Tidy, see www.w3.org" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script language="JavaScript">
			function regresar(resultado){
				form = document.getElementById("forma1");
				if (resultado == 1) {
					alert("Se guardo satisfactoriamente");
				}else{
					alert("Error al guardar la información. Intente más tarde.");
					form.action="../paginas/servicios.php";
				}
				form.submit();
			}		
		</script>
	</head>
<body>
<form id="forma1" method=post action="../paginas/principal.php" >
<?php
	session_start();

	
	//if ($_SESSION["usuarioValido"]!=1){header("location:../acceso.php");}
	//include_once("Login.php");
	include_once("../modelo/utilitarios/Utilitarios.php");
	include_once("../modelo/clasesBD/includeBD.php");
	include_once("../modelo/clases/includeClases.php");
	 
	 $encuesta=new Encuesta();
	
	  if (isset($_POST['p1'])) $encuesta->setTx1($_POST['p1']);
	  if (isset($_POST['p2'])) $encuesta->setTx2($_POST['p2']);
	  if (isset($_POST['p3'])) $encuesta->setTx3($_POST['p3']);
	  if (isset($_POST['p4'])) $encuesta->setTx4($_POST['p4']);
	  if (isset($_POST['p5'])) $encuesta->setTx5($_POST['p5']);
	  if (isset($_POST['p6'])) $encuesta->setTx6($_POST['p6']);
	  if (isset($_POST['p7'])) $encuesta->setTx7($_POST['p7']);
	  if (isset($_POST['p8'])) $encuesta->setTx8($_POST['p8']);
	  if (isset($_POST['p9'])) $encuesta->setTx9($_POST['p9']);
		if (isset($_POST['txObser'])){ 
		 $encuesta->setTx_sugerencias(htmlspecialchars($_GET['txObser'], ENT_QUOTES));
	   
	}
	   
	   	
	$objeto=new EncuestaBD();
	$vari=$objeto->InsertarEncuesta($encuesta);
	if ($vari!=false){
	  echo "<script>regresar(1);</script>";
	}else{
	  echo "<script>regresar(2);</script>";
	}
	
?>
</form>
</body>
</html>