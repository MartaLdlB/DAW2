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
    if($_SERVER["REQUEST_METHOD"]=="POST"){     
            $error;
            if($_POST["usuario"]==="marta" && $_POST["pw"]==="1234"){
                $_SESSION["usuario"] =$_POST["usuario"]; // Guardamos el nombre de usuario en la sesión
                header("Location: sesiones1_login.php");
            }elseif(($_POST["usuario"]==="admin" && $_POST["pw"]==="1234")){
                $_SESSION["usuario"] =$_POST["usuario"]; // Guardamos el nombre de usuario en la sesión
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