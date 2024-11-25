<?php

require_once "conexion_bd.php";

session_start();

    try {
        $conexionBD = new ConectarBaseDeDatos();
        $base_de_datos = $conexionBD->getConexion();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

//funcion para login
function consultaLogin($usuario, $contrasenia){
    global $base_de_datos;
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
    global $base_de_datos;
    $consultaTodos=$base_de_datos->prepare("SELECT *
                                            FROM productos");
    $consultaTodos->execute();
    $productos = $consultaTodos->fetchAll(PDO::FETCH_ASSOC);
    return $productos;
}

function consultaObtenerProductosCategoria($categoria){
    global $base_de_datos;
    $consultaFiltro=$base_de_datos->prepare("SELECT * 
                                            FROM productos
                                            WHERE id_categorias = :categoria");

    $consultaFiltro->bindParam(":categoria", $categoria, PDO::PARAM_INT);
    $consultaFiltro->execute();
    $productos = $consultaFiltro->fetchAll(PDO::FETCH_ASSOC);
    return $productos;
}


//funciones para factura.php
function obtenerDatosCarritoFactura(){
    global $base_de_datos;

    $id_carrito = $_SESSION['id_carrito'];
    $id_empresa = $_SESSION['id_empresa'];

    $consultaDatosProductos = $base_de_datos->prepare("SELECT dc.*, p.nombre_producto, p.precio_producto, 
                                                        p.descripcion_producto, p.tamanio_producto, p.peso_producto 
                                                        FROM detalle_carrito dc
                                                        INNER JOIN productos p ON dc.id_producto = p.id_producto
                                                        WHERE dc.id_carrito = :id_carrito");

    $consultaDatosProductos->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
    $consultaDatosProductos->execute();
    $productosCarrito = $consultaDatosProductos->fetchAll(PDO::FETCH_ASSOC);

    return $productosCarrito;

}

function obtenerCorreoDepartamento(){
    global $base_de_datos;
    $consultaCorreoDepartamento = $base_de_datos->prepare("SELECT correo_departamento
                                                            FROM empresas
                                                            WHERE id_empresa = :id_empresa");
    $consultaCorreoDepartamento->bindParam(":id_empresa", $_SESSION['id_empresa'], PDO::PARAM_INT);
    $consultaCorreoDepartamento->execute();
    $correo_departamento = $consultaCorreoDepartamento->fetch(PDO::FETCH_COLUMN);

    return $correo_departamento;
}

function obtenerCorreoCuenta(){
    global $base_de_datos;
    $consultaCorreoCuenta = $base_de_datos->prepare("SELECT correo
                                                     FROM credenciales
                                                     WHERE id_empresa = :id_empresa");
    $consultaCorreoCuenta->bindParam(":id_empresa",$_SESSION['id_empresa'], PDO::PARAM_INT);
    $consultaCorreoCuenta->execute();
    $correo_cuenta = $consultaCorreoCuenta->fetch(PDO::FETCH_COLUMN);
    return $correo_cuenta;
}

function actualizarTablaPedidos(){
    global $base_de_datos;
    $actualizarTablaPedidos = $base_de_datos->prepare("INSERT INTO pedidos (estado_de_envio, cuenta_de_pago, fecha_pedido, id_carrito)
                                                         VALUES ('Pendiente', 'Sin especificar', NOW(), :id_carrito)");

    $actualizarTablaPedidos->bindParam(":id_carrito", $_SESSION['id_carrito'], PDO::PARAM_INT);
    $actualizarTablaPedidos->execute();
}

function actualizarTablaCarrito(){
    global $base_de_datos;
    $cambiarEstadoCarrito = $base_de_datos->prepare("UPDATE carrito 
                                                    SET estado_carrito = 'completado'
                                                    WHERE id_carrito = :id_carrito");
    $cambiarEstadoCarrito->bindParam(":id_carrito", $_SESSION['id_carrito'], PDO::PARAM_INT);
    $cambiarEstadoCarrito->execute();
}

/************************************************************************************************/
//consultas de carrito_insert

function consultaCarritoActivo(){

    global $base_de_datos;

    $id_empresa = $_SESSION['id_empresa'];

    $consultaCarritoActivo = $base_de_datos->prepare("SELECT id_carrito
                                                        FROM carrito
                                                        WHERE id_empresa = :id_empresa
                                                        AND estado_carrito = 'activo'");

    $consultaCarritoActivo->bindParam(":id_empresa",$id_empresa, PDO::PARAM_INT);
    $consultaCarritoActivo->execute();

    // Retorna un solo resultado si existe el carrito activo
    return $consultaCarritoActivo->fetch(PDO::FETCH_ASSOC);
}


function insertarCarritoActivo(){
    global $base_de_datos;

    $id_empresa = $_SESSION['id_empresa'];

    $insertarCarrito = $base_de_datos->prepare("INSERT INTO carrito (id_empresa, estado_carrito)
                                                     VALUES (:id_empresa, 'activo')");
    $insertarCarrito->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
    $insertarCarrito->execute();


    /*lastInsertId() es un método de PDO que devuelve el último
    ID generado automáticamente por una consulta INSERT en una
    base de datos que utiliza claves primarias autoincrementales
    Por lo que guardamos la id_carrito en la variable sesion*/
    $_SESSION['id_carrito'] = $base_de_datos->lastInsertId();

}


function comprobarProductoCarrito($id_producto,$id_carrito){
    global $base_de_datos;

    $consultaComprobarProductoCarrito = $base_de_datos->prepare("SELECT id_producto 
                                                                    FROM detalle_carrito
                                                                    WHERE id_carrito = :id_carrito
                                                                    AND id_producto = :id_producto");
    $consultaComprobarProductoCarrito->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
    $consultaComprobarProductoCarrito->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
    $consultaComprobarProductoCarrito->execute();

    // Retorna true si el producto ya está en el carrito
    return $consultaComprobarProductoCarrito->fetch(PDO::FETCH_ASSOC) !== false;
}

function insertarProductos($id_producto,$cantidad_producto){
    global $base_de_datos;

    // Comprobamos si el producto ya existe en el carrito
    if (comprobarProductoCarrito($id_producto, $id_carrito)) {
        // Si ya está, actualizamos la cantidad
        actualizarCantidad($id_producto, $cantidad_producto);
    } else {
        // Si no está, insertamos el producto
        $insertarProductos = $base_de_datos->prepare("INSERT INTO detalle_carrito (id_producto, id_carrito, cantidad_producto)
                                                        VALUES (:id_producto, :id_carrito, :cantidad_producto)");
        $insertarProductos->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
        $insertarProductos->bindParam(":id_carrito", $_SESSION['id_carrito'], PDO::PARAM_INT);
        $insertarProductos->bindParam(":cantidad_producto", $cantidad_producto, PDO::PARAM_INT);
        $insertarProductos->execute();
    }
}


function actualizarCantidad($id_producto,$cantidad_producto){
    global $base_de_datos;

    $actualizarCantidad = $base_de_datos->prepare("UPDATE detalle_carrito 
                                                    SET cantidad_producto = cantidad_producto + :cantidad_producto 
                                                    WHERE id_carrito = :id_carrito
                                                    AND id_producto = :id_producto");
    $actualizarCantidad->bindParam(":cantidad_producto", $cantidad_producto, PDO::PARAM_INT);
    $actualizarCantidad->bindParam(":id_carrito",$_SESSION['id_carrito'], PDO::PARAM_INT);
    $actualizarCantidad->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
    $actualizarCantidad->execute();

}
/****************************************************************/
 