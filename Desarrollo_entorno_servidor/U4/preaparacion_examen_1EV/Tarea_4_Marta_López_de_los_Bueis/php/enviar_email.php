1 <?php 
/*
 * Alias del espacio de nombres de PHPMailer
 * La directiva "use" al principio del script crea un alias para las clases
 * PHPMailer y PHPException
 */ 
 	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
  	use PHPMailer\PHPMailer\SMTP;

 /*
  * Incluir el fichero autoload.php de Composer que 
  * se encarga de incluir las librerías PHPMailer
  */
 	require 'c:/xampp/composer/vendor/phpmailer/phpmailer/src/Exception.php';
 	require 'c:/xampp/composer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
 	require 'c:/xampp/composer/vendor/phpmailer/phpmailer/src/SMTP.php';
 	require "c:/xampp/composer/vendor/autoload.php";

	
    
	require_once "conexion_bd.php";
	try {
 
		$conexionBD = new ConectarBaseDeDatos();
		$base_de_datos = $conexionBD->getConexion();
		
	} catch (Exception $e) {
		 echo "Error: " . $e->getMessage();
	}
	
	
  	

	//$facturaHTML es un string formateado con html que contiene los productos del carrito
	//enviar dos correos distintos uno al departamento y al destinatario (mismo mensaje)

	function enviarEmail(string $destinatario, string $facturaHTML){

		$mail = new PHPMailer(TRUE);
		$mail->IsSMTP();
		// cambiar a 0 para no ver mensajes de error
		$mail->SMTPDebug  = 0; 	//el 2 muestra por pantalla trazas del mail luego cambiar a 0 para quitarlos						
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "tls"; //ssl                
		$mail->Host       = "smtp.gmail.com";    
		$mail->Port       = 587; //465                
		// introducir usuario de google
		$mail->Username   = "dawiesventura@gmail.com"; 
		// introducir clave
		$mail->Password   = "nnli oyoa game qmoc";   	
		$mail->SetFrom('dawiesventura@gmail.com', 'Empresa de papeleria');
		// asunto
		$mail->Subject    = "Resumen de tu pedido";
		// cuerpo
		$mail->MsgHTML($facturaHTML);
		// adjuntos
		//$mail->addAttachment("empleado.xsd");
		//$mail->addAttachment("error.html");

		// $destinatario (este address es mi correo personal para comprobar que si se envian los correos
		// cuando se quiera enviar al correo que se indique en la base de datos, debemos poner $destinatario)
		$address = "marta21700@gmail.com";
		$mail->AddAddress($address, "Prueba");
		//$mail->IsHTML(true);
		// enviar
		$resul = $mail->Send();
		if(!$resul) {
		echo "Error" . $mail->ErrorInfo;
		} else {
		echo "Enviado";
		}
	  
	}

 	