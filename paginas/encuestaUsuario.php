<?php
    include "../controles/header.php";

    include_once "../clases/cargarLog.php";
    $log = new Log();
    
    include_once "../clases/clad.php";
    $clad = new clad();
    
    include_once("../modelo/clases/includeClases.php");
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
		<script language="JavaScript" type="text/javascript" src="../js/ajax.js"></script>
		<script language="JavaScript" type="text/javascript" src="../js/tab-view.js"></script>

		<script LANGUAGE=javascript> 
			function verif(){
				vacio1=0;
				vacio22=0;
				vacio33=0;
				vacio44=0;
				vacio55=0;
				vacio66=0;
				vacio77=0;
				vacio88=0;
				vacio99=0;
				
				vacio=valida1();
				if ((!vacio)&&(vacio1==0)){	   	
						alert("Seleccione una respuesta de la pregunta n°1");
						vacio1=1;
						//alert(selectColeccion);
					}
				vacio2=valida2();
				if ((!vacio2)&&(vacio22==0)&&(vacio1==0)){	   	
						alert("Seleccione una respuesta de la pregunta n°2");
						vacio22=1;
						//alert(selectColeccion);
					}  
				vacio3=valida3();
				if ((!vacio3)&&(vacio33==0)&&(vacio22==0)&&(vacio1==0)){	   	
						alert("Seleccione una respuesta de la pregunta n°3");
						vacio33=1;
						//alert(selectColeccion);
					} 
				vacio4=valida4();
				if ((!vacio4)&&(vacio44==0)&&(vacio22==0)&&(vacio33==0)&&(vacio1==0)){	   	
						alert("Seleccione una respuesta de la pregunta n°4");
						vacio44=1;
						//alert(selectColeccion);
					}
				
				vacio5=valida5();
				if ((!vacio5)&&(vacio55==0)&&(vacio44==0)&&(vacio22==0)&&(vacio33==0)&&(vacio1==0)){	   	
						alert("Seleccione una respuesta de la pregunta n°5");
						vacio55=1;
						//alert(selectColeccion);
					} 
				
				vacio6=valida6();
				if ((!vacio6)&&(vacio66==0)&&(vacio55==0)&&(vacio44==0)&&(vacio22==0)&&(vacio33==0)&&(vacio1==0)){	   	
						alert("Seleccione una respuesta de la pregunta n°6");
						vacio66=1;
						//alert(selectColeccion);
					} 
				vacio7=valida7();
				if ((!vacio7)&&(vacio77==0)&&(vacio66==0)&&(vacio55==0)&&(vacio44==0)&&(vacio22==0)&&(vacio33==0)&&(vacio1==0)){	   	
						alert("Seleccione una respuesta de la pregunta n°7");
						vacio77=1;
						//alert(selectColeccion);
					} 
				vacio8=valida8();
				if ((!vacio8)&&(vacio88==0)&&(vacio77==0)&&(vacio66==0)&&(vacio55==0)&&(vacio44==0)&&(vacio22==0)&&(vacio33==0)&&(vacio1==0)){	   	
						alert("Seleccione una respuesta de la pregunta n°8");
						vacio88=1;
						//alert(selectColeccion);
					} 
				
				 
				if(document.encu.txObser==""){
				   alert("Seleccione una respuesta de la pregunta n°9");
						vacio99=1;
						//alert(selectColeccion);
				}
				if((vacio1==0)&&(vacio22==0)&&(vacio33==0)&&(vacio44==0)&&(vacio55==0)&&(vacio66==0)&&(vacio77==0)&&(vacio88==0)){
				document.encu.submit();
				
				}else{
				  return false;
				}
			}

			function valida1(){
		  	   var i=0;
		       var t=document.encu.p1.length;
			   while(i < t){
		         if(document.encu.p1[i].checked){
				     return true;
					}
		          i++;
		       }
			   
		      return (false);   
		    }
		   
		 function valida6(){
		  var i=0;
		       var t=document.encu.p6.length;
			   while(i < t){
		         if(document.encu.p6[i].checked){
				     return true;
					}
		          i++;
		       }
			   
		      return (false);   
		 }

		 function valida7(){
		     var i=0;
		       var t=document.encu.p7.length;
			   while(i < t){
		         if(document.encu.p7[i].checked){
				     return true;
					}
		          i++;
		       }
			   
		      return (false);   
		   }
		   
		    function valida8(){
		      var i=0;
		       var t=document.encu.p8.length;
			   while(i < t){
		         if(document.encu.p8[i].checked){
				     return true;
					}
		          i++;
		       }
			   
		      return (false);   
		   }
		   
		  function valida9(){
		     var i=0;
		       var t=document.encu.p9.length;
			   while(i < t){
		         if(document.encu.p9[i].checked){
				     return true;
					}
		          i++;
		       }
			   
		      return (false);   
		   }
		    
		   
		 function valida2(){
		     var i=0;
		       var t=document.encu.p2.length;
			   while(i < t){
		         if(document.encu.p2[i].checked){
				     return true;
					}
		          i++;
		       }
	   
	      return (false);   
	   }
	   
	   function valida3(){
		  var i=0;
	       var t=document.encu.p3.length;
		   while(i < t){
	         if(document.encu.p3[i].checked){
			     return true;
				}
	          i++;
	       }
		   
	      return (false);   
	   }
	   
	   function valida4(){
		  var i=0;
	       var t=document.encu.p4.length;
		   while(i < t){
	         if(document.encu.p4[i].checked){
			     return true;
				}
	          i++;
	       }
		   
	      return (false);   
	   }
	   
	   function valida5(){
	  		var i=0;
	       var t=document.encu.p5.length;
		   while(i < t){
	         if(document.encu.p5[i].checked){
			     return true;
				}
	          i++;
	       }
		   
	      return (false);   
	   }
	
		function enviar(accion){
			validarBusqueda=1
			
			if (validarBusqueda==1){
				 for (i=1; i<=7; i++){
				     document.datosSolicitante.elements[i].disabled = '';
			                   
			     }
				  document.datosSolicitante.elements[0].disabled = 'disabled';
				  if (accion=='verificar'){
						document.datosSolicitud.verificar.disabled=true;	
						document.datosSolicitud.verificar.value="Verificando...";
					
					document.body.style.cursor="wait";
					document.datosSolicitud.accionUsuario.value=accion;
					document.datosSolicitud.submit();
				}
			}
		}
	
		function cambiar(cam){
		
			if (cam=='1'){
			  llave = 1;
			}else{
			  llave =2;
			}
			document.getElementById("pagina").value=llave;
			
			  return llave;
		}
		
		function buscar(cam){
		  var r=document.getElementById("pagina").value;  
		  if (r==0){
		     createNewTab('dhtmlgoodies_tabView1','Datos del solicitante','','externalfile.php',false);
		  }else{
		    alert("Llene todos los datos de la pestaña Datos del Solicitante y presione GUARDAR");
		  }
		  return r;
		}

			function max(txarea) { 
			    total = 100; 
			    tam = txarea.value.length; 
			    str=""; 
			    str=str+tam; 
			    Digitado.innerHTML = str; 
			    Restante.innerHTML = total - str; 
			
			    if (tam > total){ 
			        aux = txarea.value; 
			        txarea.value = aux.substring(0,total); 
			        Digitado.innerHTML = total 
			        Restante.innerHTML = 0 
			    } 
			} 
			
			function max2(txarea){ 
			    total = 100; 
			    tam = txarea.value.length; 
			    str=""; 
			    str=str+tam; 
			    Digitado2.innerHTML = str; 
			    Restante2.innerHTML = total - str; 
			
			    if (tam > total){ 
			        aux = txarea.value; 
			        txarea.value = aux.substring(0,total); 
			        Digitado2.innerHTML = total 
			        Restante2.innerHTML = 0 
			    } 
			}

			function checklength(field, countfield, maxlimit){
				if (field.value.length > maxlimit) // if too long...trim it!
					field.value = field.value.substring(0, maxlimit);
				// otherwise, update 'characters left' counter
				else 
					countfield.value = maxlimit - field.value.length;
			}
		</script>

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
                    
					<form name="encu" action="controlador_encuesta.php" method="post">
						<?php include('datosEncuesta.php'); ?>
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