<?php

/*A6.- Obtener las filas de una tabla agrupadas por el valor de la primera columna, 
con PDO::FETCH_GROUP: 
El script debe agrupar las filas por el valor de la primera columna (name). El 
método fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC) devuelve un array 
asociativo donde las claves son los datos(nombres) de la primera columna y los valores son 
arrays con el resto de la fila; son filas asociativas.*/

try{

    //obtenemos los datos necesarios para la base de datos
    $datos_conexion="mysql:host=127.0.0.1;dbname=empresa";
    $administrador="root";
    $pw="";
    //realizamos la conexion con la base de datos
    $base_de_datos= new PDO($datos_conexion,$administrador,$pw);
    
    //realizamos la consulta
    $consulta= $base_de_datos->query("SELECT * FROM usuarios");

    //esta variable almacena un mapa
    //PDO::FETCH_GROUP -->Agrupa por el primer valor, en esta base de datos es la clave
    //PDO::FETCH_ASSOC -->Devuelve un array asociativo
    $agrupado= $consulta->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);

    //Imprimimos el mapa agrupado con una etiqueta HTML que tiene un formato predefinido
    echo "<pre>";
    var_dump($agrupado);
    echo "</pre>";

}catch(PDOExcepion $e){
    echo "Error en la conexion con la base de datos: <br>".$e-getMessage();
}