<?php

$datos_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$administrador = 'root';
$pw ='';
try{
    $bd = new PDO($datos_conexion,$administrador,$pw);
        echo "<p>Se ha realizado la conecxión con ".$datos_conexion.
        "<br> Administrador= ".$administrador." | pw= ".$pw. "</p>";

        //comenzar la transaccion
        /*
        beginTransaction() es un método que se usa con PDO (PHP Data Objects) en PHP 
        para iniciar una transacción en bases de datos compatibles con SQL, como MySQL. 
        Este método marca el comienzo de una serie de operaciones que serán tratadas como 
        una sola unidad de trabajo. 
        Si todas las operaciones dentro de la transacción se completan correctamente, se confirma con commit(). 
        Si alguna falla, se revierte con rollback().
        */
        $bd->beginTransaction();
        $ins = "Insert into usuarios(nombre, clave, rol) values('Marta', '0001', '1')";
        /*
        El método query() en PHP es una función que permite ejecutar consultas SQL 
        directamente en una base de datos. Este método se usa tanto con MySQLi como con PDO, 
        y es útil para ejecutar sentencias SQL como SELECT, INSERT, UPDATE, y DELETE.
        */
        $resul=$bd->query($ins);
        /*El método query() en PHP devuelve distintos tipos de resultados según el tipo de consulta SQL que se esté ejecutando: */
        /*
        Consultas SELECT: Devuelve un objeto
        Consultas INSERT, UPDATE, DELETE, etc. (consultas que modifican datos):
          -Devuelve true si la consulta se ejecutó correctamente.
          -Devuelve false si hubo algún error en la consulta.
          Consultas que no producen resultado:
          -En el caso de comandos como CREATE TABLE o DROP TABLE, 
          query() devuelve true si la consulta se ejecutó correctamente, o false si falló.     
        */

        /*En este caso, al ser in insert la query(), lo que nos devuelve es un booleano
        el cual comprobamos para lanzar un error o hacer el commit() */
        if(!$resul){
            echo "<p>Error: ".print_r($bd->errorinfo());
            //hay que deshacer el primer cambio
            echo "<br>Haciendo rollback...";
            $bd->rollback();
            echo "<br>¡Transaccion anulada!";
            
        }else{
            //si hubiera ido bien
            /*
            El método commit() en PHP se utiliza para confirmar una transacción en una base de datos. 
            Este método guarda permanentemente los cambios realizados durante la transacción en la base de datos.
            */
            $bd->commit();
        }

}catch(PDOExcepion $e){
    echo "Error con la base de datos".$e->getMessage();
}

