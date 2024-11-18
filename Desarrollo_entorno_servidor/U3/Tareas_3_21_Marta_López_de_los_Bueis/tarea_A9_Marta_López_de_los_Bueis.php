<?php

/*A9.- Vincular las columnas de la primera fila de la tabla a variables, 
con PDO::FETCH_BOUND e imprimirlas: 
El script debe vincular las columnas de la primera fila a variables y las imprime. El 
método bindColumn vincula las columnas a variables específicas, 
y fetch(PDO::FETCH_BOUND) asigna los valores de las columnas a esas variables. 
• En este caso, se debe usar prepare() en lugar de query. 
• Después de execute() se debe usar bindColumn(1, $nombre) y bindColumn(2, $clave) 
para vincular columnas y variables. 
• Con fetch(PDO::FETCH_BOUND) se obtendrán los valores visnculados a las 
variables anteriores. 
• Imprimir los valores con el formato “$name <$email> */


//Creamos la clase usuario con los parametros necesarios

try{

    //obtenemos los datos necesarios para la base de datos
    $datos_conexion="mysql:host=127.0.0.1;dbname=empresa";
    $administrador="root";
    $pw="";
    //realizamos la conexion con la base de datos
    $base_de_datos= new PDO($datos_conexion,$administrador,$pw);
    
    //realizamos la consulta preparada
    $consulta= $base_de_datos->prepare("SELECT nombre, clave FROM usuarios LIMIT 1");

    //ejecutamos la consulta preparada
    $consulta->execute();

    //indicamos los parametros
    $consulta->bindColumn(1,$nombre);
    $consulta->bindColumn(2,$clave);

    
    /* PDO::FETCH_BOUND--> asocia columnas del conjunto de resultados con variables específicas de PHP. */
    if($consulta->fetch(PDO::FETCH_BOUND)){
        echo "$nombre <$clave>";
    }else{
        echo"<p>Error</p>";
    }


}catch(PDOExcepion $e){
    echo "Error en la conexion con la base de datos: <br>".$e-getMessage();
}