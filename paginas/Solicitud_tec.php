<?php
    session_start();
    include_once("../modelo/utilitarios/Utilitarios.php");
    include_once("../modelo/clasesBD/includeBD.php");
    include_once("../modelo/clases/includeClases.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta name="generator" content="HTML Tidy, see www.w3.org">
        <title>// Sistema Automatizado de Normas Técnicas PDVSA //</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="../css/main-aplicacion.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!-- 
/* CSS issu des tutoriels www.alsacreations.com/articles */

dl, dt, dd, ul, li {
margin: 0;
padding: 0;
list-style-type: none;
font-family: Verdana;
font-size: 11px;
font-style: normal;
color: #003399;
text-decoration: none;
}
dl#menu dd {
border: 1px solid gray;
}
dl#menu li {
font-family: Verdana;
    font-size: 11px;
    font-style: normal;
    color: #003399;
    text-decoration: none;
}
dl#menu li a, dl#menu dt a {
color: #003399;
text-decoration: none;
display: block;
border: 0 none;
height: 100%;
}


#mentions {
font-family: verdana, arial, sans-serif;
position: absolute;
bottom : 200px;
left : 10px;
color: #000;
background-color: #ddd;
}
#mentions a {font-family: Verdana;
    font-size: 11px;
    font-style: normal;
    color: #003399;
    text-decoration: none;
}
#mentions a:hover{text-decoration: underline;
}
body {
    margin-top: 0px;
}

-->
</style>

<!-- ************************************************************************************** -->

<style type="text/css">
<!--
.Estilo4 {font-size: 9px}
.Estilo5 {
    font-size: 16px;
    color: #000000;
}
.Estilo6 {font-size: 10px}
.Estilo7 {color: #000000}
-->
</style>

<script type="text/javascript">
	function cargarDatos(){

    <?php
      if (isset($_SESSION['resultadoSolicitud'])){
          
            $Solicitud=unserialize($_SESSION['resultadoSolicitud']); 
            $Solicitante=unserialize($_SESSION['resultadoUsuario']);
            if($Solicitud->getTx1()!=""){
            echo"document.getElementById('resultado').tBodies[0].rows[2].cells[0].innerHTML = '" .$Solicitud->getTx1()."';";  
            echo "dos= '".$Solicitud->getTx2()."';";
            echo "tres= '".$Solicitud->getTx3()."';";
            echo "cuatro= '".$Solicitud->getTx4()."';";
            echo "cinco='".$Solicitud->getTx5()."';";
            echo "seis='".$Solicitud->getTx6()."';";
            echo "siete='".$Solicitud->getTx7()."';";
            
            
                        
        ?>
        
           g=cinco.substring(1,cinco.length);
            gi=seis.substring(1,seis.length);
            gis=siete.substring(1,siete.length);
           
            u=g.split(",");
            u6= gi.split(",");
            u7= gis.split(",");
        
            
            //mostrar resulado de p2
            r=false;
            for(i=0;i<document.reporte["arre[]"].length;i++){
                id = document.reporte["arre[]"][i].value;
                if(id==dos){
                
                    document.reporte["arre[]"][i].checked=true;
                    r=true;
                }
            }
            if(r==false){
              document.reporte.texto.value=dos;
               document.reporte.texto.disabled='disabled';
               document.reporte["arre[]"][1].checked=true;
                
               
            }
             document.reporte["arre[]"][0].disabled='disabled';
             document.reporte["arre[]"][1].disabled='disabled';
            
            /*mostrar resultado de p3*/
            for(i=0;i<document.reporte["arre2[]"].length;i++){
                id = document.reporte["arre2[]"][i].value;
                if(id==tres){
                
                    document.reporte["arre2[]"][i].checked=true;
                    
                }
                document.reporte["arre2[]"][i].disabled='disabled';
            }
            
            
            
            //mostrar resulado de p4
            ri=false;
            for(i=0;i<document.reporte["arre4[]"].length;i++){
                id = document.reporte["arre4[]"][i].value;
                if(id==cuatro){
                
                    document.reporte["arre4[]"][i].checked=true;
                    ri=true;
                }
                 document.reporte["arre4[]"][i].disabled='disabled';
            }
            if(ri==false){
              document.reporte.texto4.value=cuatro;
               document.reporte.texto4.disabled='disabled';
              
                
               
            }
            
            
            //mostrar resulado de p5
            var te1=0;
            var f=0;
            
            while (f<u.length){
            
                for(i=0;i<document.reporte["arre5[]"].length;i++){
                    id= document.reporte["arre5[]"][i].value;
                    
                    if (u[f]=='otro'){
                      document.reporte.texto5.value =u[f+1];
                      //document.reporte["arre5[]"][document.reporte["arre5[]"].length-1].checked=true;
                      document.reporte.texto5.disabled ='disabled';
                      
                    }else{
                        if(id==u[f]){
                            document.reporte["arre5[]"][i].checked=true;
                            te1=1;
                        }
                    }
                     document.reporte["arre5[]"][i].disabled='disabled';
                }
                f++;
            }
                                
            //mostrar resulado de p6
            var te1=0;
            var f=0;
            
            while (f<u6.length){
                for(i=0;i<document.reporte["arre6[]"].length;i++){
                    id= document.reporte["arre6[]"][i].value;
                    if (u6[f]=='otro'){
                      document.reporte.texto6.value =u6[f+1];
                      //document.reporte["arre6[]"][document.reporte["arre6[]"].length-1].checked=true;
                      document.reporte.texto6.disabled ='disabled';
                      
                    }else{
                        if(id==u6[f]){
                            document.reporte["arre6[]"][i].checked=true;
                            te1=1;
                        }
                    }
                     document.reporte["arre6[]"][i].disabled='disabled';
                }
                f++;
            }
                
                //mostrar resulado de p7
            var te1=0;
            var f=0;
            
            while (f<u7.length){
                for(i=0;i<document.reporte["arre7[]"].length;i++){
                    id= document.reporte["arre7[]"][i].value;
                    if (u7[f]=='otro'){
                      document.reporte.texto7.value =u7[f+1];
                      document.reporte.texto7.disabled ='disabled';
                      
                    }else{
                        if(id==u7[f]){
                            document.reporte["arre7[]"][i].checked=true;
                            te1=1;
                        }
                    }
                     document.reporte["arre7[]"][i].disabled='disabled';
                }
                f++;
            }
            
            
            
            
       <?php
       }
       
         
    }
            
    echo"document.getElementById('resultado').tBodies[0].rows[6].cells[0].innerHTML = '" .$Solicitud->getTx8()."';";  
    echo"document.getElementById('resultado').tBodies[0].rows[8].cells[0].innerHTML = '" .$Solicitante->getNombre()."';";  
    echo"document.getElementById('resultado').tBodies[0].rows[8].cells[1].innerHTML = '" .$Solicitante->getTelefono()."';";  
    echo"document.getElementById('resultado').tBodies[0].rows[8].cells[2].innerHTML = '" .$Solicitante->getCelular()."';";  
    echo"document.getElementById('resultado').tBodies[0].rows[8].cells[3].innerHTML = '" .$Solicitante->getIndicador()."';"; 
    echo"document.getElementById('resultado').tBodies[0].rows[8].cells[4].innerHTML = '" .$Solicitud->getTx_Lugar()."';";  
    echo"document.getElementById('resultado').tBodies[0].rows[10].cells[1].innerHTML = '" .$Solicitante->getNombre_sup()."';"; 
    echo"document.getElementById('resultado').tBodies[0].rows[10].cells[3].innerHTML = '" .$Solicitante->getIndicador_sup()."';";  
    echo"document.getElementById('resultado').tBodies[0].rows[10].cells[0].innerHTML = '" .$Solicitud->getUnidad()."';"; 
    echo"document.getElementById('resultado').tBodies[0].rows[10].cells[2].innerHTML = '" . $Solicitante->getTelefono_sup()."';";   
    
    ?>
    
    
}
</script>
    </head>

    <body onload="cargarDatos()">
        <form name="reporte" action="">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <div align="center">
                            <table width="710" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td height="94" align="center" valign="top">
                                        <table width="100%" border="1" bordercolor="#000000" id="resultado">
                                            <tr>
                                                <td height="153" colspan="3" align="left" valign="top">
                                                    <p align="center"><img src="../imagenes/Logo%20PDVSA%20Intevep%20Negro.jpg" width="250" height="97"> <strong class="Detalle"><span class="Detalle">NORMALIZACIÓN TÉCNICA<br>
                                                     CORPORATIVA (NOR)<br>
                                                     <span class="Detalle">Gerencia Técnica del Centro de Información (SGCIT)</span></span><span class="Detalle"><br>
                                                    <br>
                                                    </span></strong></p>
                                                </td>
                                                <td colspan="8" bgcolor="#CCCCCC">
                                                    <div align="center" class="Detalle">
                                                        <strong>SOLICITUD DE ELABORACIÓN O REVISIÓN DE DOCUMENTO TÉCNICO</strong>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="16" colspan="3" class="Detalle">1. DOCUMENTO PROPUESTO:</td>
                                                <td colspan="3" class="Detalle">
                                                    <div align="left">
                                                        2. Documento
                                                    </div>
                                                </td>
                                                <td colspan="3" class="Detalle">
                                                    <div align="left" class="Detalle">
                                                        <span class="Detalle">3. Prioridad</span>
                                                    </div>
                                                </td>
                                                <td colspan="2" class="Detalle">4. Manual Técnico</td>
                                            </tr>
                                            <tr>
                                                <td height="208" colspan="3" valign="top" class="Detalle"></td>

                                                <td colspan="3" align="left" valign="top" class="Detalle">
                                                    <p align="left"><br>
                                                    &nbsp;&nbsp;NUEVO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre[]" value="Nuevo"><br>
                                                    <br>
                                                    &nbsp;&nbsp;EXISTENTE&nbsp;<input name="arre[]" type="checkbox" value="Existente"><br>
                                                    <br>
                                                    &nbsp;&nbsp;CÓDIGO N°:<br>
                                                    &nbsp;<input type="text" name="texto" size="9" disabled></p>
                                                </td>

                                                <td colspan="3" align="left" valign="top" class="Detalle"><br>
                                                 &nbsp;&nbsp;ALTA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre2[]" value="Alta"><br>
                                                <br>
                                                 &nbsp;&nbsp;MEDIA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre2[]" value="Media"><br>
                                                <br>
                                                 &nbsp;&nbsp;BAJA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre2[]" value="Baja"> </td>
                                                <td colspan="2" align="left" valign="top" class="Detalle">
                                                    <br>
                                                    <div align="left">
                                                        &nbsp;&nbsp;MATERIALES&nbsp;&nbsp; <input type="checkbox" name="arre4[]" value="Materiales"><br>
                                                        <br>
                                                        &nbsp;&nbsp;INGIENERÍA&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre4[]" value="Ingenieria"><br>
                                                        <br>
                                                        &nbsp;&nbsp;INSPECCIÓN&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre4[]" value="Inspección"><br>
                                                        <br>
                                                        &nbsp;&nbsp;PROCESOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre4[]" value="Procesos"><br>
                                                        <br>
                                                        &nbsp;&nbsp;RIESGOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre4[]" value="checkbox"><br>
                                                        <br>
                                                        &nbsp;&nbsp;NO SABE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre4[]" value="checkbox"><br>
                                                        <br>
                                                         &nbsp;&nbsp;OTRO:<br>
                                                        &nbsp;<input name="texto4" type="text" size="15" disabled><br>
                                                        <br>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="28" colspan="2" valign="middle">
                                                    <div align="left" class="Detalle">
                                                        <span class="Detalle">5. Aplicación en Actividad de:</span>
                                                    </div>
                                                </td>
                                                <td colspan="3" align="left" valign="middle" class="Detalle">6. Utilizada en:</td>
                                                <td colspan="6" align="left" valign="middle" class="Detalle">7. Requerido por Razones de:</td>
                                            </tr>
                                            <tr>
                                                <td width="130" height="313" align="left" valign="top" class="Detalle"><br>
                                                &nbsp;&nbsp;OPERACIÓN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre5[]" value="Operación"> <br>
                                                 <br>
                                                &nbsp;&nbsp;MANTENIMIENTO&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre5[]" value="Mantenimiento"><br>
                                                <br>
                                                 &nbsp;&nbsp;TRANSPORTE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre5[]" value="Transporte"><br>
                                                <br>
                                                 &nbsp;&nbsp;CONSTRUCCIÓN&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre5[]" value="Construcción"><br>
                                                <br>
                                                 &nbsp;&nbsp;PRUEBAS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre5[]" value="Prueba"><br>
                                                <br>
                                                 &nbsp;&nbsp;COMPRAS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre5[]" value="Compra"><br>
                                                <br>
                                                 &nbsp;&nbsp;OTRO:<br>
                                                 &nbsp;<input name="texto5" type="text" size="14" disabled> <br>
                                                </td>

                                                <td width="113" align="left" valign="top" class="Detalle"><br>
                                                 &nbsp;&nbsp;SEGURIDAD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre5[]" value="Seguridad"><br>
                                                <br>
                                                 &nbsp;&nbsp;CALIDAD&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre5[]" value="Calidad"><br>
                                                <br>
                                                 &nbsp;&nbsp;INSPECCIÓN&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre5[]" value="Inspección"><br>
                                                <br>
                                                 &nbsp;&nbsp;DISEÑO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre5[]" value="Diseño"><br>
                                                <br>
                                                 &nbsp;&nbsp;HIGIENE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre5[]" value="Higiene"></td>

                                                <td colspan="3" align="left" valign="top" class="Detalle"><br>
                                                &nbsp;&nbsp;REFINACIÓN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre6[]" value="Refinación"><br>
                                                <br>
                                                 &nbsp;&nbsp;PETROQUÍMICA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre6[]" value="Petroquímica"><br>
                                                <br>
                                                 &nbsp;&nbsp;PRODUCCIÓN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre6[]" value="Producción"><br>
                                                <br>
                                                 &nbsp;&nbsp;MERCADO INTERNO <input type="checkbox" name="arre6[]" value="Mercado Interno"><br>
                                                <br>
                                                 &nbsp;&nbsp;COSTA AFUERA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre6[]" value="Costa Afuera"><br>
                                                <br>
                                                 &nbsp;&nbsp;PLANTA PILOTO&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre6[]" value="Planta piloto"><br>
                                                <br>
                                                 &nbsp;&nbsp;OTRO:<br>
                                                <input name="texto6" type="text" size="14" disabled><br>
                                                <br>
                                                </td>

                                                <td colspan="3" align="left" valign="top" class="Detalle"><br>
                                                &nbsp;&nbsp;AVANCE &nbsp;&nbsp;TECNOLÓGICO&nbsp;&nbsp;<input type="checkbox" name="arre7[]" value="Avance Tecnológico"><br>
                                                <br>
                                                &nbsp;&nbsp;CAMBIO NORMA &nbsp;&nbsp;BASE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre7[]" value="Cambio de Norma Base"> <br>
                                                <br>
                                                &nbsp;&nbsp;ORDENAR &nbsp;&nbsp;TRABAJO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre7[]" value="Ordenar Trabajo"><br>
                                                <br>
                                                &nbsp;&nbsp;UNIFICAR &nbsp;&nbsp;CRITERIOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre7[]" value="Unificar Criterios"><br>
                                                <br>
                                                &nbsp;&nbsp;SIMPLIFICAR &nbsp;&nbsp;ACTIVIDADES&nbsp; <input type="checkbox" name="arre7[]" value="Simplificar Actividades"><br>
                                                <br>
                                                &nbsp;&nbsp;REDUCIR &nbsp;&nbsp;COSTOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre7[]" value="Reducir Costos"><br>
                                                <br>
                                                &nbsp;&nbsp;MAYOR &nbsp;&nbsp;SEGURIDAD&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre7[]" value="Mayor Seguridad"><br>
                                                <br>
                                                &nbsp;&nbsp;MEJORAR LA &nbsp;&nbsp;PRODUCTIVIDAD <input type="checkbox" name="arre7[]" value="Mejorar la productividad"></td>

                                                <td colspan="3" align="left" valign="top" class="Detalle">&nbsp;&nbsp;RACIONALIZACIÓN &nbsp;&nbsp;INVENTARIOS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre7[]" value="Racionalización Inventarios"><br>
                                                <br>
                                                 &nbsp;&nbsp;MEJORAR LA &nbsp;&nbsp;CALIDAD&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre7[]" value="Mejorar la Calidad"><br>
                                                <br>
                                                 &nbsp;&nbsp;IMPLANTAR NUEVAS &nbsp;&nbsp;TÉCNICAS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre7[]" value="Implantar nuevas técnicas"><br>
                                                <br>
                                                 &nbsp;&nbsp;IMPOSICIONES &nbsp;&nbsp;LEGALES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre7[]" value="Imposiciones Legales"><br>
                                                <br>
                                                 &nbsp;&nbsp;REDUCIR MONTOS DE &nbsp;&nbsp;ADQUISICIÓN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre7[]" value="Reducir montos de adquisición"><br>
                                                <br>
                                                 &nbsp;&nbsp;REDUCIR MONTOS DE &nbsp;&nbsp;CONTRATACIÓN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" name="arre7[]" value="Reducir montos de contratación"><br>
                                                <br>
                                                 &nbsp;&nbsp;MEJORAR &nbsp;&nbsp;INTERCAMBIABILIDAD <input type="checkbox" name="arre7[]" value="Mejorar intercambiabilidad"><br>
                                                <br>
                                                 &nbsp;&nbsp;OTRO:<br>
                                                &nbsp;<input name="texto7" type="text" size="14" disabled><br>
                                                 </td>
                                            </tr>

                                            <tr>
                                                <td height="20" colspan="11" align="left" valign="top" class="Detalle">8. Motivo:</td>
                                            </tr>

                                            <tr>
                                                <td height="98" colspan="11" align="left" valign="top" class="Detalle"></td>
                                            </tr>

                                            <tr>
                                                <td height="40" colspan="2" align="left" valign="middle" class="Detalle">9. Nombre y Apellido del Solicitante</td>

                                                <td colspan="2" align="left" valign="middle" class="Detalle">10. Extensión</td>

                                                <td colspan="3" align="left" valign="middle" class="Detalle">11. Num. Celular</td>

                                                <td colspan="3" align="left" valign="middle" class="Detalle">12. Indicador</td>

                                                <td width="121" align="left" valign="middle" class="Detalle">13. Lugar y Fecha</td>
                                            </tr>

                                            <tr>
                                                <td height="31" colspan="2" class="Detalle">&nbsp;</td>

                                                <td colspan="2" valign="top" class="Detalle"><!--DWLayoutEmptyCell-->&nbsp;</td>

                                                <td colspan="3" valign="top" class="Detalle"><!--DWLayoutEmptyCell-->&nbsp;</td>

                                                <td colspan="3" valign="top" class="Detalle"><!--DWLayoutEmptyCell-->&nbsp;</td>

                                                <td valign="top" class="Detalle"><!--DWLayoutEmptyCell-->&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td height="37" colspan="2" align="left" valign="middle" class="Detalle">14. Filial / Gerencia / Unidad</td>

                                                <td colspan="5" align="left" valign="middle" class="Detalle">15. Nombre y Apellido del Supervisor</td>

                                                <td colspan="3" align="left" valign="middle" class="Detalle">16. Extensión</td>

                                                <td align="left" valign="middle" class="Detalle">17. Indicador</td>
                                            </tr>

                                            <tr>
                                                <td height="37" colspan="2" class="Detalle">&nbsp;</td>

                                                <td colspan="5" class="Detalle">&nbsp;</td>

                                                <td colspan="3" class="Detalle">&nbsp;</td>

                                                <td class="Detalle">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="12" align="right" valign="top">
                                        <table width="99%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>