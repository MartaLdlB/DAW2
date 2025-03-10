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

	function send_mail(string $message, string $address) {

		$mail = new PHPMailer(TRUE);
		$mail->IsSMTP();
		// cambiar a 0 para no ver mensajes de error
		$mail->SMTPDebug  = 0; 							
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = "tls"; //ssl                
		$mail->Host       = "smtp.gmail.com";    
		$mail->Port       = 587; //465                
		// introducir usuario de google
		$mail->Username   = "dawiesventura@gmail.com"; 
		// introducir clave
		$mail->Password   = "nnli oyoa game qmoc";   	
		$mail->SetFrom('dawiesventura@gmail.com', 'Materiales de oficina Aitor');
		// asunto
		$mail->Subject    = "Datos del pedido";
		// cuerpo
		$mail->MsgHTML($message);
		// adjuntos
		//$mail->addAttachment("hola.txt"); //archivo mando
		// destinatario
		//$address = "aitorpj93@gmail.com";
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