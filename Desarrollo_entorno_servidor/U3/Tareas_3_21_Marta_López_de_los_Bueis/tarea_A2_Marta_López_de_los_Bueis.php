<?php

/*

A2.- Obtener todas las filas de una tabla, con fetchAll():
El script debe realizar una consulta para obtener todas las filas de la tabla users. El
método fetchAll(PDO::FETCH_ASSOC) que devuelve todas las filas como un array de arrays
asociativos.

*/

//realizamos la conexion con la base de datos
$bd = new PDO('mysql:host=127.0.0.1;dbname=empresa', 'root','');

//La consulta en MySQL para este ejercicio sería 'SELECT * FROM usuarios'
//Escribimos la consulta
$consulta = $bd->query('SELECT * FROM usuarios');

//obtenemos lo que se nos pide en un array asociaivo
$tablaUsuarios = $consulta->fetchAll(PDO::FETCH_ASSOC);



foreach($tablaUsuarios as $valor){
    echo implode(" ",$valor). "<br>";
}

?>

<pre> <!--Esta etiqueta pre es un texto preformado -->
<?php
//imprimimos el array asociativo 
//Este print_r funciona convirtiendo cualquier cosa que recibe en un string
 print_r($tablaUsuarios); 
 ?>
</pre>



