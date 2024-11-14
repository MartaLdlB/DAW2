<?php

/*Con is_readable() comprobamos primero si el archivo se puede leer
Creamos una variable para almacenar el archivo que le indicamos, en este caso en un .txt,
Con la letra "r" indicamos que este texto solo va a ser de lectura 
*/
if(is_readable("fichero1.txt")){
    $fichero1 = fopen("fichero1.txt", "r");
}


//Controlamos que el fichero se ha abierto correctamente, en el caso de que suceda envia un mensaje u otro
if($fichero1 === false){
    echo "<p>El fichero no se ha podido abrir correctamente<p><br>";
} else {
    echo "<p>El fichero se ha podido abrir correctamente<p><br>";
}
//Mientras que el fichero no llegue al final imprime cada caracter del texto
while(!feof($fichero1)){
    echo fgetc($fichero1);
}
//cerramos el archivo
fclose($fichero1);