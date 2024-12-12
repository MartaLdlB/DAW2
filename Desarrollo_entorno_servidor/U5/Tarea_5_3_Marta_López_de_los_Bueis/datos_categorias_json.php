<?php
    $categoria1 = array("id_categoria"=> 1, "nombre"=> "ropa");
    $categoria2 = array("id_categoria"=> 2, "nombre"=> "cubiertos");
    $categoria3 = array("id_categoria"=> 3, "nombre"=> "vajilla");
    $categoria4 = array("id_categoria"=> 4, "nombre"=> "fruta");
    $categoria5 = array("id_categoria"=> 5, "nombre"=> "verdura");

    $arrayDatos = array($categoria1,$categoria2,$categoria3,$categoria4,$categoria5);

    $datos = json_encode($arrayDatos);

    echo $datos;