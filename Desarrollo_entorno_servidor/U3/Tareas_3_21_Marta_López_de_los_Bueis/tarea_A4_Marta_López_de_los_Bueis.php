<?php

/*A4.- Obtener todas las filas de una columna de la tabla, con  PDO::FETCH_COLUMN: 
El script debe obtener todas las filas de la columna name de la tabla users. El 
método fetchAll(PDO::FETCH_COLUMN, 0) devuelve un array con los valores de la columna 
especificada.  */

//Realizamos la conexxion con la base de datos

$datos_conexion="mysql:host=127.0.0.1;dbname=empresa";
$administrador="root";
$pw="";

try{
    $base_de_datos= new PDO($datos_conexion,$administrador,$pw);

    //realizamos la consulta 
    $consulta= $base_de_datos->query("SELECT nombre FROM usuarios");

    //almacenamos los datos que recibimos en una varibale
    $columnaNombre= $consulta->fetchAll(PDO::FETCH_COLUMN, 0);

    //mostramos los datos obtenidos de la consulta
    print_r ($columnaNombre);

}catch(PDOExcepion $e){
    echo "Error al realizar la conexion con la base de datos.".$e-getMessage();
}

