<?php

//consulta para registro de usuarios

function registrarUsuario($nombre_usuario, $apellido_usuario, $nick_usuario, $correo_usuario, $fecha_nacimiento_usuario){

    //falta consulta para comprobar la existencia del correo en la base de datos
    //Falta consulta para comprobar que el nick elegido no exista ya en la base de datos


    $consulta = $base_de_datos -> prepare(
        "INSERT INTO usuarios
        VALUES (:nombre_usuario, :apellido_usuario, :nick_usuario, :correo_usuario, :fecha_nacimiento_usuario
        )");
}
