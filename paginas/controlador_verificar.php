<?php
session_start();

//if ($_SESSION["usuarioValido"]!=1){header("location:../acceso.php");}
//include_once("Login.php");
//include_once("../modelo/utilitarios/Utilitarios.php");
include_once("../clases/directorioActivo.php");
include_once("../modelo/clasesBD/includeBD.php");
include_once("../modelo/clases/includeClases.php");
include_once("../clases/enviarCorreo.php");
include_once("../clases/clad.php");

	$illegalPOST = 'script,http,<,>,%3c,%3e,%,#,?,#,;,=,$,\',\",&';
	$illegalPOSTArray = explode(',', $illegalPOST);
	
 	$solicitud=new Solicitud();
  	if(isset($_POST['texta4'])) $solicitud->setTx1(str_replace($illegalPOSTArray, "", $_POST['texta4']));

	if(isset($_POST["documento"])){
   		if ($_POST["documento"]=="Existente") $solicitud->setTx2($_POST["text2"]);
   		else $solicitud->setTx2($_POST["documento"]);
	}

	if(isset($_POST["prioridad"])) $solicitud->setTx3($_POST["prioridad"]);
  
  	if(isset($_POST["manual"])){
	   	if ($_POST["manual"]=="otro") $solicitud->setTx4($_POST["text4"]);
		else $solicitud->setTx4($_POST["manual"]);
  	}

   
  	if(isset($_POST['arre5'])){
	   	$pr=",";
	   	$pr5="";

		foreach($_POST['arre5'] as $val){
			if ($val=='otro'){
				$pr5=$pr5.$pr.'otro';
				$pr5=$pr5.$pr.str_replace($illegalPOSTArray, "", $_POST['text5']);
				//$pr5=$pr5.$pr.$_POST['text5'];
			}else{
				$pr5=$pr5.$pr.$val;
			}
		}
		
	  	$solicitud->setTx5($pr5);
   	}
   
	if (isset($_POST['arre6'])){ 
	   	$pr=",";
	   	$pr6="";
		
		foreach($_POST['arre6'] as $val){
			if ($val=='otro'){
				$pr6=$pr6.$pr.'otro';
				$pr6=$pr6.$pr.str_replace($illegalPOSTArray, "", $_POST['text6']);
				//$pr6=$pr6.$pr.$_POST['text6'];
			}else{
				$pr6=$pr6.$pr.$val;
			}
		}
		
		$solicitud->setTx6($pr6);
	}
 
	if (isset($_POST['arre7'])){ 
		$pr=",";
	   	$pr7="";
		
		foreach($_POST['arre7'] as $val){
			if ($val=='otro'){
				$pr7=$pr7.$pr.'otro';
				$pr7=$pr7.$pr.str_replace($illegalPOSTArray, "", $_POST['text7']);
				//$pr7=$pr7.$pr.$_POST['text7'];
			}else{
				$pr7=$pr7.$pr.$val;
			}
		 }
		 
		$solicitud->setTx7($pr7);
	}
 
   	if (isset($_POST['txObser2'])) $solicitud->setTx8(str_replace($illegalPOSTArray, "", $_POST['txObser2']));
   
	$fechaOrd = substr( $_POST['fecha'], 3, 2 ) . "/" . substr( $_POST['fecha'], 0, 2 ) . "/" . substr( $_POST['fecha'], 6, 4 );

   	if (isset($_POST['fecha'])) $solicitud->setFecha( htmlspecialchars( $fechaOrd, ENT_QUOTES) );
   
   	if (isset($_POST['lugar'])) $solicitud->setTx_lugar(str_replace($illegalPOSTArray, "", $_POST['lugar']));
  
    if (isset($_POST['filial'])) $solicitud->setUnidad(str_replace($illegalPOSTArray, "", $_POST['filial']));
	
	$solicitud->setVerificado(0);
  
   	$_SESSION["resultadoSolicitud"]=serialize($solicitud);	

	if(isset($_POST["accionUsuario"])) $_SESSION['accionUsuario']=$_POST["accionUsuario"];

 	$Usuario=new Solicitante(); 
	
	if(isset($_POST['nombre'])) $Usuario->setNombre(str_replace($illegalPOSTArray, "", $_POST['nombre']));
	
	if(isset($_POST['indicador'])) $Usuario->setIndicador(str_replace($illegalPOSTArray, "", $_POST['indicador']));

	if(isset($_POST['telefono'])) $Usuario->setTelefono(str_replace($illegalPOSTArray, "", $_POST['telefono']));
	
	if(isset($_POST['celular'])) $Usuario->setCelular(str_replace($illegalPOSTArray, "", $_POST['celular']));
	
	if(isset($_POST['nombre2'])) $Usuario->setNombre_sup(str_replace($illegalPOSTArray, "", $_POST['nombre2']));
   
   	if(isset($_POST['indicador2'])) $Usuario->setIndicador_sup(str_replace($illegalPOSTArray, "", $_POST['indicador2']));

   	if(isset($_POST['telefono2'])) $Usuario->setTelefono_sup(str_replace($illegalPOSTArray, "", $_POST['telefono2']));
	
	switch ($_SESSION['accionUsuario']){
   		case 'verificar':
   			$idi = "";
   			$Res=0;
   			$R = array();
   			$nombreSupervisor = "";
			$extensionSupervisor = "";
			
   			if(isset($_POST["indicador"])) $idi=$_POST["indicador"];

			if($idi!=""){
			   $da = new directorioActivo( $_SESSION["ubicacion"] );
			   $R = $da->obtenerUsuarioID( $idi, $_SESSION["id"], $_SESSION["pass"] );
			   
			   $Res=sizeof($R);
 			}

			if($Res>1){
		   		$_SESSION['vane']=$R[0]["displayname"][0];

		   		$usuario=new Solicitante();

				$usuario->setIndicador(strtolower($_POST["indicador"]));
				$usuario->setNombre($R[0]["displayname"][0]);
				$usuario->setTelefono($R[0]["ipphone"][0]);
				$usuario->setCorreo(strtolower($_POST["indicador"]).'@pdvsa.com');

				$usuario->setCelular($R[0]["mobile"][0]);
				$usuario->setSupervisor($R[0]["pdvsacom-ad-functionalsupervisor"][0]);

				if(isset($R[0]["pdvsacom-ad-functionalsupervisor"][0]) && $R[0]["pdvsacom-ad-functionalsupervisor"][0]!=""){
					$res = $da->obtenerUsuarioID( $R[0]["pdvsacom-ad-functionalsupervisor"][0], $_SESSION["id"], $_SESSION["pass"] );
					$nombreSupervisor = $res[0]["displayname"][0];
					$extensionSupervisor = $res[0]["ipphone"][0];
				}
				
				$usuario->setNombreSupervisor($nombreSupervisor);
				$usuario->setTelefonoSupervisor($extensionSupervisor);

				$_SESSION["resultadoVerificar"]=serialize($usuario);	

				header("location:formatoSolicitud.php?VAL=1");
			}else{
			   	$_SESSION['vane']="NO EXISTE EN DIRECTORIO ACTIVO";
			   	echo "<script> alert(\"NO EXISTE EN DIRECTORIO ACTIVO\")</script>";
			   	echo "<script>location.href=\"formatoSolicitud.php?VAL=2\"</script>";
			}
    	break;
    	
   		case 'guardar':
			$idi = "";
   			$Res=0;
   			$R = array();
			
   			if(isset($_POST["indicador"])) $idi=$_POST["indicador"];

			if($idi!=""){
			   $da = new directorioActivo( $_SESSION["ubicacion"] );
			   $R = $da->obtenerUsuarioID( $idi, $_SESSION["id"], $_SESSION["pass"] );
			   
			   $Res=sizeof($R);
 			}
			if($Res>1){
   				$objeto=new SolicitudBD();
   				$solicitantebd=new SolicitanteBD();
   				$ids=$solicitantebd->consultarXIndicador($_POST['indicador']);
   			
   				if($ids==NULL) $solicitantebd->InsertarUsuario($Usuario);

   				$id=$solicitantebd->consultarXIndicador($_POST['indicador']);
    				$vari=$objeto->InsertarDatos($solicitud,$id[0]->getIdUsuario());
	
   				if ($vari!=false)
				{	
					$clad = new clad();

					$retCorreo = enviarCorreo( $_POST['indicador'], $_POST['nombre'], $clad->obtenerCorreo() );
					
					print_r( $retCorreo );

	     				echo "<script> alert(\" Se guardo satisfactoriamente\")</script>";
   				}
				else
				{
      					echo "<script> alert(\"Error al guardar la información\")</script>";
   				}

				echo "<script>location.href=\"formatoSolicitud.php\"</script>";
			}
		break;
	}
?>
