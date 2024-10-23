<?php
  //  echo "hola". " " . $_GET["nombre"] . " " . $_GET["apellido"]; //pinta como parametro de prueba el dato que ha recibido del navegador


    if(empty($_GET["nombre"])){
        echo "Error, falta el parámetro nombre";
    }elseif(empty($_GET["apellido"])){
        echo "Error, falta el parámetro apellido";
    }else{
        echo "Hola" ." " . $_GET["nombre"] . " " . $_GET["apellido"];
    }