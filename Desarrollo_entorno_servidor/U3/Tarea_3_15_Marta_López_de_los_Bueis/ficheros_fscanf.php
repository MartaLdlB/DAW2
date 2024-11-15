<?php

//Abrimos el archivo .txt llamado matriz y le decimos que va a ser modo lectura 
 $fichero = fopen("matriz.txt", "r");
 //si hay algun problema en la apertura del fichero se envia un mensaje de error
  if ($fichero === false){
    echo "No se encuentra el fichero o no se puede leer<br>";
  }else{
    //en el caso de que salga bien
    /*Mientras que la lectura del fichero no termine (feof() cumprueba si el fichero se ha terminado de leer)
    imprime los numeros en las posiciones proporcionadas.
    Esto se puede hacer porque conocemos que tipo de dato hay en el archivo
     */
    while( !feof($fichero) ){
      //con %d indicamos que son numeros enteros
      $num = fscanf($fichero, "%d %d %d %d");
      echo "$num[0] $num[1] $num[2] $num[3] <br>";
    }
  }
  //rebobina la posicion del puntero de un fichero (como si empezase a leerlo desde el principio)
  rewind($fichero);
  //repetimos el mismo bucle anterior para mostrar los resultados de forma distinta
  while( !feof($fichero) ){
    //como sigue siendo el mismo fichero, indicamos que son numeros enteros y los almacenamos en una variable cada uno.
      $num = fscanf($fichero, "%d %d %d %d", $num1, $num2, $num3, $num4 );
      //aqui imprimimos las variables
      echo "$num1 $num2 $num3 $num4 <br>";
    }
  fclose($fichero);