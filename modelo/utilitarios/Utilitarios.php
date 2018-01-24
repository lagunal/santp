<?php
Class Utilitarios
{
	public function __construct()
	 {					 }
	
	 public function direccionarPagina2($paginaDestino)
	 {
	    
		header("location:../presentacion/".$paginaDestino);
	 } 
	 public function direccionarPagina($paginaDestino)
	 {
		header("location:../presentacion/".$paginaDestino);			
	 }
	 public static function StdireccionarPagina($paginaDestino)
	 {
	 	header("location:../presentacion/".$paginaDestino);
	 }
	 public function direcPaginaLogin()
	 {
		header("location:../presentacion/acceso.php");	
		
	 }
	 //direccionar paginas controladoras
	  public function direcPaginasControl($paginaDestino)
	 {
		header("location:../controlador/".$paginaDestino);	
		
	 }
	  // funcion para crear textbox de tipo generico
	 public static function crearSubTitulo($subTitulo)
	 {	
		echo '<tr bgcolor="#D6D6DD">';
        echo	'<td height="14" colspan="6" align="right" class="contBold1" ><div align="center" class="ventana_tit">'.$subTitulo.'</div></td>';
        echo '</tr>';
		echo '<tr>';
        echo   	'<td height="14" align="right" class="contBold1" ><div align="left"></div></td>';
        echo	'<td height="14" colspan="6"  class="contBold1" align="center">&nbsp;</td>';
        echo '</tr>';	
		 	
	 }

	
	public static function LimpiarSesion()
	{
		$usuarioValido=$_SESSION["usuarioValido"];		
		$nombreApellido=$_SESSION["nombreApellido"];
		$cedula=$_SESSION["cedula"];
		$indicador=$_SESSION["indicador"];
		$idUsuario=$_SESSION["idUsuario"];
		
		//borra todas las variables de sesion
		session_unset();
		
		$_SESSION["usuarioValido"]=$usuarioValido;		
		$_SESSION["nombreApellido"]=$nombreApellido;
		$_SESSION["cedula"]=$cedula;
		$_SESSION["indicador"]=$indicador;
		$_SESSION["idUsuario"]=$idUsuario;
		
	} 
	
}

?>