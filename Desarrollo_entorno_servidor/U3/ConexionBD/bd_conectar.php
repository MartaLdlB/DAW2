<?php

$datos_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$administrador = 'root';
$pw ='';
try{
    $bd = new PDO($datos_conexion,$administrador,$pw);
        echo "<p>Se ha realizado la conecxión con ".$datos_conexion.
        "<br> Administrador= ".$administrador." | pw= ".$pw. "</p>";
}catch(PDOExcepion $e){
    echo "Error al intentar conectar con la base de datos".$e->getMessage();
}