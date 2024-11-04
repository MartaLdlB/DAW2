<?php

$frutasArray = array();
$frutasCadena="";  //inicializamos en vacio para que no explote
if(is_readable("frutas.txt")){ //comprobamos si se puede leer el archivo
    $frutas = fopen("frutas.txt", "r");  //abrimos el archivo e indicamos que se va a leer ("r")
    //con fopen() se abre el archivo y se "almacena" en una variable, con esta variable podremos hacer el string
    while(!feof($frutas)){ //comprueba si ha llegado al final
        $frutasCadena .= fgets($frutas); // .=concatena fgets   
        if(!feof($frutas)) //si no a terminado concatena un espacio
            $frutasCadena .=" ";
    }
    fclose($frutas);
}
$frutasArray = explode(" ", $frutasCadena);

echo "<pre>";
    print_r ($frutasArray);
echo "</pre>";

echo "<br>";
echo "<br>";
echo "<br>";

$arrayFgetc=array();
$cadenaFgetc="";
    if(is_readable("frutas.txt")){ //comprobamos si se puede leer el archivo
        $frutas = fopen("frutas.txt", "r");  //abrimos el archivo e indicamos que se va a leer ("r")
        //con fopen() se abre el archivo y se "almacena" en una variable, con esta variable podremos hacer el string
        while(!feof($frutas)){ //comprueba si ha llegado al final
            $cadenaFgetc .= fgetc($frutas); // .=concatena fgets  
            if(!feof($frutas)) //si no a terminado concatena un espacio
                $cadenaFgetc .=" ";
        }
        fclose($frutas);
    }
    $arrayFgetc = explode(" ", $cadenaFgetc);
    
echo "<pre>";
    print_r ($arrayFgetc);
echo "</pre>";
