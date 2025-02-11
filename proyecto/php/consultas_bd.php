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

function comprobarCorreo($dato_nombre){
    $esCorreo = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if (preg_match($esCorreo, $dato_nombre)) {
        return true; //en el caso de que el correo este correcto
    } else {
        return false; //en el caso de no estar correctamente escrito
    }
}


//obtener lista con todos los nicks de la base de datos

function obtenerTodosNicks(){
    $nicks = $base_de_datos -> prepare("SELECT nick_usuario 
                                                FROM usuarios");
    $nicks->execute();
    $lista_nicks=$nicks->fetchAll(PDO::FETCH_ASSOC);
    return $lista_nicks;
}

//obtener lista con todos los emails de la base de datos

function obtenerTodosEmail(){
    $emails = $base_de_datos -> prepare("SELECT correo_usuario 
                                                FROM usuarios");
    $emails->execute();
    $lista_email=$emails->fetchAll(PDO::FETCH_ASSOC);
    return $lista_nicks;
}

//registrar usuario en la base de datos

function registrarUsuario($nombre_usuario,$apellido_usuario,$fecha_nacimiento_usuario,$nick_usuario,$correo_usuario,$contrasenia_usuario){
     // Hashear la contraseña para seguridad
    $hashed_contrasenia = password_hash($contrasenia_usuario, PASSWORD_DEFAULT);

     // Insertar nuevo usuario
    $registrar_usuario = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, apellido_usuario, nacimiento_usuario, nick_usuario, correo_usuario, pw_usuario) 
                            VALUES (:nombre, :apellido, :fecha_nacimiento, :nick, :correo, :contrasenia)");
    $registrar_usuario->bindParam(':nombre', $nombre_usuario, PDO::PARAM_STR);
    $registrar_usuario->bindParam(':apellido', $apellido_usuario, PDO::PARAM_STR);
    $registrar_usuario->bindParam(':fecha_nacimiento', $fecha_nacimiento_usuario, PDO::PARAM_STR); // Fecha en formato YYYY-MM-DD
    $registrar_usuario->bindParam(':nick', $nick_usuario, PDO::PARAM_STR);
    $registrar_usuario->bindParam(':correo', $correo_usuario, PDO::PARAM_STR);
    $registrar_usuario->bindParam(':contrasenia', $hashed_contrasenia, PDO::PARAM_STR);
    $registrar_usuario->execute();