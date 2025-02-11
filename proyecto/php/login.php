<?php

//login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recogemos los datos del formulario de forma segura
    $usuario =  $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];

    //comprobamos si el usuario existe con una funcion fuera de este script, almacenado en consultas.php,
    //añadimos require_once consultas.php para poder usar las funciones que se almacenan alli
    
        //$esUsuarioExistente = consultaLogin($usuario, $contrasenia);
        if(consultaLogin($usuario, $contrasenia)){
            header("Location: /vista/principal.php");
        }else {
            // Credenciales inválidas
            $error = true;
        }
    } else {
        $error = false;
    }






?>