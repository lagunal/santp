<?php 
 
/**
 * Implementa el consumo de los servicios web para envio de correo electronico.<br>
 * Garantiza interoperatividad entre distintos agentes/clientes de consumo.<br>
 * Hace uso de la libreria nativa PEAR::SOAP para la comunicacion.<br>
 *
 * @package    ClienteSoCorreo
 * @filesource
 * @version    0.1
 * @date       15/01/2012
 * @author     Juan Cisneros
 *
 */


/**
 * Clase clienteSoCorreo
 * Clase cliente de envio de correo
 */
 
class clienteSoCorreo{

	private $wsdl;	
	
	 /**
	 *
	 * Constructor de la clase.<br>
	 * @param string $wsdl, url al archivo wsdl de descripcion del servicio web.
	 *
	*/
	public function __construct($wsdl){
	
		$this->wsdl	=	$wsdl;
	}
	
	
	   
	/**
	* Metodo para el envio de correo electronico simple.<br>
   * Valida si la aplicacion tiene permisologia para enviar correo electronico.<br>
   * Registra en el log de transacciones la aplicacion solicitante   	 
	* @param string $aplicacion hash(nombre de la aplicacion solicitante)
	* @param string $asunto Asunto del correo electronico
	* @param string $para Direccion(es) de correo(s) electronico(s) (ej: xyz@pdvsa.com) o Multiples correos (Ej: ej: xxxx@pdvsa.com; yyyy@pdvsa.com, yynombre yyapellido; zzz@pdvsa.com)
	* @param string $mensaje Mensaje en texto enriquecido (HTML)
	* @return ObjectSoapClient stdClass  $object->codigoMensaje , $object->descripcion
	* <br><pre>Posibles valores de retorno:	
	*    -- 'codigoMensaje'=>'01','descripcion'=>'Correo enviado satisfactoriamente.'
	*    -- 'codigoMensaje'=>'02','descripcion'=>'Correo no enviado satisfactoriamente.'
	*    -- 'codigoMensaje'=>'03','descripcion'=>'Excedido la cantidad de destinatarios permitidos.'
	*    -- 'codigoMensaje'=>'04','descripcion'=>'Aplicacion no registrada.'</pre>
	*/    
    public function enviarCorreoElectronico($aplicacion, $asunto, $para, $mensaje){ 
  
         
		     $ip	=	$this->getIp();   
		     $client	=	new SoapClient($this->wsdl);						
			  
			  $parametros =  array(
							"aplicacion" => $aplicacion,
							"ip"=> $ip,		               
		               "asunto" => $asunto,		            
		            	"para" => $para,             
		              	"mensaje"=> $mensaje);
		           
				$resultado =	$client->__call("SoCorreo.enviarCorreoElectronico",$parametros);
						
				return $resultado;	
								
	
		
		
  }	  
  
  	/**
	* Metodo para el envio de correo electronico avanzado.<br>
   * Valida si la aplicacion tiene permisologia para enviar correo electronico.<br>
   * Registra en el log de transacciones la aplicacion solicitante   	 
	* @param string $aplicacion hash(nombre de la aplicacion solicitante)	
	* @param string $asunto Asunto del correo electronico
	* @param string $para Direccion(es) de correo(s) electronico(s) (ej: xyz@pdvsa.com) o Multiples correos (Ej: ej: xxxx@pdvsa.com; yyyy@pdvsa.com, yynombre yyapellido; zzz@pdvsa.com)
	* @param string $cc Direccion(es) de correo(s) electronico(s) (ej: xyz@pdvsa.com) o Multiples correos (Ej: ej: xxxx@pdvsa.com; yyyy@pdvsa.com, yynombre yyapellido; zzz@pdvsa.com)
	* @param string $cco Direccion(es) de correo(s) electronico(s) (ej: xyz@pdvsa.com) o Multiples correos (Ej: ej: xxxx@pdvsa.com; yyyy@pdvsa.com, yynombre yyapellido; zzz@pdvsa.com)
	* @param string $mensaje Mensaje en texto enriquecido (HTML)
	* @return ObjectSoapClient stdClass  $object->codigoMensaje , $object->descripcion
	* <br><pre>Posibles valores de retorno:	
	*    -- 'codigoMensaje'=>'01','descripcion'=>'Correo enviado satisfactoriamente.'
	*    -- 'codigoMensaje'=>'02','descripcion'=>'Correo no enviado satisfactoriamente.'
	*    -- 'codigoMensaje'=>'03','descripcion'=>'Excedido la cantidad de destinatarios permitidos.'
	*    -- 'codigoMensaje'=>'04','descripcion'=>'Aplicacion no registrada.'</pre>
	*/    
     public function enviarCorreoElectronicoMultiple($aplicacion, $asunto, $para, $cc, $cco, $mensaje){ 
  
         
		     $ip	=	$this->getIp();   
		     $client	=	new SoapClient($this->wsdl);						
			  
			  $parametros =  array(
							"aplicacion" => $aplicacion,
							"ip"=> $ip,		               
		               "asunto" => $asunto,		            
		            	"para" => $para,
		            	"cc" => $cc,             
		            	"cco" => $cco,                          
		              	"mensaje"=> $mensaje);
		           
				$resultado =	$client->__call("SoCorreo.enviarCorreoElectronicoMultiple",$parametros);
						
				return $resultado;	
								
	
		
		
  }	  
  
  
	 /**
		* Metodo para obtener la direccion Ip de la maquina solicitante del servicio web.<br>
   	* Filtra Ip real del equipo, saltando proxy intermedios.<br>
		* @return string $client_ip direccion ip de la maquina solicitante del servicio web
		*/ 
	  private function getIp()
	  {
	   
	   if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) &&( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' ))
	   {
	      $client_ip =
	         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
	            $_SERVER['REMOTE_ADDR']
	            :
	            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
	               $_ENV['REMOTE_ADDR']
	               :
	               "unknown" );
	   
	      // los proxys van añadiendo al final de esta cabecera
	      // las direcciones ip que van "ocultando". Para localizar la ip real
	      // del usuario se comienza a mirar por el principio hasta encontrar
	      // una dirección ip que no sea del rango privado. En caso de no
	      // encontrarse ninguna se toma como valor el REMOTE_ADDR
	   
	      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
	   
	      reset($entries);
	      while (list(, $entry) = each($entries))
	      {
	         $entry = trim($entry);
	         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
	         {
	            // http://www.faqs.org/rfcs/rfc1918.html
	            $private_ip = array(
	                  '/^0\./',
	                  '/^127\.0\.0\.1/',
	                  '/^192\.168\..*/',
	                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
	                  '/^10\..*/');
	   
	            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
	   
	            if ($client_ip != $found_ip)
	            {
	               $client_ip = $found_ip;
	               break;
	            }
	         }
	      }
	   }
	   else
	   {
	      $client_ip =
	         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
	            $_SERVER['REMOTE_ADDR']
	            :
	            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
	               $_ENV['REMOTE_ADDR']
	               :
	               "unknown" );
	   }
	   
	   return $client_ip;
	   
	}


}
?>
