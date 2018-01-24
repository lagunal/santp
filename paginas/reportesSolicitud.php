<?php
    include "../controles/header.php";

    include_once "../clases/cargarLog.php";
    $log = new Log();

	//INICIO AUTORIZAR PÁGINA ***************
	autorizarPagina("REPORTES");
	//FIN AUTORIZAR PÁGINA ***************

?>

<html>
    <head>
        <title><?php echo $config->nombreAplicacion; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" title="Principal-Aplicaciones" type="text/css" href="../css/main-aplicacion.css" />
		<script language="JavaScript" type="text/javascript" src="../js/injectionJS.js"></script>
		<script type="text/javascript">
			function buscar_frame(dia,mes,anio){
				var cad="";
				var uno=0;
				var dos=0;
				var tres=0;
				
				if (anio!=0){
				 cad=anio;
				 uno=1;
				}
				
				if ((mes!=0)&&(anio!=0)){
					cad+="-"+mes;
				  	dos=1;
				}else if((mes!=0)&&(anio==0)){
				 	cad=mes;
				  	dos=1;
				}
				
				if (dia!=0){
				  	cad+="-"+dia;
				  	tres=1;
				}
			
				if((dia==0)&&(mes!=0)&&(anio==0)){
				  	alert("Introduzca un año en especifico o seleccione un día ");
				}else if ((dia==0)&&(mes==0)&&(anio==0)){
				  	alert("Introduzca fecha");
				}else{
			        var imag= "../paginas/controladorPaginacion.php?fecha="+cad+"&uno="+uno+"&dos="+dos+"&tres="+tres+"&pagi="+0;;  
					window.frames.ifrm.document.location.href=imag;
				}
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
                    <form id="datos" style="margin:0px">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%">
                            <tr>
                                <td height="10px"></td>
                                <td style="display:none"><input type="hidden" name="accionUsuario" id="accionUsuario" /> </td>
                            </tr>
                            <tr>
                                <td valign="top">


<table border="0" cellpadding="1" cellspacing="1">
	<tr>
		<td colspan="6" class="Titulo">
			Busqueda de reportes 
		</td>
	</tr>
	<tr>
	    <td width="22" height="42"  class="Detalle">Día:</td>
	    <td width="48">
	    	<select name="select" id="dia" class="Detalle" style="width:60px">
		        <option value="00">Todos</option><option value="01">1</option><option value="02">2</option>
		        <option value="03">3</option><option value="04">4</option><option value="05">5</option>
		        <option value="06">6</option><option value="07">7</option><option value="08">8</option>
		        <option value="09">9</option><option value="10">10</option><option value="11">11</option>
				<option value="12">12</option><option value="13">13</option><option value="14">14</option>
				<option value="15">15</option><option value="16">16</option><option value="17">17</option>
		        <option value="18">18</option><option value="19">19</option><option value="20">20</option>
		        <option value="21">21</option><option value="22">22</option><option value="23">23</option>
		        <option value="24">24</option><option value="25">25</option><option value="26">26</option>
		        <option value="27">27</option><option value="28">28</option><option value="29">29</option>
		        <option value="30">30</option><option value="31">31</option>
	    	</select>
		</td>
	    <td width="28" class="contBold1">
	    	<div align="center" class="Detalle">Mes:</div>
		</td>
	    <td width="51">
	    	<select name="select2" id="mes" class="Detalle" style="width:60px">
		        <option value="01">1</option><option value="02">2</option>
		        <option value="03">3</option><option value="04">4</option><option value="05">5</option>
		        <option value="06">6</option><option value="07">7</option><option value="08">8</option>
		        <option value="09">9</option><option value="10">10</option><option value="11">11</option>
		        <option value="12">12</option>
	    	</select>
		</td>
	    <td width="27" class="Detalle">
	   		<div align="center">A&ntilde;o:</div>
		</td>
	    <td width="47">
	    	<input name="textfield2" type="text" size="6" maxlength="4" id="ani" value="<?php echo date("Y"); ?>">
		</td>
		<td width="15px"></td>
		<td>
			<table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="13" align="right"><img src="../imagenes/bt_esq_izq.gif" width="13" height="33"></td>
                    <td width="67" align="middle" background="../imagenes/bt_bg.gif">
                        <div align="center" style='cursor:pointer; border:1px #FFF'>
                            <a class="Detalle" onClick="buscar_frame(document.getElementById('dia').value,document.getElementById('mes').value,document.getElementById('ani').value)">
                            	<strong>»&nbsp;BUSCAR&nbsp;«</strong>
                            </a>
                        </div>
					</td>
                    <td width="14" align="left"><img height="33" src="../imagenes/bt_esq_der.gif" width="13"></td>
                </tr>
			</table>
		</td>
  	</tr>
</table>
<iframe src="" name="ifrm" frameborder="0" style="width: 590px; height:500px; border:0; marginheight:0; marginwidth:0; scrolling:no"></iframe>

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