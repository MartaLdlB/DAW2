<?php

/*

A3.- Obtener la primera fila de una tabla como un objeto, con PDO::FETCH_OBJ:
El script debe obtener la primera fila de la tabla users como un objeto. El
método fetch(PDO::FETCH_OBJ) devuelve la fila como un objeto anónimo, permitiendo
acceder a las columnas como atributos del objeto.

*/


//realizamos la conexion con la base de datos
$bd = new PDO('mysql:host=127.0.0.1;dbname=empresa','root','');

//escribimos la consulta
//En MySQL la consulta seria 'SELECT * FROM usuarios LIMIT 1'
//Por lo que la linea de consulta quedaría asi
$consulta = $bd->query('SELECT * FROM usuarios LIMIT 1');

//PDO::FETCH_OBT lo que hace es devolver un objeto anonimo para que se pueda acceder 
//a cada columna como un atributo de este objeto
$objetoFila = $consulta->fetch(PDO::FETCH_OBJ);
//Por lo que conociendo cuales son los atributos que tendria este objeto, podriamos imprimirlos

//Imprimimos el objeto direcctamente transformandolo a String
print_r ($objetoFila);

echo "<br><br>";

//Imprimimos por cada atributo
if ($objetoFila) {
    echo "Codigo: " . $objetoFila->Codigo . "<br>";
    echo "Nombre: " . $objetoFila->Nombre . "<br>";
    echo "Clave: " . $objetoFila->Clave . "<br>";
    echo "Rol: " . $objetoFila->Rol . "<br>";
}
echo "<br><br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea_A3</title>
    <style>
        table,tr,td,th{
            border: 2px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <!--Formateamos la salida con una tabla, como en este caso conocemos que solo es la primera fila, solamente indicamos el atributo -->
    <table>
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Clave</th>
            <th>Rol</th>
        </tr>
        <tr>
            <td><?php echo $objetoFila->Codigo; ?></td>
            <td><?php echo $objetoFila->Nombre; ?></td>
            <td><?php echo $objetoFila->Clave; ?></td>
            <td><?php echo $objetoFila->Rol; ?></td>
        </tr>

    </table>

</body>
</html>
