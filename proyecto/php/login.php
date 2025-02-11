<?php

//login  FALTA EL MENSAJE DE ERROR
require_once "consultas_bd.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recogemos los datos del formulario de forma segura
    $dato_nombre=  $_POST['correo']; //almacenamos el dato que nos da el usuario, ya sea correo o nick
    $contrasenia = $_POST['contrasenia'];

    //comprobamos si el usuario existe con una funcion fuera de este script, almacenado en consultas.php,
    //añadimos require_once consultas.php para poder usar las funciones que se almacenan alli
    if(comprobarCorreo()){ //en el caso de recibir un true entramos en el bucle
                            //indica que el usuario quiere acceder con el email
        if(consultaLogin($usuario, $contrasenia)){
            header("Location: /vista/principal.html");
        }else {
            // Credenciales inválidas
            $error = true;
        }
    } else {
        //en el caso de que recibamos un false, indica que el usuario esta iniciando sesion con un nick o algo que no es un correo
        if(consultaLogin($usuario, $contrasenia)){
            header("Location: /vista/principal.html");
        }else {
            // Credenciales inválidas
            $error = true;
        }
    }

    }






?>