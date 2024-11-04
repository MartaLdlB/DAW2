
<?php

/*I.- Desarrollar una aplicación PHP que gestiones excepciones lanzadas por una función:

Crea una función para calcular y devolver el resultado de dividir dos números.

I.- Haz que la función anterior lance una excepción y su mensaje correspondiente, cuando el divisor sea cero.
Crea código para probar lo anterior gestionando las posibles excepciones, en dos casos:
División por cero, capturando la excepción lanzada.
Divisor mayor que cero.

II.- Desarrolla lo anterior con la clase DivisionByZeroError https://www.php.net/manual/es/class.divisionbyzeroerror.php

III.- Tarea_2_4B Mejora la tarea 2_3 para que controle si el argumento es negativo, utilizando una excepción.*/

echo "<h1>Tarea 2_4 Excepciones y errores</h1>";


function division($divisor, $dividendo){
    $resultado;
    try {
        if ($dividendo == 0) {
            throw new Exception("Error, no se puede dividir entre cero"); //creamos el error de la division entre 0
        } else {
            $resultado = $divisor / $dividendo; // si pasa a este punto es que el divisor no es cero, por lo que no captura ningun error
        }
    } catch (Exception $e) {
        return $e->getMessage(); // Con este mensaje permitimos que el error se muestra por pantalla
    }
    
    return $resultado;
}

echo division(10,2);
echo "<br>";
echo division(10,0);
echo "<br>";

function division2($divisor, $dividendo){
    $resultado;

    //con este try/catch usamos directamente el error que ya existe creao de la division por cero, no necesitamos crearlo nosotros
    try{
        $resultado = $divisor / $dividendo;
    }catch(DivisionByZero $e){ //en el caso de que el dividendo sea 0, lo captura y muestra el error
        return $e->getMessage();
    }
    return $resultado;
}
echo "<br>";
echo division2(10,2);
echo "<br>";
echo division2(10,0);

?>