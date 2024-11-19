<?php

$rutaXML="../conexion_base_de_datos/datos_conexion.xml";
$rutaXSD="../conexion_base_de_datos/schema.xsd";

if(!file_exists($rutaXML)){
    throw new Exception ("El archivo XML en la ruta indicada no existe");
}elseif (!file_exists($rutaXSD)) {
    throw new Exception("El archivo XSD en la ruta indicada no existe");
}else{

    $base_de_datos= new DOMDocument();

    $base_de_datos=load($rutaXML);

    if(!$base_de_datos->schemaValidate($rutaXSD)){
        throw new Exception("Error en la validacion del XML con su XSD");
        
    }


}
function conexionConBD($datos_conexion){

    	try {
            $dsn = "{$datos_conexion['tipo']}:{$datos_conexion['nombre']};{$datos_conexion['host']"
        } catch (\Throwable $th) {
            //throw $th;
        }

}

function introducirDatos($base_de_datos){

    $xpath = new DOMXpath($base_de_datos);


    $datos_conexion = [
        'tipo' => $xpath->query("//Tipo")->item(0)->nodeValue,
        'nombre' => "dbname=" . $xpath->query("//Nombre")->item(0)->nodeValue,
        'host' => "host=" . $xpath->query("//Host")->item(0)->nodeValue,
        'usuario' => $xpath->query("//Usuario")->item(0)->nodeValue,
        'contrasena' => $xpath->query("//Contrasena")->item(0)->nodeValue
    ];
    
    return $datos_conexion;
}

