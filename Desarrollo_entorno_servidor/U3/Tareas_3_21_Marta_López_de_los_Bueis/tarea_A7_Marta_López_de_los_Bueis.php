<?php

/*A7.- Mapear la primera fila de la tabla a un objeto de una clase, 
con PDO::FETCH_CLASS: 
El script debe mapear la primera fila de la tabla users a una instancia de la clase Usuario. El 
método setFetchMode(PDO::FETCH_CLASS, ‘Usuario’) configura el modo de obtención 
para que cada fila se mapee a una instancia de la clase Usuario. Hay que definir  la clase 
Usuario. En este caso queremos que esta clase tenga dos atributos: nombre y clave que 
serán los que queremos obtener del SELECT.*/

class Usuario {
    public $nombre;
    public $clave;

    // Método opcional para imprimir los datos del usuario
    public function toString() {
        return "Nombre: $this->nombre, Clave: $this->clave";
    }
}
try{

    //obtenemos los datos necesarios para la base de datos
    $datos_conexion="mysql:host=127.0.0.1;dbname=empresa";
    $administrador="root";
    $pw="";
    //realizamos la conexion con la base de datos
    $base_de_datos= new PDO($datos_conexion,$administrador,$pw);
    
    $consulta= $base_de_datos->query("SELECT nombre, clave FROM usuarios LIMIT 1");

    $usuario=$consulta->fetchAll(PDO::FETCH_CLASS, 'Usuario');

    if($usuario){
        echo "<pre>";
        print_r ($usuario);
        echo "</pre>";
    }else{
        echo "No se encontró ningún usuario en la tabla.";
    }


}catch(PDOExcepion $e){
    echo "Error en la conexion con la base de datos: <br>".$e-getMessage();
}