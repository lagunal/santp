<?php
	session_start();
	include_once("../modelo/utilitarios/Utilitarios.php");
	include_once("../modelo/clasesBD/includeBD.php");
	include_once("../modelo/clases/includeClases.php");
	include_once "../clases/clad.php";

	$clad = new clad();
    if(isset($_SESSION["id"])) $rol = $clad->buscarRolUsuario($_SESSION["id"]);
	// si $rol = 3 el Usuario es administrador

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style type="text/css">
	         body{
	            margin:11px;
	            font-size:0.9em;
	         }
	         a{
	            color:#F00;
	         }
	         .clear{
	            clear:both;
	         }
		</style>
		<style type="text/css">
           .style1 {color: #FFFFFF}
		</style>
		
        <link href="../css/main-aplicacion.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../js/ajax.js"></script>
		<script type="text/javascript" language="javascript">
			function ver(idSoli,usu){
			    var imag= "../paginas/controlador_reporte.php?id="+idSoli+"&usu="+usu; 
				//window.parent.location.href=imag;
				window.open(imag);
			}
			
			function Enviar(valor){
				var cuentaChecked=0;

				if (valor == 'J') {
					var i=0;
				   
				     if(formu.multiple.checked){
				         cuentaChecked++;
				       }
					   
				       var t=formu.multiple.length;
				       
					   while(i < t){
				         if(formu.multiple[i].checked) {
				          cuentaChecked++;
				            
				         }
				         i++;
				       }
					   
				      return (cuentaChecked);
				 }
			}
		</script>
		
		<script type="text/javascript">
          //ajax = new sack();
          var ajaxObjects = new Array();
                  
          function Actualizar_todo(){
               var c=Enviar("J");
			   
               if (c>0){
                   if ((c==1)&&(formu.multiple.checked)){
                      
                      var codigos;
                      var filas="0";
                      e=formu.multiple.value;
                      codigos=e;
                      y=1;
                      filas=filas+","+y;
                      actualizar_servidor(filas,codigos);     
                                   
                   }else{
                       var codigos="0";
                       var filas="0";
                       for(var i=0;i<formu.multiple.length;i++) {
                       var y=0;
                         if(formu.multiple[i].checked){
                            var e=formu.multiple[i].value;
                            codigos=codigos+","+e;                                                                                                             
                            y=i+1;
                            filas=filas+","+y;
                        }
                      }
                      actualizar_servidor(filas,codigos); 
                  }
                
               }else{
                 window.alert("Por favor Seleccione al menos 1 solicitud para eliminar.");
              }
         }   
         
         function actualizar_servidor(filas,ids){
              indexThis = ajaxObjects.length;
              ajaxObjects[indexThis]=new sack(); 
              ajaxObjects[indexThis].requestFile ='../paginas/ControladorBusqueda.php?ids='+ids+'&lineas='+filas;
              ajaxObjects[indexThis].onCompletion = showContent;
              ajaxObjects[indexThis].runAJAX();         // Execute AJAX function    
         }         
         
          function showContent() {
           	if (window.ActiveXObject) {
               var doc=new ActiveXObject("Microsoft.XMLDOM");
               doc.async=false;
               doc.loadXML(ajaxObjects[indexThis].response);
          	}
            // code for Mozilla, Firefox, Opera, etc.
            else {
               var parser=new DOMParser();
                             
               var doc=parser.parseFromString(ajaxObjects[indexThis].response,"text/xml");
            }
			
            var x=doc.documentElement;
            var j=x.childNodes[0].childNodes[0].nodeValue;
            var l=x.childNodes[1].childNodes[0].nodeValue;
            var ja = new Array();
            ja = l.split(",");                  
            var nu=ja.length;
            n=1;
            var fa=false;
            while(n<nu){
              if (j==1){
                 if (fa==true){
                   fi=ja[n]-n+1;
                 }else{fi=ja[n];}
                  document.getElementById("ta").tBodies[0].deleteRow(fi);
                  fa=true;
                 
                                                                  
              }else{
                 alert("No se puede eliminar esta Solicitud");
              }
           n++; 
           }
         }
		</script>
    </head>

    <body>
        <form ACTION='' name='formu' >

	        <div style="display:none">
	            <input type="HIDDEN" name="listing" value="0">
	        </div>
	
	        <table border="1" border="0" cellspacing='0'id='ta'>
	            <tr bgcolor='#D6D6DD'>
		           <td class='Titulo' align="center" width="55px"><?php if ($rol == 3)
				                                                                {echo "Eliminar";
				                                                                 }else 
																				   echo "&nbsp";?></td>
		           <td class='Titulo' align="center" width="85px">Fecha</td>
		           <td class='Titulo' align="center" width="100px">Solicitante</td>
		           <td class='Titulo' align="center" width="70px">Extensión</td>
		           <td class='Titulo' align="center" width="80px">Documento Propuesto</td>
		           <td class='Titulo' align="center" width="55px">Reporte</td> 
		           <td class='Titulo' align="center" width="80px">Verificado</td>       
	             </tr>
	         
	      <?php
	        /*sentencia que busca las solicitudes por fecha*/
	             
	         $solicitud= array();
	         $obj=new  solicitudbd();
	          $obj1=new  SolicitanteBD();
	           if ( !isset($_SESSION["cate"]))
	                echo"<script>javascript:window.history.forward(1);</script>";
	            $solicitud= array();
	            $solicitud= unserialize($_SESSION["cate"]); 
	                
		           $i=0;
	           $num=0;
	            $i=sizeof($solicitud);
	            
	           if ($i==0){
	              echo "<script type='text/javascript'> alert('NO SE ENCONTRO INFORMACION EN LA BASE DE DATOS');</script>";
	           }else{
	             while($num<$i){
	               $idSoli=$solicitud[$num]->getIdSolicitud();
	               $fecha=$solicitud[$num]->getFecha();
	               $idUsuario=$solicitud[$num]->getIdUsuario();
	               $usu=$obj1->consultarIdUsuario($idUsuario);
	               $docu=$solicitud[$num]->getTx1();
	               $verifi=$obj->consultarSolicitudes($idSoli);
	
				   if(isset($verifi[0]))
		               $dato=$verifi[0]->getverificado();
                   if ($rol == 3) $checkbox ='<input type="checkbox" value='.$idSoli.' name="multiple">';
				       else{
				       	  $checkbox = "&nbsp";
				       }
	               $newline="<tr class='cont_bold' onMouseover=this.style.backgroundColor='#EEEEEE' onMouseout=this.style.backgroundColor=''>";
	               $newline.=" <td align=\"center\">" . $checkbox . "</td>";
	               $newline.=" <td align=\"center\" class='Detalle'>" .$fecha. "</td>";
	               $newline.=" <td align=\"center\" class='Detalle'>". $usu[0]->getIndicador()."</td>";
	               $newline.=" <td align=\"center\" class='Detalle'>".  $usu[0]->getTelefono()."</td>";
	               $newline.=" <td align=\"center\" id=\"idstatusx \" class='Detalle'>".$docu ."</td>";
	               $newline.="<td align=\"center\"><A style='cursor:pointer; border:1px #FFF' onclick='ver($idSoli,$idUsuario)'>ver</A></td>";
	               $newline.="<td align=\"center\"><input name='' type='checkbox' value='' id='$idSoli' disabled ";
	
	               if($dato==1)
				   	$newline.= "checked";
	               else
				   	$newline.= " ></td>";
	                  
	               $newline.="</tr>";
	               echo $newline;
	               $num++;
	            }
	          }  
	         
	         //echo"</script>";
	         $line="<td>&nbsp</td>";
	         
	         echo "</table>";
	         
	        ?>
<?php if ($rol == 3)
{?>		
	        <table border="0" align="center" cellpadding="0" cellspacing="0">
	            <tbody>
	            	<tr>
	            		<td height="20px"></td>
	            	</tr>
	                <tr>
	                    <td width="13" align="right"><img src="../imagenes/bt_esq_izq.gif" width="13" height="33"></td>

	                    <td width="67" align="middle" background="../imagenes/bt_bg.gif">
	                        <div style="cursor:pointer; border:1px #FFF ">
	                            <a class="Detalle" onclick="Actualizar_todo()">»ELIMINAR«</a>
	                        </div>
	                    </td>
	
	                    <td width="14" align="left"><img height="33" src="../imagenes/bt_esq_der.gif" width="13"></td>
	                </tr>
	            	<tr>
	            		<td height="20px"></td>
	            	</tr>
	            </tbody>
	        </table>
<?php }
?>
			
	        <?php
	        echo "<table align='center'>";
	        echo "<tr >";
	        echo "<td  align=\"center\" >";
	         if(isset($_GET["pagi"]))$pagina=$_SESSION["pagi"]=$_GET["pagi"];
	             else $pagina=$_SESSION["pagi"]; 
	             
	             
	             if(isset($_SESSION["totRegistro"]))$total_registros = $_SESSION["totRegistro"];
	             if(isset($_SESSION["totPagina"]))$total_paginas=$_SESSION["totPagina"];
	             if($total_registros > 1)
	            {
	                if($total_registros) {
	                
	                    if(($pagina - 1) > 0) {
	                        echo "<a class='Detalle' href='../paginas/controladorPaginacion.php?pagi='".($pagina-1)."'><<</a> ";
	                    }
	                    
	                    for ($i=1; $i<=$total_paginas; $i++){ 
	                        if ($pagina == $i) {
	                            echo "<b ><u><font class='Detalle'><strong>".$pagina."</strong></font></u></b> "; 
	                        } else {
	                            echo "<a class='Detalle' href='../paginas/controladorPaginacion.php?pagi=$i'>$i</a> "; 
	                        }   
	                    }
	                  
	                    if(($pagina + 1)<=$total_paginas) {
	                        echo " <a class='Detalle' href='../paginas/controladorPaginacion.php?pagi='.($pagina+1)></a> ";
	                    }
	                
	                }
	            }
	            echo "</td>";
	          echo "</tr>";
	         echo "</table>"; 
	        ?>
		</form>
    </body>
</html>