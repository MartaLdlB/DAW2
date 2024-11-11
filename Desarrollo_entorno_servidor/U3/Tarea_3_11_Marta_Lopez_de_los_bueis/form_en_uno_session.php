<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea 3_8 Controlador de una sesion</title>
    <style>
          html, body {
            margin: 0px;
            padding: 0px;
        }

        .contenedor {
            background-image: url(https://i.pinimg.com/originals/86/6f/30/866f30792413dcb70ce06c91c1ad3f4e.gif);
            display: flex; /* Usar Flexbox */
            justify-content: center; /* Centrar horizontalmente */
            align-items: center; /* Centrar verticalmente */
            height: 100vh; /* Hacer que el contenedor ocupe toda la altura de la ventana */
          background-repeat: no-repeat;
            background-size: cover;
        }

        .form {
            background-color: rgba(98, 0, 255, 0.6);
            padding: 30px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            width: 300px; /* Ancho del formulario */
            height: 500px; /* Alto automático para ajustar al contenido */
            display: flex; /* Usar Flexbox en el formulario */
            flex-direction: column; /* Alinear los elementos en columna */
            align-items: center; /* Centrar horizontalmente los elementos del formulario */
            border-radius: 40px;
            font-weight: bold;/*Ponemos la letras en negrita*/
            color: white;
        }
        form{
            padding-top:145px ;
        }

        /* Estilo adicional para los inputs y el botón */
        input[type="text"], input[type="password"] {
            width: 90%; /* Ajustar el ancho de los campos de entrada */
            padding: 10px; /* Agregar espaciado interno */
            margin: 10px 0; /* Espaciado entre los campos */
            border-radius: 40px;
        }

        input[type="submit"] {
            width: 100%; /* Hacer que el botón ocupe todo el ancho */
            padding: 10px; /* Espaciado interno */
            background-color: darkblue; /* Color de fondo del botón */
            color: white; /* Color del texto del botón */
            border: none; /* Sin borde */
            cursor: pointer; /* Cambiar el cursor al pasar por encima */
            border-radius: 40px;
            transition: transform 0.3s, box-shadow 0.3s;
            
        }

        input[type="submit"]:hover {
            transform: scale(1.1);
            background-color: rgb(0, 0, 73); /* Cambiar color al pasar el ratón */
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <div class="form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="usuario">Introduce tu nombre de usuario: </label><br>
                <input type="text" name="usuario"><br>
                <label for="pw">Introduce tu contraseña: </label> <br>
                <input type="password" name="pw"><br><br>
                <input type="submit" value="Enviar"><br><br>
                </form>
            </div>
    </div>
    
    <?php
     session_start(); //crea una sesion 

    $datos_conexion="mysql:dbname=empresa;host=127.0.0.1";
    $administrador="root";
    $pw="";
        
    $datosValidos; //boolean que nos indica si los datos introducidos por el usuario son correctos dentro de la base de datos
    
    //conexion con la base de datos
    $base_de_datos= new PDO($datos_conexion,$administrador,$pw);

    $consulta=$base_de_datos->prepare("SELECT nombre, clave 
                                        FROM usuarios
                                        WHERE nombre = :nombre 
                                        AND clave = :clave");
    //variable no inicializada para usarla con "isset()" para detectar si hay un error o no
    $error;
    if($_SERVER["REQUEST_METHOD"]=="POST"){ 

        
            //guardamos en una variable los datos del usuario que recibimos en el login
            $usr=$_POST['usuario'];
            $password=$_POST["pw"];
            
            /*
            Tenemos que indicarle a la consulta que valores tendran ":nombre" y
            ":clave", los cuales son los que hemos extraido del POST del formulario
            y se deben definir de la siguiente forma:
            */
            $consulta -> bindParam(":nombre", $usr, PDO::PARAM_STR); //PDO::PARAM_STR se usa para indicar que un parámetro de una consulta SQL debe tratarse como una cadena de texto (string).
            $consulta -> bindParam(":clave", $password, PDO::PARAM_STR);

            $consulta->execute();

            //en el momento en el que encuentre 1 igual al los datos de entrada del usuario,
            //lo marca como TRUE, en el caso de no encontrar nada lo marca como FALSE, que seria que no se encuentra en la base de datos
            $datosValidos = ($consulta->rowCount() == 1) ? true : false;

            if($datosValidos==true){
                header("Location: sesiones1_login.php");
            }else{
                $error=true;
            }

            if (isset($error)) {
                // Mensaje de error y aviso por pantalla incrustado en HTML
                echo "<br><p>¡Error! Verifica el usuario y la contraseña";
            
            }
    }
    ?>

</body>
</html>