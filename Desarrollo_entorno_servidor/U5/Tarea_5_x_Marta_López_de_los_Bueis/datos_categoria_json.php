<?php
    $cat1 = array("cod"=> 1, "nombre"=>"Comida");
    $cat2 = array("cod"=> 2, "nombre"=>"Bebida");
    $cat3 = array("cod"=> 3, "nombre"=>"Aperitivos");
    $cat4 = array("cod"=> 4, "nombre"=>"Entrantes");
    $cat5 = array("cod"=> 5, "nombre"=>"Postres");

    $array = array($cat1, $cat2, $cat3, $cat4, $cat5);

    $datos = json_encode($array);

    echo $datos;


    /*volvemos los datos a array asociativo (clave, valor) */
    $decode = json_decode($datos);

    echo "<pre>";
    print_r($decode);
    echo "</pre>";
