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

	 session_start();
    
	try{
		$datos_conexion="mysql:dbname=mydb;host=127.0.0.1";
	 	$administrador="root";
	 	$pw="";
		 
	 	$base_de_datos=new PDO($datos_conexion,$administrador,$pw);
 
	 	/*Introducir datos de la conexion con la base de datos */
 
	}catch(PDOException $e){
		echo "<p>Error con la base de datos: </p>".$e->getMessage();
	}

	$consultaUpgradeEstadoCarrito= $base_de_datos->prepare("UPDATE carrito 
                                                        	SET estado_carrito =  'completado'
                                                        	WHERE id_carrito = :id_carrito");

	$consultaUpgradeEstadoCarrito->execute();

	/*
 	$mail = new PHPMailer(TRUE);
 	$mail->IsSMTP();
 	// cambiar a 0 para no ver mensajes de error
 	$mail->SMTPDebug  = 2; 							
 	$mail->SMTPAuth   = true;
 	$mail->SMTPSecure = "tls"; //ssl                
	$mail->Host       = "smtp.gmail.com";    
	$mail->Port       = 587; //465                
	// introducir usuario de google
	$mail->Username   = "dawiesventura@gmail.com"; 
	// introducir clave
	$mail->Password   = "nnli oyoa game qmoc";   	
	$mail->SetFrom('dawiesventura@gmail.com', 'Mercedes Profe');
	// asunto
	$mail->Subject    = "Resumen de tu pedido";
	// cuerpo
	$mail->MsgHTML('Factura');
	// adjuntos
	//$mail->addAttachment("empleado.xsd");
	//$mail->addAttachment("error.html");
	// destinatario
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
	  */