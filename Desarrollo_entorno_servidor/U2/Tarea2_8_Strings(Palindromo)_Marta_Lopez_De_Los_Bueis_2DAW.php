<?php

/* Desarrollar un script en PHP con la siguiente funcionalidad:

Una función que reciba un string y compruebe si es un palíndromo.

Debes usar funciones de strings https://www.php.net/manual/es/ref.strings.php1*/



function recibirString($cadena) {
    $cadenaAlReves = ""; // Inicializamos la variable para la cadena invertida
    $cadena= strtolower($cadena); //hacemos minusculas todas las letras para evitar problemas
    
    for ($i = strlen($cadena) - 1; $i >= 0; $i--) {  // bucle para invertir la cadena
        $cadenaAlReves .= $cadena[$i]; // Concatenamos el carácter 
    }   
    // Comparamos la cadena original con la cadena invertida
    $comparacion = strcmp($cadena, $cadenaAlReves);

    // Mostramos el resultado
    if ($comparacion == 0) {
        echo "La cadena es un palíndromo: " . $cadena . "<br>";
    } else {
        echo "La cadena no es un palíndromo: " . $cadena . "<br>";
    }

    echo "Cadena invertida: " . $cadenaAlReves . "<br>";
}

echo "<h1>Tarea 2_8 Strings (Palindromos)</h1>";
echo "<p>Creamos una funcion que reciba un string y compruebe si es un palindromo</p>";
echo "<p>Un <strong>palindromo</strong> es una palabra o frase cuyas letras están dispuestas de tal manera que resulta <br>la misma leída de izquierda a derecha que de derecha a izquierda</p>";
echo "<br>";
echo "******************************************";
echo "<br>";
recibirString("Manzana");
echo "<br>";
recibirString("Somos");

?>