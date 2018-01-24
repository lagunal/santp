<?php
	include "../clases/presentacion.php";
    include "../controles/header.php";

    include_once "../clases/cargarLog.php";
    $log = new Log();

	//INICIO AUTORIZAR PÁGINA ***************
	autorizarPagina("ACTUALIZAR");
	//FIN AUTORIZAR PÁGINA ***************

	$pres = new presentacion();

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
		
					<form method="post" name="registro" action="inser_data.php" style="margin:0px" >

<table border="0" width="100%">
    <tr>
        <td colspan="2" scope="col">
            <div align="justify" class="Titulo">
                <strong>Para Actualizar la Base de Datos de Búsqueda es Necesario Cargar los Siguientes Datos:</strong>
            </div>
        </td>
    </tr>
    <tr align="left" valign="middle" bgcolor="#F3F3F3">
        <td scope="col">
            <div align="justify" class="Detalle">
                <div align="right">
                    <br>
                    <br>
                     <strong>*Título de la Nueva Norma:</strong>
                </div>
            </div>
        </td>
        <td align="center" bgcolor="#F3F3F3" scope="col">
            <div align="left">
                <span class="Detalle1"><br>
                <br>
                 <input type="text" name="nomb" size="70" maxlength="500" ></span>
            </div>
        </td>
    </tr>
    <tr align="left" valign="middle" bgcolor="#F3F3F3">
        <td scope="col">
            <div align="justify" class="Detalle">
                <div align="right">
                    <br>
                    <br>
                     <strong>*Ruta donde se almacenó el archivo:</strong>
                </div>
            </div>
        </td>
        <td align="center" bgcolor="#F3F3F3" scope="col">
            <div align="left">
                <span class="Detalle"><br>
                <br>
                 <input type="text" name="ruta" size="70" maxlength="500"></span>
            </div>
        </td>
    </tr>
    <tr align="left" valign="middle" bgcolor="#F3F3F3">
        <td scope="col">
            <div align="justify" class="Detalle">
                <div align="right">
                    <br>
                    <br>
                     <strong>*Mes:</strong>
                </div>
            </div>
        </td>
        <td align="center" bgcolor="#F3F3F3" scope="col">
            <div align="left">
                <span class="Detalle"><br>
                <br>
                 <select name="mes" size="1" class="Detalle" id="mes">
                    <option value="Ene">Enero</option>
                    <option value="Feb">Febrero</option>
					<option value="Mar">Marzo</option>
                    <option value="Abr">Abril</option>
                    <option value="May">Mayo</option>
                    <option value="Jun">Junio</option>
                    <option value="Jul">Julio</option>
                    <option value="Ago">Agosto</option>
                    <option value="Sep">Septiembre</option>
                    <option value="Oct">Octubre</option>
                    <option value="Nov">Noviembre</option>
                    <option value="Dic">Diciembre</option>
                </select><br>
                </span>
            </div>
        </td>
    </tr>

    <tr align="left" valign="middle" bgcolor="#F3F3F3">
        <td scope="col">
            <div align="justify" class="Detalle">
                <div align="right">
                    <br>
                    <br>
                     <strong>*Año :</strong>
                </div>
            </div>
        </td>
        <td align="center" bgcolor="#F3F3F3" scope="col">
            <div align="left">
                <span class="Detalle"><br>
                <br>
                 <select name="year" size="1">
                 	<?php
						$desde = 1980;
						$hasta = date("Y");
						$anos = array();
						
						for($i=$hasta; $i>=$desde; $i--){
							$anos []= $i;
							echo $i;
						}
						
						echo $pres->crearComboArray($anos, "");
					?>
                </select>
				</span>
            </div>
        </td>
    </tr>

    <tr align="left" valign="middle" bgcolor="#F3F3F3">
        <td scope="col">
            <div align="justify" class="Detalle">
                <div align="right">
                    <br>
                    <br>
                     <strong>*Revisión N° :</strong>
                </div>
            </div>
        </td>

        <td align="center" bgcolor="#F3F3F3" scope="col">
            <div align="left">
                <span class="Detalle"><br>
                <br>
                 <select name="revi" size="1">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                </select></span>
            </div>
        </td>
    </tr>
    <tr align="left" valign="middle" bgcolor="#F3F3F3">
        <td scope="col">
            <div align="justify" class="Detalle">
                <div align="right">
                    <br>
                    <br>
                     <strong>*Código de la Norma:</strong>
                </div>
            </div>
        </td>
        <td align="center" bgcolor="#F3F3F3" scope="col">
            <div align="left">
                <span class="Detalle"><br>
                <br>
                 <input type="text" name="codi" size="30" maxlength="60"></span>
            </div>
        </td>
    </tr>
<!--
    <tr align="left" valign="middle" bgcolor="#F3F3F3">
        <td scope="col">
            <div align="justify" class="Detalle">
                <div align="right">
                    <br>
                    <br>
                     <strong>*Adjuntar Norma :</strong>
                </div>
            </div>
        </td>
        <td align="center" bgcolor="#F3F3F3" scope="col">
            <div align="left">
                <span class="Detalle"><br>
                <br>
                 <input name="archivo_name" type="file" class="style14" id="archivo_name" value="" size="30" maxlength="5000" onkeyup="if (!ValidaTexto(this.value)) {alert('Por favor no ingrese caracteres especiales');this.value='';}"></span>
            </div>
        </td>
    </tr>
-->
    <tr>
        <td colspan="2" scope="col">
            <div align="center" class="Detalle">
                <br>
                 <input type="submit" name="Submit" value="Enviar" style="width:60px">
            </div>
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