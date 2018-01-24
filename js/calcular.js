function calcular(tabla,res_si,resp_no, fila,preg){

 number_format($count_fullup/($num)*100,1)
 
 
if (formulario.usuario.value == "")
{ alert("Por favor ingrese su indicador de usuario"); 
  formulario.usuario.focus(); 
  return false;
  }

if (formulario.password.value == "")
{ alert("Por favor ingrese su contraseña"); 
	formulario.password.focus();
 	return false; 
 }

if (formulario.usuario.value  != "" && formulario.password.value != "")
	{	document.formulario.action="../santp2/controlador/ControladorLogin.php";
		formulario.submit();
	}
}

