<?php
session_start();
include_once("../modelo/utilitarios/Utilitarios.php");
include_once("../modelo/clasesBD/includeBD.php");
include_once("../modelo/clases/includeClases.php");
?>
<script type="text/javascript">
function verif(){
var vacio=0;
   	var vacio2=0;
	var vacio3=0;
	var vacios=0;
	var vacioss=0;
	var vaciosss=0;

	if ((document.datos.celular.value=="" )&&(vacio==0)){	   	
		alert("Agregue su número de celular");
		document.datos.celular.focus();
		vacio=1;
		//alert(selectColeccion);
	}
		 
	 if (isNaN(document.datos.celular.value)) { 
	    alert("Sólo agregue números en este campo ");
		document.datos.celular.focus();
		vacio=1;
	 }
	
	 if ((document.datos.indicador2.value=="" )&& (vacios==0)&& (vacio==0)){	   	
		alert("Agregue el indicador del supervisor");
		document.datos.indicador2.focus();
		vacios=1;
		//alert(selectColeccion);
	 }
	 
	 if ((document.datos.nombre2.value=="" )&&(vacioss==0)&&(vacios==0)&&(vacio==0)){	   	
		alert("Agregue el nombre del Supervisor");
		document.datos.nombre2.focus();
		vacioss=1;
		//alert(selectColeccion);
	 }
	 
	 if((document.datos.telefono2.value=="" )&&(vaciosss==0)&&(vacioss==0)&&(vacios==0)&&(vacio==0)){	   	
		alert("Agregue la extensión del Supervisor");
		document.datos.telefono2.focus();
		vaciosss=1;
		//alert(selectColeccion);
	 }
	 
	 if((document.datos.lugar.value=="" )&&(vacio2==0)&&(vaciosss==0)&&(vacios==0)&& (vacioss==0)&&  (vacio==0)){	   	
		alert("Agregue el lugar de emisión de solicitud");
		document.datos.lugar.focus();
		vacio2=1;
		//alert(selectColeccion);
	 }
	 
	if((document.datos.filial.value=="" )&& (vaciosss==0)&& (vacioss==0)&&(vacios==0)&&(vacio3==0)&&(vacio2==0)&&(vacio==0)){	   	
		alert("Agregue el área de la organización que esta generando la solicitud");
		document.datos.filial.focus();
		vacio3=1;
		//alert(selectColeccion);
	}
	
	if ((vacio==0)&&(vacio2==0)&&(vacio3==0)&& (vacios==0)&& (vacioss==0)&& (vaciosss==0)){
		//document.datos.submit();
		return true;
	}else{
		return false;
	}
}

function abortar(j){

  document.datos.indicador.value = "";
  document.datos.indicador.disabled ='';
   document.datos.indicador2.value = "";
  document.datos.indicador2.disabled ='disabled';
   document.datos.nombre.value = "";
   document.datos.nombre.disabled ='disabled';
    document.datos.nombre2.value = "";
   document.datos.nombre2.disabled ='disabled';
   document.datos.telefono.value = "";
	document.datos.telefono.disabled ='disabled';
	document.datos.telefono2.value = "";
	document.datos.telefono2.disabled ='disabled';
	document.datos.celular.disabled ='disabled';
	document.datos.lugar.disabled ='disabled';
	document.datos.filial.disabled ='disabled';
	 document.datos.verificar.style.visibility = "visible";
		 document.datos.verificar.style.width = "auto";
		 document.datos.cancelar.style.visibility = "hidden"; 
}

function enviar(accion){
	validarBusqueda=1
	
	if (validarBusqueda==1){
	  if (accion=='verificar'){
		 if (document.datos.indicador.value==""){
			alert("Deberia agregar un indicador");
			document.datos.indicador.focus();
		 }else{
				  if (accion=='verificar'){
						document.datos.verificar.disabled=true;	
						document.datos.verificar.value="Verificando...";
					    document.body.style.cursor="wait";
						document.datos.accionUsuario.value=accion;
						document.datos.submit();
						
				  }
		}
	  }
	  if (accion=='guardar'){
	    $F=verif();
			if ($F){	
			  if(document.datos.text5.value!= ""){
			   document.datos.text5.disabled= '';}
			    if(document.datos.text6.value!= ""){
			   document.datos.text6.disabled= '';}
			    if(document.datos.text7.value!= ""){
			   document.datos.text7.disabled= '';}
			   document.datos.indicador.disabled= '';
			   document.datos.nombre.disabled ='';
			   document.datos.telefono.disabled = '';
			   document.datos.fecha.disabled ='';
			   document.datos.accionUsuario.value=accion;
			 
			 document.datos.submit();
			}
	   }
   }
}


function verificar(){
   	var vacio=0;
   	var vacio2=0;
	var selectTipo=0;
	var selectColeccion=0;
	var selectColeccion2=0;
	var selectColeccion3=0;
	var selectColeccion4=0;
	var selectColeccion6=0;	
	var vacio5=0;
	var vacio6=0;
	var vacio7=0;
	var vacio8=0;
	var vacio9=0;
	
  	if ((document.datos.texta4.value=="" )&&  (selectColeccion==0)){	   	
		alert("Agregue un nombre o descripción del documento propuesto");
		document.datos.texta4.focus();
		selectColeccion=1;
		//alert(selectColeccion);
	}
	
	if ((document.datos.documento.options[0].selected!='0' )&& (selectColeccion==0) && (selectColeccion2==0)){	   	
		alert("Seleccione un elemento de la lista del punto n°2");
		document.datos.documento.focus();
		selectColeccion2=1;
	}else{
		r=document.datos.documento.length;
		f=0;
		while (f<r){
			if((document.datos.documento.options[f].selected!='Existente')&&(document.datos.text2.value=="")&&(document.getElementById('tu2').style.display=='')){
			
				alert("El campo 'Código' del punto N° no puede estar vacio");
				document.datos.text2.focus();
				selectColeccion2=1;  
				 break;
			}
		   f++;
		 }
	}
	
	if ((document.datos.prioridad.options[0].selected!='0' )&& (selectColeccion3==0)&& (selectColeccion==0) && (selectColeccion2==0)){	   	
		alert("Seleccione un elemento de la lista del punto n°3");
		document.datos.prioridad.focus();
		selectColeccion3=1;
	}
	
	if ((document.datos.manual.options[0].selected!='0' )&& (selectColeccion4==0)&& (selectColeccion==0) && (selectColeccion2==0)&& (selectColeccion3==0)){	   	
		alert("Seleccione un elemento de la lista del punto n°4");
		document.datos.manual.focus();
		selectColeccion4=1;
	}else{
		r=document.datos.manual.length;
		f=0;
		while (f<r){
			if((document.datos.manual.options[f].selected!='otro')&&(document.datos.text4.value=="")&&(document.getElementById('tu4').style.display=='')){
			
				alert("El campo 'Otro' del punto n°4 no puede estar vacio");
				document.datos.text4.focus();
				selectColeccion2=1;  
				 break;
			}
		   f++;
		 }
	}		
			
	 var t=valido5('J');
	 if((t=="otro")&& (vacio5==0)&& (vacio==0) && (selectColeccion==0)&&(selectColeccion2==0)){
	    alert("El campo Otro del punto n°5 no puede estar vacio");
		document.datos.text5.focus();
	    vacio5=1;
	 }else{
		 if ((t==0)&& (vacio5==0)&& (vacio==0) && (selectColeccion==0)&&(selectColeccion2==0)){
			alert("Seleccione un elemento del punto n°5");
			vacio5=1;
		 } 
	 }
	
	  var t=valido6('J');
	 if(t=="otro"){
	    alert("El campo Otro del punto n°6 no puede estar vacio");
		document.datos.text6.focus();
	    vacio6=1;
	 }else{
		 if ((t==0)&& (vacio6==0)&& (vacio5==0)&& (vacio==0) && (selectColeccion==0)&&(selectColeccion2==0)){
			alert("Seleccione un elemento del punto n°6");
			vacio6=1;
		 } 
	 }
	 
	 var t=valido7('J');
	 if(t=="otro"){
	    alert("El campo Otro del punto n°7 no puede estar vacio");
		document.datos.text7.focus();
	    vacio7=1;
	 }else{
		 if ((t==0)&& (vacio7==0)&& (vacio6==0)&& (vacio5==0)&& (vacio==0) && (selectColeccion==0)&&(selectColeccion2==0)){
			alert("Seleccione un elemento del punto n°7");
			vacio7=1;
		 } 
	 }
	 
	  if ((document.datos.txObser2.value=="" )&&  (vacio9==0)&&  (selectColeccion==0)&& (vacio7==0)&& (vacio6==0)&& (vacio5==0)&& (vacio==0) && (selectColeccion==0)&&(selectColeccion2==0)){	   	
    
		alert("El campo Motivo no puede estar vacio");
		document.datos.txObser2.focus();
		vacio9=1;
		//alert(selectColeccion);
	}
	 
	  if ((selectColeccion!=1) && (vacio==0) && (selectColeccion2==0) && (vacio2==0)&&(selectColeccion4==0)&&(selectColeccion6==0)&& (vacio5==0) && (vacio6==0) && (vacio7==0) && (vacio8==0) && (vacio9==0)){
		 document.getElementById('prueba').value=0;
			
			return true;
	  }else{
	   document.getElementById('prueba').value=1;
		 return (false);
	  }
}

function valido5(valor){
  var cuentaChecked=0;
   if (valor == 'J') {
   var i=0;
       var t=document.datos["arre5[]"].length;
	   while(i < t){

         if(document.datos["arre5[]"][i].checked){
		    if(document.datos["arre5[]"][i].value=='otro'){
			   if (document.datos.text5.value=="")
			    return "otro";
			}
          cuentaChecked++;
         }
         i++;
       }
	   
      return (cuentaChecked);   
   }
}
 
function valido6(valor){
  var cuentaChecked=0;
   if (valor == 'J') {
   var i=0;
       var t=document.datos["arre6[]"].length;
	   while(i < t){

         if(document.datos["arre6[]"][i].checked){
		    if(document.datos["arre6[]"][i].value=='otro'){
			   if (document.datos.text6.value=="")
			    return "otro";
			}
          cuentaChecked++;
         }
         i++;
       }
	   
      return (cuentaChecked);   
   }
}
 
function valido7(valor){
  var cuentaChecked=0;
   if (valor == 'J') {
   var i=0;
       var t=document.datos["arre7[]"].length;
	   while(i < t){

         if(document.datos["arre7[]"][i].checked){
		    if(document.datos["arre7[]"][i].value=='otro'){
			   if (document.datos.text7.value=="")
			    return "otro";
			}
          cuentaChecked++;
         }
         i++;
       }
	   
      return (cuentaChecked);   
   }
}

function cambiar(cam){

	if (cam=='1'){
	  llave = 1;
	}else{
	  llave =0;
	}
	
	document.getElementById("pagina").value=llave;
	
	return llave;
}

function buscar(){
	if (document.getElementById('prueba').value==0){
		  var r=document.getElementById('pagina').value;  
		 
		  if (r==0){
		     //document.datos.submit();
			 createNewTab('dhtmlgoodies_tabView1','Datos del solicitante','','externalfile.php',false);
			 cambiar('1');
			 
		  }else{
			alert("Llene todos los datos de la pestaña Datos del Solicitante y presione '>>Enviar'");
		  }
		  return r;
  	}
}

function validar2(r){
 
 if (r=="Existente"){
     document.getElementById('tu2').style.display='';
  }else{
    document.getElementById('tu2').style.display='none';
  }
}

function Enviar5(r){
 if ((r=="J")&&(document.datos["arre5[]"][11].checked)){
   
	 document.getElementById('text5').disabled='';
  }else{
    document.getElementById('text5').disabled='disabled';
  }
}

function Enviar6(r){
 
 if ((r=="J")&&(document.datos["arre6[]"][6].checked)){
     document.getElementById('text6').disabled='';
  }else{
    document.getElementById('text6').disabled='disabled';
  }
}

function Enviar7(r){
 
 if ((r=="J")&&(document.datos["arre7[]"][15].checked)){
     document.getElementById('text7').disabled='';
  }else{
    document.getElementById('text7').disabled='disabled';
  }
}

function validar4(r){
 
 if (r=="otro"){
     document.getElementById('tu4').style.display='';
  }else{
    document.getElementById('tu4').style.display='none';
  }
}

function cargarDatos(){
  	<?php
	 if (isset ($_GET["VAL"])){
	
	   if (isset($_SESSION['resultadoSolicitud'])){
	  
			$Solicitud=unserialize($_SESSION['resultadoSolicitud']); 
			echo "document.datos.texta4.value='".$Solicitud->getTx1()."';";
			echo "docu= '".$Solicitud->getTx2()."';";
			echo "pri= '".$Solicitud->getTx3()."';";
			echo "ma= '".$Solicitud->getTx4()."';";
			echo "cinco='".$Solicitud->getTx5()."';";
			echo "seis='".$Solicitud->getTx6()."';";
			echo "siete='".$Solicitud->getTx7()."';";
			echo "document.datos.txObser2.value='".$Solicitud->getTx8()."';";
	    ?>
		
		   g=cinco.substring(1,cinco.length);
		    gi=seis.substring(1,seis.length);
			gis=siete.substring(1,siete.length);
		   
		   u=g.split(",");
		   u6= gi.split(",");
		   u7= gis.split(",");
		
			//mostrar resulado de p2
			var te=0;
			for(i=0;i<document.datos.documento.length;i++){
			   	id = document.datos.documento.options[i].value;
				if(id==docu){
				 	document.datos.documento.options[i].selected = true;
					te=1;
		        }
			}
				if(te==0){
				   document.datos.documento.options[2].selected = true;
				   document.getElementById('tu2').style.display='';
				   document.datos.text2.value=docu;
				  
				}
	        
			//mostrar resulado de p3
			for(i=0;i<document.datos.prioridad.length;i++){
			   	id = document.datos.prioridad.options[i].value;
				if(id==pri){
				 	document.datos.prioridad.options[i].selected = true;
				}
				
	        }
			
			//mostrar resulado de p4
			var te1=0;
			for(i=0;i<document.datos.manual.length;i++){
			   	id = document.datos.manual.options[i].value;
				if(id==ma){
				 	document.datos.manual.options[i].selected = true;
					te1=1;
		        }
			}
				if(te1==0){
				   document.datos.manual.options[7].selected = true;
				   document.getElementById('tu4').style.display='';
				   document.datos.text4.value=ma;
				  
				}
			
			//mostrar resulado de p5
			var te1=0;
			var f=0;
			
			while (f<u.length){
				for(i=0;i<document.datos["arre5[]"].length;i++){
					id= document.datos["arre5[]"][i].value;
					if (u[f]=='otro'){
					  document.datos.text5.value =u[f+1];
					  document.datos["arre5[]"][document.datos["arre5[]"].length-1].checked=true;
					  document.datos.text5.selected ='';
					  
					}else{
						if(id==u[f]){
							document.datos["arre5[]"][i].checked=true;
							te1=1;
						}
					}
				}
				f++;
			}
								
			//mostrar resulado de p6
			var te1=0;
			var f=0;
			
			while (f<u6.length){
				for(i=0;i<document.datos["arre6[]"].length;i++){
					id= document.datos["arre6[]"][i].value;
					if (u6[f]=='otro'){
					  document.datos.text6.value =u6[f+1];
					  document.datos["arre6[]"][document.datos["arre6[]"].length-1].checked=true;
					  document.datos.text6.selected ='';
					  
					}else{
						if(id==u6[f]){
							document.datos["arre6[]"][i].checked=true;
							te1=1;
						}
					}
				}
				f++;
			}
				
				//mostrar resulado de p7
			var te1=0;
			var f=0;
			
			while (f<u7.length){
				for(i=0;i<document.datos["arre7[]"].length;i++){
					id= document.datos["arre7[]"][i].value;
					if (u7[f]=='otro'){
					  document.datos.text7.value =u7[f+1];
					  document.datos["arre7[]"][document.datos["arre7[]"].length-1].checked=true;
					  document.datos.text7.selected ='';
					  
					}else{
						if(id==u7[f]){
							document.datos["arre7[]"][i].checked=true;
							te1=1;
						}
					}
				}
				f++;
			}
			
	   <?php
	   }
	    if ($_GET["VAL"]==1){
	   ?>
	     document.getElementById("pagina").value=1;
		 document.datos.cancelar.style.visibility = "visible";
		 document.datos.cancelar.style.width = "auto";
		 document.datos.verificar.style.visibility = "hidden";
		
		<?php
		
			 $Solicitante= new Solicitante();
			 if (isset($_SESSION['resultadoVerificar'])){
			 
			  $Solicitante=unserialize($_SESSION['resultadoVerificar']); 
				  echo "document.datos.indicador.value='".$Solicitante->getIndicador()."';";
				  echo "document.datos.nombre.value='".$Solicitante->getNombre()."';";
				  echo "document.datos.telefono.value='".$Solicitante->getTelefono()."';";
			      
			  ?>
				    document.datos.indicador.disabled = 'disabled';
					document.datos.nombre.disabled = 'disabled';
					document.datos.telefono.disabled = 'disabled';
					document.datos.indicador2.disabled = '';
					document.datos.nombre2.disabled = '';
					document.datos.telefono2.disabled = '';
					document.datos.celular.disabled = '';
					document.datos.lugar.disabled = '';
					document.datos.filial.disabled = '';
				    document.datos.celular.focus();
			 <?php
			 }
		
		}
	}
	?>
}

