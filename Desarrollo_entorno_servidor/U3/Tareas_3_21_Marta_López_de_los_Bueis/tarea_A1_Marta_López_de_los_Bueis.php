

<?php

/*

A1.- Conexión a la base de datos y obtención de la 1ª fila, con fetch():
El script debe realizar la conexión a una base de datos MySQL utilizando PDO. Luego,
ejecutar una consulta para obtener la primera fila de la tabla users con el
método fetch(PDO::FETCH_ASSOC) que devuelve la fila como un array asociativo, donde
las claves son los nombres de las columnas.


*/


//conexion a la base de datos
$bd = new PDO('mysql:host=127.0.0.1;dbname=empresa', 'root','');

//Consulta para obtener una fila
//SQL Server> SELECT TOP number|percent coumn_name(s) FROM table WHERE condition;
//Oracle 12> SELECT * FROM table FETCH FIRST number ROWS ONLY;
//MySQL> SELECT * FROM table LIMIT 1;

$consulta = $bd->query('SELECT * FROM usuarios LIMIT 1');
 //Obtener la fila como un array asociativo

$fila = $consulta->fetch(PDO::FETCH_ASSOC);

//imprimir la fila
print_r($fila);
?>
