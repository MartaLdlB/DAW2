<?php

$datos_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$administrador = 'root';
$pw ='';
try{
    $baseDeDatos= new PDO($datos_conexion,$administrador,$pw);
    echo "<p>Se ha realizado la conecxión con ".$datos_conexion.
        "<br> Administrador= ".$administrador." | pw= ".$pw. "</p>";
    
        /*escribimos la consulta
        Esto nos dara todos los usuarios que estan en nuestra base de datos*/
        $consulta = "SELECT nombre, clave, rol FROM usuarios";

        //en esta variable se almacenaran los usuarios con sus datos
        $usuarios =$baseDeDatos-> query($consulta);
        /*Con este bucle lo que hacemos es imprimir los datos de cada usuario en la base de datos*/
        foreach($usuarios as $usr){
            echo "Nombre: ". $usr["nombre"]."<br>". "Clave: ". $usr["clave"]."<br>"."Rol: ".$usr["rol"]."<br><br>xsd";
        }

        /*Esta variable lo que generara es un array
        Con prepare dejamos la consulta preparada para ser ejecutada mas adelante */
        $preparada = $baseDeDatos->prepare("SELECT nombre, clave, rol FROM usuarios WHERE rol=:rol") ;
        /*Con execute ejecutamos la consulta que hemos dejado preparada con prepare()
        aun que en este caso se hace de seguido, podriamos dejarlo para otro momento */
        $preparada->execute(array(':rol'=>0));

        echo "Ahora mostraremos solo los usuarios con rol 0"."<br>";
        foreach($preparada as $usr){
            echo "Nombre: ". $usr["nombre"]."<br>". "Clave: ". $usr["clave"]."<br>"."Rol: ".$usr["rol"]."<br><br>";
        }

}catch(PDOExcepion $e){
    echo "¡Error! No se ha podido establecer conexión con la base de datos: <br>" . $e -> getMessage();
}