<?php

require_once "conexion_bd.php";

    try {
        $conexionBD = new ConectarBaseDeDatos();
        $base_de_datos = $conexionBD->getConexion();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }


session_start();


//funcion para login
function consultaLogin($usuario, $contrasenia){

    // Preparamos la consulta
    $consulta = $base_de_datos->prepare("SELECT correo, contrasenia, id_empresa
    FROM credenciales
    WHERE correo = :correo AND contrasenia = :contrasenia");

    // Enlazamos los parámetros
    $consulta->bindParam(":correo", $usuario, PDO::PARAM_STR);
    $consulta->bindParam(":contrasenia", $contrasenia, PDO::PARAM_STR); 
    //si se ejecuta correctamente quiere decir que hay un usuario con estos parametros
    $consulta->execute();

    // Obtenemos los datos en un array asociativo
    $empresa = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($empresa) {
        //Almacenamos el id_empresa en la variable global para poder usarla en todo el proyecto
        $_SESSION['id_empresa'] = $empresa['id_empresa']; 
        //devolvemos true si se valida correctamente con la base de datos
        return true;
    }else{
        //devolvemos false si el usuario introducido no existe en nuestra base de datos
        return false;
    }
}

function consultaObtenerTodosProductos(){

    $consultaTodos=$base_de_datos->prepare("SELECT *
                                            FROM productos");
    $consultaTodos->execute();
    $productos = $consultaTodos->fetchAll(PDO::FETCH_ASSOC);
    return $productos;
}

function consultaObtenerProductosCategoria(){

    $consultaFiltro=$base_de_datos->prepare("SELECT * 
                                            FROM productos
                                            WHERE id_categorias = :categoria");

    $consultaFiltro->bindParam(":categoria", $categoria, PDO::PARAM_INT);
    $consultaFiltro->execute();
    $productos = $consultaFiltro->fetchAll(PDO::FETCH_ASSOC);

}

