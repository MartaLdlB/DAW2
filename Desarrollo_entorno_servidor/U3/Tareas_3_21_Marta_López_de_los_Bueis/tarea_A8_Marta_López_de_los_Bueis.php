<?php

/*A7.- Mapear la primera fila de la tabla a un objeto de una clase, 
con PDO::FETCH_CLASS: 
El script debe mapear la primera fila de la tabla users a una instancia de la clase Usuario. El 
método setFetchMode(PDO::FETCH_CLASS, ‘Usuario’) configura el modo de obtención 
para que cada fila se mapee a una instancia de la clase Usuario. Hay que definir  la clase 
Usuario. En este caso queremos que esta clase tenga dos atributos: nombre y clave que 
serán los que queremos obtener del SELECT.*/


//Creamos la clase usuario con los parametros necesarios
class Usuario {
    public $nombre;
    public $clave;

   
}
try{

    //obtenemos los datos necesarios para la base de datos
    $datos_conexion="mysql:host=127.0.0.1;dbname=empresa";
    $administrador="root";
    $pw="";
    //realizamos la conexion con la base de datos
    $base_de_datos= new PDO($datos_conexion,$administrador,$pw);
    
    //realizamos la consulta
    $consulta= $base_de_datos->query("SELECT nombre, clave FROM usuarios LIMIT 1");

    /*fetchAll(PDO::FETCH_CLASS, 'Usuario') --> es una forma de recuperar todos los resultados de una consulta en PHP usando PDO
    y convertir cada fila en una instancia de la clase especificada, en este caso, Usuario. */
    $usuario=$consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');

    //si la variable usuario tiene algo almacenado
    if($usuario){
        //lo imprime con un estilo predeterminado por la etiqueta <pre>
        echo "<pre>";
        print_r ($usuario);
        echo "</pre>";
    }else{
        //en el caso de que ocurriese algun error, lo imprime
        echo "No se encontró ningún usuario en la tabla.";
    }


}catch(PDOExcepion $e){
    echo "Error en la conexion con la base de datos: <br>".$e-getMessage();
}