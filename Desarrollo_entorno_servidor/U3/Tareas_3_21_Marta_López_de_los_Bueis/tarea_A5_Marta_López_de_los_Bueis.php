<?php

/*A5.- Obtener la primera fila de una tabla, con PDO::FETCH_NUM: 
El script debe obtener la primera fila de la tabla users como un array indexado 
numéricamente. El método fetch(PDO::FETCH_NUM) devuelve la fila como un array donde 
las claves son índices numéricos.*/

try{
    //obtenemos los datos necesarios para la base de datos
    $datos_conexion="mysql:host=127.0.0.1;dbname=empresa";
    $administrador="root";
    $pw="";
    //realizamos la conexion con la base de datos
    $base_de_datos= new PDO($datos_conexion,$administrador,$pw);
    //realizamos la consulta que selecciona todo de la tabla usuarios
    $consulta= $base_de_datos->query("SELECT * FROM usuarios");

    //con este fetch, al indicarle un 1, le decimos que solamente vamos a tomar la primera fila
    //lo almacena en un array
    $fila=  $consulta->fetch(PDO::FETCH_NUM, 1);

    //mostramos el array con los datos obtenidos
    print_r ($fila);

}catch(PDOExcepion $e){
    echo "Error en la conexion con la base de datos".$e-getMessage();
}