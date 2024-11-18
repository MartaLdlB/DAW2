<?php

/*A10.- Obtener todas las filas restantes de la tabla con fetchAll: 
El script debe obtener todas las filas restantes de la tabla users e imprimirlas. El 
método fetchAll() sin parámetros devuelve todas las filas restantes como un array de arrays. */


//Creamos la clase usuario con los parametros necesarios

try{

    //obtenemos los datos necesarios para la base de datos
    $datos_conexion="mysql:host=127.0.0.1;dbname=empresa";
    $administrador="root";
    $pw="";
    //realizamos la conexion con la base de datos
    $base_de_datos= new PDO($datos_conexion,$administrador,$pw);
    
    //realizamos la consulta preparada
    $consulta= $base_de_datos->query("SELECT * FROM usuarios");

    //fetchAll() sin parámetros devuelve todas las filas restantes como un array de arrays
    $filas=$consulta->fetchAll();

    if($filas){
        echo "<pre>";
        print_r($filas);
        echo "</pre>";
    }else{
        echo "<p>Error";
    }

}catch(PDOExcepion $e){
    echo "Error en la conexion con la base de datos: <br>".$e-getMessage();
}