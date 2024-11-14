<?php

//Abrimos el archivo .txt llamado matriz y le decimos que va a ser modo lectura 
 $fichero = fopen("matriz.txt", "r");
 //si hay algun problema en la apertura del fichero se envia un mensaje de error
  if ($fichero === False){
    echo "No se encuentra el fichero o no se puede leer<br>";
  }else{
    //en el caso de que salga bien
    /*Mientras que la lectura del fichero no termine (feof() cumprueba si el fichero se ha terminado de leer)
     */
    while( !feof($fichero) ){
      $num = fscanf($fichero, "%d %d %d %d");
      echo "$num[0] $num[1] $num[2] $num[3] <br>";
    }
  }
  rewind($fichero);
  while( !feof($fichero) ){
      $num = fscanf($fichero, "%d %d %d %d", $num1, $num2, $num3, $num4 );
      echo "$num1 $num2 $num3 $num4 <br>";
    }
  fclose($f);