<?php

//registro

require_once "consultas_bd";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre_usuario=$_POST['nombre'];
    $apellido_usuario=$_POST['apellido'];
    $fecha_nacimiento_usuario=$_POST['fecha_nacimiento'];
    $nick_usuario=$_POST['nick'];
    $correo_usuario=$_POST['email'];
    $contrasenia_usuario=$_POST['contrasenia'];

    if(comprobarNick()){
        echo "El nick ya está en uso.";
    }elseif(comprobarEmail()){
        echo "El correo ya está registrado.";
    }else{
        registrarUsuario($nombre_usuario,$apellido_usuario,$fecha_nacimiento_usuario,$nick_usuario,$correo_usuario,$contrasenia_usuario);
        header("Location: /vista/principal.html");
    }

}

function comprobarNick(){
    //comprobamos que el nick que introduce el usuario no esta en uso
    $lista_nicks = obtenerTodosNicks();
         if(in_array($nick_usuario,$lista_nicks)){
        //si se encuentra en el array significa que el nick esta en uso
            return true;
        }else{
            return false;
        }
}

function comprobarEmail(){
    //comprobamos que el nick que introduce el usuario no esta en uso
    $lista_email = obtenerTodosEmail();
         if(in_array($correo_usuario,$lista_email)){
        //si se encuentra en el array significa que el email esta en uso
            return true;
        }else{
            return false;
        }
}