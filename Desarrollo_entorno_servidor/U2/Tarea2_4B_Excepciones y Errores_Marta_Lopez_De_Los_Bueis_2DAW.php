<?php
    echo "<h1>Tarea 2_4B Excepciones y errores</h1>";
    echo "<p>Mejoramos la tarea 2_3 para que controle si el argumento es negativo, utilizando una excepción.</p>";
    function factorial($factorial){
       
        //con el try catch hacemos que encuentre el error
        try{
            if(!is_int($factorial)){
                throw new Exception ("El valor introducido no es un numero entero"); //si no es un numero entero lo encuentra y muestra el mensaje de error
                                                                                    //que hemos generad nosotros
            }elseif($factorial<0){
                throw new Exception ("El valor introducido es menor que 0, no puede ser negativo");//en el caso de ser un numero negativo lo encuentra y muestra este mensaje
            }
        }catch(Exception $e){
            return $e->getMessage(); //con esto hacemos que se ejecute el mensaje segun el error y que lo muestre por pantalla
        }
       

        $resultado = 1;//inicializamos en 1 para que este sea la base de la multiplicacion para el factorial

        for ($i=$factorial; $i > 1; $i--) { //con este bucle multiplicamos la cantidad de veces sea necesarias apra conseguir el factorial
            $resultado = $resultado * $i;
        }

        return $resultado; //devolvemos el resultado del factorial, a este punto solo se llega si no se han capturado errores
   
    }

    echo "El factorial de 5 es: " . factorial(5);  //deberia dar 120
    echo "<br>";
    echo "El factorial de -1 es: " . factorial(-1); //deberia salir el error del -1
    echo "<br>";
    echo "El factorial de Hola es: " . factorial("hola"); // deberia salir error por no ser un numero entero
    echo "<br>";
    echo "El factorial de 2.6 es: " .factorial(2.6);// deberia salir error por no ser un numero entero
?>

