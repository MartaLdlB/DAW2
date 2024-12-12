<?php
    
    require_once "conexion_bd.php";

    try {
		$conexionBD = new ConectarBaseDeDatos();
		$base_de_datos = $conexionBD->getConexion();
		
	} catch (Exception $e) {
		 echo "Error: " . $e->getMessage();
	}

    function consultaObtenerTodosProductos(){
        global $base_de_datos;
        $consultaTodos=$base_de_datos->prepare("SELECT id_producto, nombre_producto, descripcion_producto
                                                FROM productos");
        $consultaTodos->execute();
        $productos = $consultaTodos->fetchAll(PDO::FETCH_ASSOC);
        return $productos;
    }    
    
    $datos = json_encode(consultaObtenerTodosProductos());
    echo $datos;