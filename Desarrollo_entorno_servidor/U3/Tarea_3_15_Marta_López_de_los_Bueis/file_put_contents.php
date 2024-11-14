<?php

if(is_readable("fichero1.txt")){
    //esto devuelve el archivo en un string, en el caso de que no se pueda devuelve un false.
    $fichero1= file_get_contents("fichero1.txt");
    
    /*file_get_contents(
    string $filename, -->Nombre del archivo que queremos abrir
    bool $use_include_path = false, --> (opcional)Si se establece como true, PHP buscará el archivo en la ruta especificada por la directiva include_path de php.ini.
    resource $context = ?, --> (opcional) Un recurso de contexto creado con stream_context_create() que permite personalizar cómo se accede al archivo (útil para configuraciones avanzadas como autenticación, cabeceras HTTP, etc.).
    int $offset = 0, --> (opcional): Especifica desde qué posición del archivo comenzar a leer. Si no se especifica, comienza desde el principio del archivo.
    int $maxlen = ? --> (opcional):Define el número máximo de bytes a leer. Si no se establece, se leerá el archivo completo.
    ): string
    */

    echo $fichero1;

    $añadir="DAW2";

    $ficheroConAñadido;
    for ($i=0; $i < strlen($fichero1); $i++) { 
        $ficheroConAñadido .= $fichero1[i];
        if(i==5){
            $ficheroConAñadido.=$añadir;
        }
    }
    echo $ficheroConAñadido;
    
}else{
    echo "Error al leer el fichero.txt";
}
