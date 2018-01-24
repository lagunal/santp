<?php
	session_start();
//if ($_SESSION["usuarioValido"]!=1){header("location:../acceso.php");}
//include_once("Login.php");
include_once("../modelo/utilitarios/Utilitarios.php");
include_once("../modelo/clasesBD/includeBD.php");
include_once("../modelo/clases/includeClases.php");
     
	 
	 $va=$_GET['fecha'];
	 $ani=$_GET['uno'];
	 $mes=$_GET['dos'];
	 $dia=$_GET['tres'];
	 $cambio=0;
	 if (($ani==0)&&($mes==0)){
	   $va="%".$va;
	    $cambio=1;
	 }elseif(($ani==0)&&($dia==0)){
	     $va="%".$va."%";
		  $cambio=1;
	 }elseif(($ani!=0)&&($mes!=0)&&($dia==0)){
	    $va=$va."%";
		 $cambio=1;
	 }elseif(($ani==0)&&($mes!=0)&&($dia!=0)){
	     $va="%".$va;
	    $cambio=1;
	 } elseif(($ani!=0)&&($mes==0)&&($dia==0)){
	     $va=$va."%";
		 
	    $cambio=1;
	 }
	 
     $solicitud= array();
     $obj=new  solicitudbd();
	  $obj1=new  SolicitanteBD();
    
     
		if (isset($_GET["pagi"]))
		{
				$cate	=	Array();			
				$registros=20;				
				if(isset($_GET["pagi"]))	$pagina=$_GET["pagi"];
				else					$pagina=0;
				
				if (!$pagina) {
					$inicio = 0;
					$pagina = 1;
				}else{
					$inicio = ($pagina - 1) * $registros; 
				}
				
				$total=$obj->CantidadRegistro($va);
				
				$total_paginas = ceil($total / $registros); 
				
				$_SESSION["totRegistro"]=$total;		
				$_SESSION["totPagina"]=$total_paginas;					
				$cate=$obj->consultarCatePaginar($va,$registros,$inicio);
			
				$_SESSION["cate"]		=	serialize ($cate);
				
				//-------------------------------------------------------------------------------------
				//direcciona la pagina 
				$paginaDestino="../paginas/datos_busqueda.php?pagi=".$pagina."&tipo=".$va;
				$util=new Utilitarios();
				$util->direccionarPagina($paginaDestino);
		}
?>