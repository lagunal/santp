<?php
    include "../controles/header.php";

    include_once "../clases/cargarLog.php";
    $log = new Log();

	//INICIO AUTORIZAR PÁGINA ***************
	autorizarPagina("REPORTES");
	//FIN AUTORIZAR PÁGINA ***************
    
    	include_once("../modelo/clases/includeClases.php");
	include_once("../modelo/clasesBD/includeBD.php");
	$acceso_datos=new EncuestaBD();

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
		<script language="javascript" type="text/javascript"  src="../js/imprimir.js"></script>
		<script language="javascript" type="text/javascript"  src="../js/calcular.js"></script>
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
	                    $titulo = "<a href='principal.php' class='link_blanco'>Inicio</a>";
	                    
	                    echo $pres->crearVentanaInicio($titulo);
	                    include "../controles/menu.php";
	                    echo $pres->crearVentanaIntermedia();
	                ?>
                    <form id="datos" style="margin:0px" method="post">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td height="10px"></td>
                                <td style="display:none"><input type="hidden" name="accionUsuario" id="accionUsuario" /></td>
                            </tr>
                            <tr>
                                <td valign="top">

<span class="Titulo" >
	REPORTE DE ENCUESTA DE EVALUACIÓN DE SANTP
</span>
<br>
<br>
                                </td>
                            </tr>

                            <tr>
                                <td valign="top">

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
		<td colspan="5" class="Titulo">
			<?php 
				$error = false;
				$f1 = $pres->convertirFechaDA( $_POST["txtFechaInicio"] );
				$f2 = $pres->convertirFechaDA( $_POST["txtFechaFin"] );
				
				if( ( $f1 != "" ) && ( $f2 != "" ) )
				{
					$f1 = strtotime( $f1 );
					$f2 = strtotime( $f2 );

					if( ( $f1 <= $f2 ) ) 
					{
						$data=$acceso_datos->consultarEncuesta( $_POST["txtFechaInicio"], $_POST["txtFechaFin"] );
						//$t=$acceso_datos->CantidadRegistro(  );
						$t=sizeof($data);
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
<span class="Detalle" >
<?php
  echo "NÚMERO DE ENCUESTADOS:"."     ". $t. " ====> 100%";
  ?>	</span><br>
	
                                </td>
                            </tr>
			    <tr>
				<td height="20px">
                                </td>
                            </tr>
				
                            <tr>
                                <td valign="top">

<table border="1" bordercolor="#000066" id="table2">
  <tr bordercolor="#FFFFFF">
    <th width="77" height="39" scope="col"><p align="center" class="Titulo"> Respuestas </p></th>
    <th width="69" height="39" scope="col"><p align="center" class="Titulo"> Pregunta 1 </p></th>
    <th width="69" height="39" scope="col"><p align="center" class="Titulo">Pregunta 2 </p></th>
    <th width="69" scope="col"><p align="center" class="Titulo"> Pregunta 3 </p></th>
    <th width="68" scope="col"> <div align="justify" class="Titulo">
      <div align="center"><span class="Titulo"> Pregunta 4 </span></div>
    </div></th>
    <th width="66" scope="col"> <div align="justify" class="Estilo5">
      <div align="center"><span class="Titulo"> Pregunta 5 </span></div>
    </div></th>
    <th width="67" scope="col"><p align="center" class="Titulo"> Pregunta 6 </p></th>
    <th width="67" scope="col"><p align="center" class="Titulo"> Pregunta 7 </p></th>
    <th width="66" scope="col"><span class="Titulo"> Pregunta 8 </span></th>
  </tr>
   
  <?php 
	  $cont_no1=0;$cont_no2=0;$cont_no3=0;$cont_no4=0;$cont_no5=0;$cont_no6=0;$cont_no7=0;$cont_no8=0;
	  $cont_si1=0;$cont_si2=0;$cont_si3=0;$cont_si4=0;$cont_si5=0;$cont_si6=0;$cont_si7=0;$cont_si8=0;
		for($i=0;$i<$t;$i++)
			{	
			   $r1=$data[$i]->getTx1();
			   if($r1=="si"){
			     $cont_si1++;
			   
			   }else{
			    $cont_no1++;
			   
			   }
			   $r2=$data[$i]->getTx2();
			   if($r2=="si"){
			     $cont_si2++;
			   
			   }else{
			    $cont_no2++;
			   
			   }
			   $r3=$data[$i]->getTx3();
			   if($r3=="si"){
			     $cont_si3++;
			   
			   }else{
			    $cont_no3++;
			   
			   }
			   $r4=$data[$i]->getTx4();
			   if($r4=="si"){
			     $cont_si4++;
			   
			   }else{
			    $cont_no4++;
			   
			   }
			   $r5=$data[$i]->getTx5();
			   if($r5=="si"){
			     $cont_si5++;
			   
			   }else{
			    $cont_no5++;
			   
			   }
			   $r6=$data[$i]->getTx6();
			   if($r6=="si"){
			     $cont_si6++;
			   
			   }else{
			    $cont_no6++;
			   
			   }
			   $r7=$data[$i]->getTx7();
			   if($r7=="si"){
			     $cont_si7++;
			   
			   }else{
			    $cont_no7++;
			   
			   }
			   $r8=$data[$i]->getTx8();
			   if($r8=="si"){
			     $cont_si8++;
			   
			   }else{
			    $cont_no8++;
			   
			   }
         }  
  ?>

<tr bgcolor="#eeeeee">
    <th height="40" class="Detalle" scope="col">SI&nbsp;</th>
    <th class="Detalle" scope="col"></th>
    <th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
    <th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
	<th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
    <th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
    <th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
	<th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
	<th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
  </tr>
  <tr bgcolor="#ffffff">
    <th height="40" class="Detalle" scope="col">NO&nbsp;</th>
    <th class="Detalle" scope="col"></th>
    <th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
    <th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
	<th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
    <th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
    <th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
	<th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
	<th class="Detalle" scope="col"><div align="center">&nbsp;</div></th>
  </tr>
  <?php 

			echo"<script type=text/javascript>";
			 $newline2="document.getElementById('table2').tBodies[0].rows[2].cells[1].innerHTML = '" . " (" . number_format($cont_no1/$i*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[1].cells[1].innerHTML = '" . " (" . number_format($cont_si1/($i)*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[2].cells[2].innerHTML = '" . " (" . number_format($cont_no2/$i*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[1].cells[2].innerHTML = '" . " (" . number_format($cont_si2/($i)*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[2].cells[3].innerHTML = '" . " (" . number_format($cont_no3/$i*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[1].cells[3].innerHTML = '" . " (" . number_format($cont_si3/($i)*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[2].cells[4].innerHTML = '" . " (" . number_format($cont_no4/$i*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[1].cells[4].innerHTML = '" . " (" . number_format($cont_si4/($i)*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[2].cells[5].innerHTML = '" . " (" . number_format($cont_no5/$i*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[1].cells[5].innerHTML = '" . " (" . number_format($cont_si5/($i)*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[2].cells[6].innerHTML = '" . " (" . number_format($cont_no6/$i*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[1].cells[6].innerHTML = '" . " (" . number_format($cont_si6/($i)*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[2].cells[7].innerHTML = '" . " (" . number_format($cont_no7/$i*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[1].cells[7].innerHTML = '" . " (" . number_format($cont_si7/($i)*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[2].cells[8].innerHTML = '" . " (" . number_format($cont_no8/$i*100,1) . "%)';";
			 $newline2.="document.getElementById('table2').tBodies[0].rows[1].cells[8].innerHTML = '" . " (" . number_format($cont_si8/($i)*100,1) . "%)';";
			 echo $newline2;
			 echo"</script>";
 	  ?>
</table>
<br>
<br>
<table width="500" align="left">
	<tr>
		<td width="50%">
	      <div align="right">
	        <input type="button" name="regresar" value="<< Atras" onClick="window.history.back();">
          </div></td>
		<td width="54%">
          <div align="left">
            <input type="button" name="imprimir" value="Imprimir" onClick="window.print();">
          </div></td></tr>
</table>

                                	
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
