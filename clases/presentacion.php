<?php
class presentacion {
	public function crearVentanaInicioSinMenu($titulo){
		$id = "";
		if(isset($_SESSION["id"])) $id = $_SESSION["id"];
		
		$ventana = "";
		$ventana .= "<div class=\"Contenedor-con-sombra\" id=\"Main-BackCuerpoRight\">";
		$ventana .=	"	<div class=\"Contenedor-con-sombra\" id=\"Main-BackCuerpoLeft\">";
		$ventana .=	"		<div class=\"Contenedor\" id=\"Main-Cuerpo\">";
		$ventana .=	"			<div class=\"Contenedor-con-Bordes\" id=\"Main-Identificador_usuario\" style=\"height:18px;\">";
		$ventana .=	"				<span class=\"Texto-Identificador\" id=\"Main-Usuario\">Bienvenido, " . $this->obtenerNombreUsuario($id) . " </span>";
		$ventana .=	"				<span class=\"Texto-Identificador\" id=\"Main-Fecha\">" . $this->obtenerFechaLetras() . "</span>";
		$ventana .=	"			</div>";
		$ventana .=	"			<div class=\"Contenedor\" id=\"Main-breadcrumbs\">" .
				"					<div class=\"EsquinasBread\" id=\"EsquinaBreadIzquierda\"> </div>";
		$ventana .=	"				<div id=\"Main-Traza\">" .
				"					<table cellpadding='0' cellspacing='0' border='0' width='750px' height='100%'>" .
				"						<tr>" .
				"							<td width='725px' style='color: rgb(255, 255, 255);'>$titulo</td>" .
				"							<td>" .
				"								<a href='login.php' class='link_blanco'>Salir</a>" .
				"							</td>" .
				"						</tr>" .
				"					</table>" .
								   "</div>";
		$ventana .=	"				<div class=\"EsquinasBread\" id=\"EsquinaBreadDerecha\"></div>";
		$ventana .=	"			</div>";
		$ventana .=	"			<div id=\"Vista\" style=\"height:100%;\">";
		$ventana .=	"				<div class=\"Contenedor-Editable\" style=\"height:100%;\">";

		return $ventana;
	}

	public function crearVentanaInicio($titulo){
		$id = "";
		if(isset($_SESSION["id"])) $id = $_SESSION["id"];
		
		$ventana = "";
		$ventana .= "<div class=\"Contenedor-con-sombra\" id=\"Main-BackCuerpoRight\">";
		$ventana .=	"	<div class=\"Contenedor-con-sombra\" id=\"Main-BackCuerpoLeft\">";
		$ventana .=	"		<div class=\"Contenedor\" id=\"Main-Cuerpo\">";
		$ventana .=	"			<div class=\"Contenedor-con-Bordes\" id=\"Main-Identificador_usuario\" style=\"height:18px;\">";
		$ventana .=	"				<span class=\"Texto-Identificador\" id=\"Main-Usuario\">Bienvenido, " . $this->obtenerNombreUsuario($id) . " </span>";
		$ventana .=	"				<span class=\"Texto-Identificador\" id=\"Main-Fecha\">" . $this->obtenerFechaLetras() . "</span>";
		$ventana .=	"			</div>";
		$ventana .=	"			<div class=\"Contenedor\" id=\"Main-breadcrumbs\">";
		$ventana .=	"				<div id=\"Main-Traza\" style=\"width:770px\"><div id=\"Main-Traza-aux\"></div>&nbsp;<span class=\"Text-menu-aux\">$titulo</span></div>";
		$ventana .=	"				<div class=\"EsquinasBread\" id=\"EsquinaBreadDerecha\"></div>";
		$ventana .=	"			</div>";
		$ventana .=	"			<div class=\"Contenedor-Editable-Fondo\" id=\"Vista\" style=\"height:810px;\">";
		$ventana .=	"				<div class=\"Contenedor-Editable\" id=\"Menu\" style=\"height:810px;\">";

		return $ventana;
	}

    public function crearVentanaIntermedia(){
        $ventana = "                </div>";
        $ventana .= "               <div class=\"Contenedor-Editable\" id=\"Region-Editable\">";

        return $ventana;
    }

    public function crearVentanaFin(){
        $ventana = "                </div>";
        $ventana .= "           </div>";
        $ventana .= "       </div>";
        $ventana .= "   </div>";
        $ventana .= "</div>";

        return $ventana;
    }

    public function crearPie(){
        echo "<div class=\"Contenedor-con-Bordes\" id=\"Main-Contenedor-footer\">";
        include "../controles/pie.php"; 
        echo "</div>";
    }
    
    public function crearEncabezado($nombre){
        $ventana = "<div class=\"Contenedor\" id=\"Main-externo\">";
        $ventana .= "   <div class=\"Contenedor\" id=\"Main-header\">";
        $ventana .= "       <a href=\"\"><span class=\"Contenedor-con-Imagen\" id=\"Main-Logo\"></span></a>";
        $ventana .= "       <div class=\"Contenedor\" id=\"Contenedor-Degradado\">";
        $ventana .= "           <div class=\"Contenedor-con-Imagen\" id=\"Logo-Continuacion\">";
        $ventana .= "               <span class=\"Contenedor\" id=\"Nombre-Aplicacion\">$nombre</span>";
        $ventana .= "           </div>";
        $ventana .= "           <div class=\"Contenedor-con-Imagen\" id=\"Logo-Final\"></div>";
        $ventana .= "       </div>";
        $ventana .= "   </div>";
        $ventana .= "</div>";
        
        return $ventana;
    }

    public function obtenerNombreUsuario($nombre){
        include_once "../clases/directorioActivo.php";
        
        $da = new directorioActivo( $_SESSION["ubicacion"] );

	//print_r( $da->obtenerValor($nombre, 0, $_SESSION["id"], $_SESSION["pass"] ) );

        $nombre = $da->obtenerValor($nombre, array($da->nombre), $_SESSION["id"], $_SESSION["pass"] );
        return $nombre[0];
    }

    public function crearBoton($id, $nombre, $tipo, $parametros=""){
        $res = "<div class=\"Principio-Boton\"></div>" .
                "<input id=\"$id\" name=\"$id\" type=\"$tipo\" value=\"$nombre\" class=\"Boton\" $parametros>" .
                "<div class=\"Final-Boton\"></div>";
        
        return $res;
    }

    public function crearSeparador($titulo){
        $res = "<table cellspacing=0 cellpadding=0 border=0>" .
        		"<tr><td height=8px></td></tr>" .
        		"<tr>" .
        		"<td class=\"Titulo-Aplicacion\">$titulo</td>" .
        		"</tr>" .
        		"<tr>" .
        		"<td class=\"Separador_Modulo\"></td>" .
        		"</tr>" .
        		"</table>";

        return $res;
    }

    public function crearSeparador2($titulo){
        $res = "<table cellspacing=0 cellpadding=0 border=0>" .
                "<tr><td class=\"Titulo-Aplicacion\">$titulo</td></tr>" .
                "<tr><td class=\"Separador_Modulo\"></td></tr>" .
                "<tr><td height=\"5px\"></td></tr>" .
                "</table>";
        
        return $res;
    }
    
    public function obtenerFechaLetras(){
        $fecha = "";
        
        switch (date("w")){
            case "0": $fecha .= "Domingo"; break;
            case "1": $fecha .= "Lunes"; break;
            case "2": $fecha .= "Martes"; break;
            case "3": $fecha .= "Mi&eacute;rcoles"; break;
            case "4": $fecha .= "Jueves"; break;
            case "5": $fecha .= "Viernes"; break;
            case "6": $fecha .= "S&aacute;bado"; break;
        }
        
        $fecha .= ", " . date("j") . " de ";
        
        switch (date("n")){
            case "1": $fecha .= "Enero"; break;
            case "2": $fecha .= "Febrero"; break;
            case "3": $fecha .= "Marzo"; break;
            case "4": $fecha .= "Abril"; break;
            case "5": $fecha .= "Mayo"; break;
            case "6": $fecha .= "Junio"; break;
            case "7": $fecha .= "Julio"; break;
            case "8": $fecha .= "Agosto"; break;
            case "9": $fecha .= "Septiembre"; break;
            case "10": $fecha .= "Octubre"; break;
            case "11": $fecha .= "Noviembre"; break;
            case "12": $fecha .= "Diciembre"; break;
        }
        
        return $fecha .= " de " . date("Y");
    }

    public function crearVentanaInicioTabs($titulo, $alineacion="center"){
        $ventana = "<TABLE width='100%' height='100%' cellSpacing='0' cellPadding='0' border='0'>";
        $ventana .= "   <TR>";
        $ventana .= "       <TD><IMG src='../imagenes/ventanas/vc_esq_izq_sup2.gif'></TD>";
        $ventana .= "       <TD align='$alineacion' class='titulo' background='../imagenes/ventanas/v_back_sup2.jpeg'>".$titulo."</TD>";
        $ventana .= "       <TD><IMG src='../imagenes/ventanas/vc_esq_der_sup2.gif'></TD>";
        $ventana .= "   </TR>";
        $ventana .= "   <TR>";
        $ventana .= "       <TD background='../imagenes/ventanas/v_back_izq.gif'></TD>";
        $ventana .= "       <TD width='100%' height='100%' valign='top'>";
        
        return $ventana; 
    }

    public function crearVentanaInicioPopUp($titulo, $alineacion="center"){
        $ventana = "<TABLE width='100%' height='100%' cellSpacing='0' cellPadding='0' border='0'>";
        $ventana .= "   <TR>";
        $ventana .= "       <TD><IMG src='../imagenes/ventanas/vc_esq_izq_sup_pop.gif'></TD>";
        $ventana .= "       <TD align='$alineacion' class='titulo' background='../imagenes/ventanas/v_back_sup_pop.jpeg'>" . $titulo . "</TD>";
        $ventana .= "       <TD><IMG src='../imagenes/ventanas/vc_esq_der_sup_pop.gif'></TD>";
        $ventana .= "   </TR>";
        $ventana .= "   <TR>";
        $ventana .= "       <TD background='../imagenes/ventanas/v_back_izq_pop.gif'></TD>";
        $ventana .= "       <TD width='100%' height='100%' valign='top'>";
        
        return $ventana; 
    }
    
    public function crearVentanaFinPopUp(){
        $ventana = "        </TD>";
        $ventana .= "       <TD background='../imagenes/ventanas/v_back_der_pop.gif'><IMG src='../imagenes/ventanas/v_back_der_pop.gif'></TD>";
        $ventana .= "   </TR>";
        $ventana .= "   <TR>";
        $ventana .= "       <TD><IMG src='../imagenes/ventanas/v_esq_izq_inf_pop.gif'></TD>";
        $ventana .= "       <TD background='../imagenes/ventanas/v_back_inf_pop.gif'></TD>";
        $ventana .= "       <TD><IMG src='../imagenes/ventanas/v_esq_der_inf_pop.gif'></TD>";
        $ventana .= "   </TR>";
        $ventana .= "</TABLE>";
        
        return $ventana;
    }
    
    public function rutaAplicacion(){
        $ruta = "http://" . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['PHP_SELF']));
        $i = strripos($ruta, "/");

        if($i > 0)
            $ruta = substr($ruta,0,$i+1);

        return $ruta;           
    }

    public function paginaActual(){
        $ruta = $_SERVER['PHP_SELF'];
        $i = strripos($ruta, "/");

        if($i > 0)
            $ruta = substr($ruta,$i+1);

        return $ruta;           
    }
    
    public function convertirFechaDA($fecha)
    {
        if( strlen($fecha) > 8 && trim($fecha)!="" )
	{
            $f = explode("/", $fecha);
            
            if(checkdate($f[1],$f[0],$f[2]))
                return date("m/d/Y", strtotime($f[1] . "/" . $f[0] . "/" . $f[2]));
            else
                return "";
        } else {
                return "";
        }
    }

    public function convertirCaracteresHTML($nombre){
        $nombre = str_replace("á","&aacute;",$nombre);
        $nombre = str_replace("é","&eacute;",$nombre);
        $nombre = str_replace("í","&iacute;",$nombre);
        $nombre = str_replace("ó","&oacute;",$nombre);
        $nombre = str_replace("ú","&uacute;",$nombre);
        $nombre = str_replace("ñ","&ntilde;",$nombre);
        $nombre = str_replace("Á","&Aacute;",$nombre);
        $nombre = str_replace("É","&Eacute;",$nombre);
        $nombre = str_replace("Í","&Iacute;",$nombre);
        $nombre = str_replace("Ó","&Oacute;",$nombre);
        $nombre = str_replace("Ú","&Uacute;",$nombre);
        $nombre = str_replace("ñ","&ntilde;",$nombre);
        
        //$nombre = str_replace("°","&deg;",$nombre);

        return $nombre; 
    }

    public function convertirFechaIngles($fecha){
        $mes = substr($fecha,3,3);

        switch ($mes) {
            case "JAN":
                $res = str_replace("JAN","ENE",$fecha);
            break;
            case "APR":
                $res = str_replace("APR","ABR",$fecha);
            break;
            case "AUG":
                $res = str_replace("AUG","AGO",$fecha);
            break;
            case "DEC":
                $res = str_replace("DEC","DIC",$fecha);
            break;
            default:
                $res = $fecha;
            break;
        }
        
        return $res;
    }
    
    public function formatearCedula($cedula){
        if(trim($cedula)!=""){
            $tam = strlen(trim($cedula));
            
            return substr($cedula,$tam-8,2) . "." . substr($cedula,$tam-6,3) . "." . substr($cedula,$tam-3,3);
        }else
            return $cedula;
    }
    
    public function convertirCedula($cedula, $caracteres){
        $l = strlen($cedula);
        
        for($i = $l; $i <= $caracteres; $i++){
            $cedula = "0" . $cedula;
        }
        
        return $cedula;
    }

    public function crearTabla($datos, $ccsFila1, $ccsFila2){
        $tabla = "";
        $fila = array();
        $actual = "";

        for($i = 0;$i < count($datos);$i++){
            $fila = $datos[$i];

            if($actual != substr($fila["fecha_hora"],0,10))
                $tabla .= "<tr><td class='Detalle'>" . substr($fila["fecha_hora"],0,10) . "</td></tr><tr><td colspan='3' class='linea'></td></tr>";

            $tabla .= "<tr class=";
            if(($i % 2)==0)
                $tabla .= $ccsFila1;
            else
                $tabla .= $ccsFila2;
            $tabla .= ">\n";
            
            $tabla .= "<td></td>";
            
            while(list($clave,$valor)=each($fila))
                $tabla .= "<td>" . $valor . "</td>\n";

            $tabla .= "</tr>\n";
        
            $actual = substr($fila["fecha_hora"],0,10);
        }
        
        return $tabla;
    }

    public function crearTablaRoles($datos, $ccsFila1, $ccsFila2){
        $tabla = "";
        $c = count($datos);
        $i=0;
        
        $tabla .= "<tr><td height=5px></td></tr>\n";
		
        for($i=0; $i<$c; $i++){
            $tabla .= "<tr class=";
            if(($i % 2)==0)
                $tabla .= $ccsFila1;
            else
                $tabla .= $ccsFila2;
            $tabla .= ">\n";
			
			$tabla .= "<td>" .
					  "<a href=\"javascript:cargarValor('" . $datos[$i]["id"] . "','" . $datos[$i]["codigo_rol"] . "');\">" .
					  "   <img src='../imagenes/icon1.gif'>" .
					  "</a>" .
					  "</td>";
			$tabla .= "<td>" . $datos[$i]["id"] . "</td>";
            $tabla .= "<td>" . $datos[$i]["rol"] . "</td>";

			$tabla .= "<td>";
					
			if($datos[$i]["bloqueado"]==1){
	 			$tabla .= "<a href=\"javascript:desbloquear('" . $datos[$i]["id"] . "');\">" .
					  	"   <img src='../imagenes/menos.gif' title='Desbloquear'>" .
					  	"</a>";
			}
					  
			$tabla .= "</td>" .
					  "<td width='20px'></td>";

			$tabla .= "<td>" .
					  "<a href=\"javascript:eliminarRol('" . $datos[$i]["id"] . "');\">" .
					  "   <img src='../imagenes/delete.png'>" .
					  "</a>" .
					  "</td>";
            
            $tabla .= "</tr>\n";
            
            $tabla .= "<tr><td class=linea colspan=6></td></tr>";
        }

        return $tabla;
    }
	    
    public function crearComboArray($datos, $sel){
        $combo = "";
        $fila = "";
        $filas = count($datos);
        
        for($i = 0; $i < $filas; $i++){
            if($sel == $datos[$i])
                $combo .= "<option selected ";
            else
                $combo .= "<option ";
                
            $combo .= "value=\"" . $datos[$i] . "\">" . $datos[$i] . "</option>\n";
        }
        
        return $combo;
    }

    public function crearCombo($datos, $colValor, $colTexto, $sel="", $primero = ""){
        $combo = "";
        $fila = "";

        if(isset($primero) && $primero!="") $combo .= "<option value='".$primero."'></option>";
        
        $filas = count($datos);
        
        for($i = 0; $i < $filas; $i++){
            $fila = $datos[$i];

            if($sel==$fila[$colValor])
                $combo .= "<option selected ";
            else
                $combo .= "<option ";
                
            $combo .= "value=\"" . $fila[$colValor] . "\">" . $fila[$colTexto] . "</option>\n";
        }
        
        return $combo;
    }

    function formatearNumero($numero, $decimales=2){
        return number_format($numero, $decimales, ".", "");
    }

    function formatearSeparadorDecimales($numero){
        return str_replace(".", ",", $numero);
    }

    function formatearMoneda($numero){
        return number_format($numero, 2, ",", ".");
    }

    function convertirStringFloat($numero){
        $ret = 0;
        
        $ret = str_replace(",", ".", $numero);
        $ret = (float) $ret;
        
        return $ret;
    }

    function formatearDecimalesGrafico($numero, $cantidad = 0){
        $coma = strpos($numero, ".");

        if($coma === false){
            $numero = $numero . ".0";
            $coma = strpos($numero, ".");
        }

        $numero = str_replace(".", ",", $numero);
            
        return substr($numero, 0, $coma + 1 + $cantidad);
    }

    function formatearDecimales($numero, $cantidad = 5, $separador = ","){
        $coma = strpos($numero, $separador);
        
        return substr($numero,0, $coma + $cantidad + 1);
    }

    function dateDiff($fechaInicio, $fechaFin){
        $f = explode("-", $fechaInicio);
        $f1 = mktime(0, 0, 0, $f[1], $f[0], $f[2]);

        $f = explode("/", $fechaFin);
        $f2 = mktime(0, 0, 0, $f[1], $f[0], $f[2]);
        
        $d = round(($f2-$f1)/86400,0);
        
        return $d;
    }

    function dateTimeDiff( $fechaInicio, $fechaFin )
    {
	$f = strtotime( $fechaInicio );
	$f1 = mktime( date( "H", $f ), date( "i", $f ), date( "s", $f ), date( "n", $f ), date( "j", $f ), date( "Y", $f ) );

        $f = strtotime( $fechaFin );
	$f2 = mktime( date( "H", $f ), date( "i", $f ), date( "s", $f ), date( "n", $f ), date( "j", $f ), date( "Y", $f ) );

        $d = round( ( $f1-$f2 ) / 60 );
        
        return $d;
    }

    function obtenerFechaGrafico($fecha){
        $f = explode("/", $fecha);
        $f = mktime(0, 0, 0, $f[1], $f[0], $f[2]);
        
        switch(date("m", $f)){
            case 1: 
                $mes = "Ene";
                break; 
            case 2: 
                $mes = "Feb";
                break; 
            case 3: 
                $mes = "Mar";
                break; 
            case 4: 
                $mes = "Abr";
                break; 
            case 5: 
                $mes = "May";
                break; 
            case 6: 
                $mes = "Jun";
                break; 
            case 7: 
                $mes = "Jul";
                break; 
            case 8: 
                $mes = "Ago";
                break; 
            case 9: 
                $mes = "Sep";
                break; 
            case 10: 
                $mes = "Oct";
                break; 
            case 11: 
                $mes = "Nov";
                break; 
            case 12: 
                $mes = "Dic";
                break; 
        }
        
        
        return date("d", $f) . "-" . $mes;
    }

    function obtenerFechaActual(){
        return date("d") . "/" . date("m") . "/" . date("Y");
    }

    function obtenerFechaHoraActual(){
        return $this->obtenerFechaActual() . " " . date("h") . ":" . date("i") . ":" . date("s") . " " . date("a");
    }
    
    function dateSum($fecha, $dias){
        $f = explode("/", $fecha);
        $f1 = mktime(0, 0, 0, $f[1], $f[0], $f[2]);

        $d = date("d/m/Y", mktime(0, 0, 0, date("m", $f1)  , (date("d", $f1) + $dias), date("Y", $f1)));
        
        return $d;
    }

    //1 para Lunes
    function diaSemana($fecha){
        $f = explode("/", $fecha);
        $f1 = mktime(0, 0, 0, $f[1], $f[0], $f[2]);

        $d = date("N", mktime(0, 0, 0, date("m", $f1)  , date("d", $f1), date("Y", $f1)));
        
        return $d;
    }

    public function separador(){
    	return "<tr>" .
                "<td width=\"75px\"></td>" .
                "<td width=\"125px\"></td>" .
                "<td width=\"75px\"></td>" .
                "<td width=\"135px\"></td>" .
                "<td width=\"75px\"></td>" .
                "<td width=\"105px\"></td>" .
                "</tr>";
    }

    public function separadorReporte(){
        return "\n<tr>" .
        		"<td width=\"100px\"></td>" .
        		"<td width=\"140px\"></td>" .
        		"<td width=\"100px\"></td>" .
        		"<td width=\"140px\"></td>" .
        		"<td width=\"100px\"></td>" .
        		"<td width=\"100px\"></td>" .
        		"</tr>";
    }

	function puntosCadena($cadena){
	    $largo = strlen($cadena);
		if ($largo > 18)
		   $cadena = substr($cadena,0,18) . "...";
					
		return $cadena;
	}

    public function crearComboArray2($datos, $sel){
        $combo = "";
        $fila = "";
		$filas = count($datos);
		
        for($i = 0; $i < $filas; $i++){
            if($sel == $datos[$i][0])
            	$combo .= "<option selected ";
            else
            	$combo .= "<option ";
            	
            $combo .= "value=\"" . $datos[$i][0] . "\">" . $datos[$i][1] . "</option>\n";
        }
        
        return $combo;
    }

	public function crearTablaGeneral($datos, $ccsFila1, $ccsFila2, $seleccionar=true, $eliminar=true){
    	$tabla = "";
		$cel = "";
        $fila = array();
		$c = count($datos);
		$codigo = "";
		
		for($i=0; $i<$c; $i++){
			$fila = $datos[$i];
			$j = 0;

			$tabla .= "<tr class=";
            if(($i % 2)==0)
                $tabla .= $ccsFila1;
            else
                $tabla .= $ccsFila2;
            $tabla .= ">\n";

			while(list($clave,$valor)=each($fila)){
				if($j==0 && $seleccionar){
					$codigo = $valor;
					$tabla .= "<td height='14px'><a href=\"javascript:doPostBackValor('form1','txtCodigo',$codigo)\"><img src=\"../imagenes/icon1.gif\" border=\"0\"></a></td>\n";
				}else{
					$tabla .= "<td>$valor</td>\n";
				}

				$j++;
			}
			
			if($eliminar){
				$tabla .= "<td valign='middle'>" .
						"<a href=\"javascript:eliminarCampo('txtAccion','e','form1','txtCodigo',$codigo)\">" .
						"<img src=\"../imagenes/x.gif\" border=\"0\">" .
						"</a></td>\n";
				$tabla .= "</tr>\n";
			}

			$j=$j+2;
			$tabla .= "<tr><td class=\"linea\" colspan=$j></td></tr>\n";
		}
		
        return $tabla;
    }
    
    function crearTablaLog($datos, $ccsFila1, $ccsFila2){
    	$c = count($datos);
    	$tabla = "";
    	
    	for($i=0; $i<$c; $i++){
			$tabla .= "<tr class=";
            if(($i % 2)==0)
                $tabla .= $ccsFila1;
            else
                $tabla .= $ccsFila2;
            $tabla .= ">\n";
    		
    		$tabla .= "<td>" . $datos[$i] . "</td>";
    		
    		$tabla .= "</tr>";
    	}
    	
    	return $tabla;
    }
	
	function formatearURLRel($url){
		$url = str_replace(array(" "), array("%20"), $url);
		$url = urlencode($url);
			
		return $url;
	}

	function formatearURL($url){
		$url = urlencode($url);
			
		return $url;
	}
	
    public function crearTablaEstructura($datos, $ccsFila1, $ccsFila2){
        $tabla = "";
        $c = count($datos);
        $i=0;
        
        $tabla .= "<tr><td height=5px></td></tr>\n";
		
        for($i=0; $i<$c; $i++){
            $tabla .= "<tr class=";
            if(($i % 2)==0)
                $tabla .= $ccsFila1;
            else
                $tabla .= $ccsFila2;
            $tabla .= ">\n";

			$tabla .= "<td>" .
					  "<a href=\"javascript:cargarValor('" . $datos[$i]["codigo_estructura"] . "','" . urlencode($datos[$i]["codigo_padre"]) . "','" . $datos[$i]["carpeta"] . "','" . $datos[$i]["nombre"] . "','" . $datos[$i]["principal"] . "','" . $datos[$i]["orden"] . "');\">" .
					  "   <img src='../imagenes/icon1.gif'>" .
					  "</a>" .
					  "</td>";
			$tabla .= "<td width=200px>&nbsp;" . $this->puntosCadena($datos[$i]["codigo_estructura"]) . "</td>";
            $tabla .= "<td width=150px>" . $this->puntosCadena($datos[$i]["codigo_padre"]) . "</td>";
			$tabla .= "<td width=100px>" . $this->puntosCadena($datos[$i]["carpeta"]) . "</td>";
			$tabla .= "<td width=150px>" . $datos[$i]["nombre"] . "</td>";
			
			$tabla .= "<td>";
					
			/*if($datos[$i]["bloqueado"]==1){
	 			$tabla .= "<a href=\"javascript:desbloquear('" . $datos[$i]["id"] . "');\">" .
					  	"   <img src='../imagenes/menos.gif' title='Desbloquear'>" .
					  	"</a>";
			}*/
					  
			$tabla .= "</td>" .
					  "<td width='20px'></td>";

			$tabla .= "<td>" .
					  "<a href=\"javascript:eliminarEstructura('" . $datos[$i]["codigo_estructura"] . "');\">" .
					  "   <img src='../imagenes/delete.png'>" .
					  "</a>" .
					  "</td>";
            
            $tabla .= "</tr>\n";
            
            $tabla .= "<tr><td class=linea colspan=6></td></tr>";
        }

        return $tabla;
    }

	
	function pg_array_parse( $text, &$output, $limit = false, $offset = 1 )
	{
	  if( false === $limit )
	  {
	    $limit = strlen( $text )-1;
	    $output = array();
	  }
	  if( '{}' != $text )
	    do
	    {
	      if( '{' != $text{$offset} )
	      {
		preg_match( "/(\\{?\"([^\"\\\\]|\\\\.)*\"|[^,{}]+)+([,}]+)/", $text, $match, 0, $offset );
		$offset += strlen( $match[0] );
		$output[] = ( '"' != $match[1]{0} ? $match[1] : stripcslashes( substr( $match[1], 1, -1 ) ) );
		if( '},' == $match[3] ) return $offset;
	      }
	      else  $offset = pg_array_parse( $text, $output[], $limit, $offset+1 );
	    }
	    while( $limit > $offset );
	  return $output;
	}
}
?>
