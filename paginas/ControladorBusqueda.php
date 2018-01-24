<?php
session_start();
//if ($_SESSION["usuarioValido"]!=1){header("location:../acceso.php");}
//include_once("Login.php");
include_once("../modelo/utilitarios/Utilitarios.php");
include_once("../modelo/clasesBD/includeBD.php");
include_once("../modelo/clases/includeClases.php");

$ti=$_GET["ids"];
$t=$_GET["lineas"];
$fal=0;
$j= split(",",$ti); 
$largo=sizeof($j);
$objeto=new SolicitudBD();
$r=1;
if ($largo==1){
  $i=$j[0];
   	    $vari=$objeto->EliminarSolicitud($i);
						
					   if ($vari!=false){
					      $fal=1;
					   }else{
					      $fal=0;
					   }
}elseif($largo>1){
 $i=0;
 while ($i<$largo){
  $cod= $j[$i];
  $fal=1;
  $vari=$objeto->EliminarSolicitud($cod);
   $i++;
 }

}
die('<note><to>'.$fal.'</to><ho>'.$t.'</ho></note>');					

?>