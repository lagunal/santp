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
		 $encuesta->setTx_sugerencias($_POST['txObser']);
	   
	}
	   
	   	
	$objeto=new EncuestaBD();
	$vari=$objeto->InsertarEncuesta($encuesta);
	if ($vari!=false){
	  //echo "<script> alert(\"Se guardo satisfactoriamente\")</script>";
	  //echo "<script>history.back()</script>";
	  //echo "<script>window.location=\"../paginas/servicios.php\"</script>";	  
	  header("location:../paginas/servicios.php");
	}else{
//	  echo "<script> alert(\"Error al guardar la información\")</script>";
//	  echo "<script>location.href=\"../paginas/servicios.php\"</script>";
	  header("location:../paginas/error.php");
	}
?>