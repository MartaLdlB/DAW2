<?php
    /*Creamos los arrays indicando la cantidad de numeros que va a tener */
    $array1 = array(); //al poner un numero dentro del parentesis indicamos una capacidad máxima
    $array2 = array();

    for ($contador=0; $contador < 24; $contador++) { 
        $array1[]=rand(0,50);
        $array2[]=rand(0,50);
    }

    for ($i=0; $i < 25; $i++) { 
        print_r($array1($i));
    }
    

?>