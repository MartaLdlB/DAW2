<?php

//creamos una clase para poder realizar la conexion con la base de datos desde un xml
class conectarBaseDeDatos{
    //creamos el atributo que va a ser un PDO
    private PDO $conexion;  
   
    //creamos el constructor de la clase
    function __construct(){
        //dentro le indicamos las rutas del xml y xsd
        $rutaXML="conexion_base_de_datos/datos_conexion.xml";
        $rutaXSD="conexion_base_de_datos/schema.xsd";

        //y comprobamos que estos archivos que le estamos indicando existen, si hay algún problema lanza una excepcion creada por nosotros
        if(!file_exists($rutaXML)){
            throw new Exception ("El archivo XML en la ruta indicada no existe");
        }elseif (!file_exists($rutaXSD)) {
            throw new Exception("El archivo XSD en la ruta indicada no existe");
        }else{
            //en el caso de que no haya problemas y ambos archivos existan creamos el DOM
            //DOMDocumen() -> proporciona una manera de manipular documentos XML y HTML
            $datosBD = new DOMDocument();
            //El método load() de la clase DOMDocument se utiliza para cargar y analizar un archivo XML o HTML
            $datosBD->load($rutaXML);

            //Si los datos cargados de $rutaXML no se validan con el XSD proporcionado lanzamos una excepcion creada por nosotros
            if(!$datosBD->schemaValidate($rutaXSD)){
                throw new Exception("Error en la validacion del XML con su XSD");    
            }
            //si no se lanza la excepción el atributo conexion de la clase, pasa a ser lo que reciba de la funcion conexionConBD()
            $this->conexion = $this->conexionConBD($datosBD);        
        }
}


   
    //Esta funcion crea y devuelve un PDO
    private function conexionConBD($datosBD){
        //Para obtener los datos que necesitamos para la conexion, llamamos a la función introducirDatos()
        $datos_conexion = $this->introducirDatos($datosBD);

        try {
            //con los datos recibidos creamos las variables para introducirlo de una manera mas limpia dentro de new PDO()
            //el nombre dsn es el nombre que recibe el identificador utilizado en conexiones a bases de datos.
            $dsn = "{$datos_conexion['tipo']}:{$datos_conexion['nombre']};{$datos_conexion['host']}";
            $administrador= $datos_conexion['usuario'];
            $contrasenia= $datos_conexion['contrasenia'];

            //creamos la conexion con la base de datos introduciendo las variebles que hemos creado anteriormente
            $base_de_datos= new PDO($dsn,$administrador,$contrasenia);

            //devolvemos  la conexion con la base de datos
            return $base_de_datos;

        //en el caso de que se genere algun error, lanzamos un mensaje con excepcion
        } catch (PDOException $e) {
            echo "Error con la base de datos --> " . $e->getMessage();
        }

    }

    //en esta funcion creamos los datos que vamos a introducir en la clase PDO en la anterior funcion, estos datos se consiguen del xml
    private function introducirDatos($datosBD){

        /* La clase DOMXPath es utilizada para hacer consultas a un documento XML o 
        HTML usando el lenguaje XPath. XPath es un lenguaje utilizado para navegar a 
        través de los nodos de un documento XML y seleccionar elementos específicos.*/
        $xpath = new DOMXpath($datosBD);

        //almacenamos dentro de la variable, los datos que utilizaremos
        //se realiza una consulta XPath para seleccionar todos los elementos del documento XML.
        //item() -> obtiene el primer elemento que coincide con la consulta (si hay más de uno).
        $datos_conexion = [
            'tipo' => $xpath->query("//Tipo")->item(0)->nodeValue,
            'nombre' => "dbname=" . $xpath->query("//Nombre")->item(0)->nodeValue,
            'host' => "host=" . $xpath->query("//Host")->item(0)->nodeValue,
            'usuario' => $xpath->query("//Usuario")->item(0)->nodeValue,
            'contrasenia' => $xpath->query("//Contrasenia")->item(0)->nodeValue
        ];
        //devolvemos el array asociativo con los datos
        return $datos_conexion;
    }

    //con esta funcion obtenemos cuando lo necesitemos la conexion con la base de datos
    public function getConexion(): PDO {
        return $this->conexion;
    }

}
