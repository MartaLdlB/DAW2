<?php
     session_start(); //crea una sesion 
    
     $datos_conexion="mysql:dbname=empresa;host=127.0.0.1";
     $administrador="root";
     $pw="";
         
     $base_de_datos=new PDO($datos_conexion,$administrador,$pw);

     /*Introducir datos de la conexion con la base de datos */

    $consulta=$base_de_datos->prepare("SELECT correo, contrasenia
                                        FROM credenciales
                                        WHERE correo = :correo 
                                        AND contrasenia = :contrasenia");
    //variable no inicializada para usarla con "isset()" para detectar si hay un error o no
    $error;
    if($_SERVER["REQUEST_METHOD"]=="POST"){ 

        
            //guardamos en una variable los datos del usuario que recibimos en el login
            $usuario=$_POST['correo'];
            $contrasenia=$_POST["contrasenia"];
            

             //indicamos que tipo de datos le estamos dando en la consulta
            $consulta -> bindParam(":correo", $usuario, PDO::PARAM_STR); 
            $consulta -> bindParam(":contrasenia", $contrasenia, PDO::PARAM_STR);

            //ejecutamos la consulta
            $consulta->execute();

            //en el momento en el que encuentre 1 igual al los datos de entrada del usuario,
            //lo marca como TRUE, en el caso de no encontrar nada lo marca como FALSE, que seria que no se encuentra en la base de datos
            $datosValidos = ($consulta->rowCount() == 1);

            if($datosValidos==true){
                header("Location: index.php");
            }else{
                $error=true;
            }

            if (isset($error)) {
                // Mensaje de error y aviso por pantalla incrustado en HTML
                echo "<br><p>¡Error! Verifica el usuario y la contraseña</p>";
            
            }
    }
    ?>