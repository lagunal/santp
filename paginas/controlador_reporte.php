<?php
session_start();
//if ($_SESSION["usuarioValido"]!=1){header("location:../acceso.php");}
include_once("Login.php");
include_once("../modelo/utilitarios/Utilitarios.php");
include_once("../modelo/clasesBD/includeBD.php");
include_once("../modelo/clases/includeClases.php");
if (isset($_GET['id'])) $sol= $_GET['id'];   
if (isset($_GET['usu'])) $usu= $_GET['usu'];



     $solicitud= array();
     $obj=new  solicitudbd();
	  $obj1=new  SolicitanteBD();
      $solicitud=$obj->consultarSolicitudes($sol); 
      $idUsuario=$solicitud[0]->getIdUsuario();
	  $usu=$obj1->consultarIdUsuario($usu);
	  $soli= new Solicitud();
		   $soli->setTx1($solicitud[0]->getTx1());
		   $soli->setTx2($solicitud[0]->getTx2());
		   $soli->setTx3($solicitud[0]->getTx3());
		   $soli->setTx4($solicitud[0]->getTx4());
		   $soli->setTx5($solicitud[0]->getTx5());
		   $soli->setTx6($solicitud[0]->getTx6());
		   $soli->setTx7($solicitud[0]->getTx7());
		   $soli->setTx8($solicitud[0]->getTx8());
		   $soli->setFecha($solicitud[0]->getFecha());
		   $soli->setTx_lugar($solicitud[0]->getTx_lugar());
		   $soli->setUnidad($solicitud[0]->getUnidad());  
		   $soli->setVerificado(1);  
		   $ret=$obj->modificar($_GET['id']);
		   
		   
	   $usuario= new Solicitante();
			 $usuario->setNombre($usu[0]->getNombre()); 
			  $usuario->setIndicador($usu[0]->getIndicador());  
			  $usuario->setIndicador_sup($usu[0]->getIndicador_sup());  
			  $usuario->setNombre_sup($usu[0]->getNombre_sup());  
			  $usuario->setCelular($usu[0]->getCelular());  
			  $usuario->setTelefono($usu[0]->getTelefono()); 
			  $usuario->setTelefono_sup($usu[0]->getTelefono_sup());  
			  $usuario->setCorreo($usu[0]->getCorreo());  
			  
			  
			  
			     
									$_SESSION["resultadoUsuario"]=serialize($usuario);
									$_SESSION["resultadoSolicitud"]=serialize($soli);		
									header("location:../paginas/Solicitud_tec.php");	
								  
								  
								
?>