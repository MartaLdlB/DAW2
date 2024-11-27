<?php

require_once "../conexion_base_de_datos/conexion_bd.php";


try {
    $conexionBD = new ConectarBaseDeDatos();
    $base_de_datos = $conexionBD->getConexion();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

function insertarCoche($modelo, $foto, $anio, $fabricante){
    global $base_de_datos;

    //Comprobamos si el fabricante ya existe
    $comprobarFabricante = $base_de_datos->prepare("SELECT id_fabricantes, nombre_fabricante 
                                                    FROM fabricantes 
                                                    WHERE nombre_fabricante = :nombre_fabricante");
    $comprobarFabricante->bindParam(":nombre_fabricante", $fabricante, PDO::PARAM_STR);
    $comprobarFabricante->execute();
    $fabricanteExistente = $comprobarFabricante->fetch(PDO::FETCH_ASSOC);

    if ($fabricanteExistente) {
        //Si existe, obtenemos el ID
        $id_fabricante = $fabricanteExistente['id_fabricantes'];
    } else {
        //Si no existe, lo insertamos
        $insertarFabricante = $base_de_datos->prepare("INSERT INTO fabricantes (nombre_fabricante) 
                                                        VALUES (:nombre_fabricante)");
        $insertarFabricante->bindParam(":nombre_fabricante", $fabricante, PDO::PARAM_STR);
        $insertarFabricante->execute();

        //Obtenemos el ID del nuevo fabricante
        $id_fabricante = $base_de_datos->lastInsertId();
    }

    //Insertamos el coche con el ID del fabricante
    $insertarCoche = $base_de_datos->prepare("INSERT INTO coches (modelo, foto, anio, id_fabricantes) 
                                              VALUES (:modelo, :foto, :anio, :id_fabricante)");
    $insertarCoche->bindParam(":modelo", $modelo, PDO::PARAM_STR);
    $insertarCoche->bindParam(":foto", $foto, PDO::PARAM_LOB); // Para datos binarios
    $insertarCoche->bindParam(":anio", $anio, PDO::PARAM_INT);
    $insertarCoche->bindParam(":id_fabricante", $id_fabricante, PDO::PARAM_INT);
    $insertarCoche->execute();
}

function obtenerTablaCoches(){
    global $base_de_datos;

        //Consultamos los coches con los datos de los fabricantes
        $obtenerCoches = $base_de_datos->prepare("SELECT coches.modelo, fabricantes.nombre_fabricante, coches.anio, coches.foto
                                                  FROM coches
                                                  INNER JOIN fabricantes 
                                                  ON coches.id_fabricantes = fabricantes.id_fabricantes");
        $obtenerCoches->execute();

        //Recuperamos todos los resultados en un array asociativo
        $tablaCoches = $obtenerCoches->fetchAll(PDO::FETCH_ASSOC);

        return $tablaCoches;

}
