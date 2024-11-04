<?php
    $base = 5;
    $exponente = 2;

    /*Usando la funcion pow*/

    echo pow($base, $exponente);

    /*Usando la formula que utiliza la funcion pow */
    $potencia=$base;
    for ($i=1; $i < $exponente; $i++) { 
        $potencia=$potencia*$base;
    }
    echo(" ");
    echo ($potencia);

    
?>
