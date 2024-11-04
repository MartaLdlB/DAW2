<?php

/*Desarrollar un script PHP que implemente la siguiente funcionalidad:

Crear una clase para recoger la información que te parezca adecuada sobre piezas musicales.

Crea una aplicación que instancie 10 objetos de la clase anterior y les asigne toda la información posible.

La aplicación presentará toda la información disponible de los 10 objetos. La presentación debe ser en formato lista o en formato tabla.

Incluye un fragmento de la pieza musical en archivo de audio o de vídeo.

Para lo anterior, debes usar funciones de arrays https://www.php.net/manual/es/ref.array.php

Cuida la presentación de los resultados.*/ 


class InstrumentoMusical{  //Creamos la clase

    //declaramos los atributos
    private $nombreInstrumento; 
    private $tipoInstrumento;

    //creamos el constructor
    public function __construct($nombre, $tipo){
        $this->nombreInstrumento = $nombre;
        $this->tipoInstrumento = $tipo;
    }

    //esta funcion permite mostrar el objeto creado
    public function presentacion() {
    return $this->nombreInstrumento . " - Tipo: " . ($this->tipoInstrumento == 1 ? "Cuerda" : "Viento");
    }      

    //con esta funcion obtenemos solamente el nombre
    public function getNombre(){
        return $this->nombreInstrumento;
    }

    //con esta funcion obtenemos el tipo
    public function getTipo(){
        //Esta funcion nos muestra unicamente el tipo de instrumento.
        return $this->tipoInstrumento == 1 ? "Cuerda" : "Viento"; 
    }
    
   
}

$instrumentosMusicales = array();
for ($i = 1; $i <= 10; $i++) {
    //para este ejercicio he usado el random para generar un 1 o 2, para que al generar un instrumento
    //nuevo el 1 corresponda a Cuerda y el 2 a viento
    //Para poder hacer esto automatico, todos los instrumentos se llaman Instrumento y se concatena el numero segun el bucle
    //esto hace que no tenga que generar 10 instrumentos a mano.
    $instrumentosMusicales[] = new InstrumentoMusical("Instrumento $i", rand(1, 2));
}

//formateamos la salida en tipo lista, en este caso una lista sin ordenar (al ejecutarlo se ven puntos) ya que cada instrumento lleva asociado su numero al generarse
echo "<h1>Formato tipo lista</h1>";
echo "<ul>";

//con este bucle hacemos que se imprima cada instrumento en una lina de la lista
foreach ($instrumentosMusicales as $instrumento) {
    echo "<li>" . $instrumento->presentacion() . "</li>";
}
echo "</ul>";

echo "*************************************";


//formateamos la salida tipo tabla
echo "<h1>Formato tipo tabla</h1><br>";


echo "<table border='1'>";
echo "<thead>";
echo "<tr><th>Nombre</th><th>Tipo</th></tr>";
echo "</thead>";
echo "<tbody>";
//esta tabla tendra dos filas, una para el nombre y la otra para el tipo
foreach ($instrumentosMusicales as $instrumento) {
    echo "<tr>";
    echo "<td>" . $instrumento->getNombre() . "</td>";
    echo "<td>" . $instrumento->getTipo() . "</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";

?>
