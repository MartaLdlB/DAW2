<?php
// Iniciamos sesión para usar $_SESSION
session_start();

try {
    $datos_conexion = "mysql:dbname=mydb;host=127.0.0.1";
    $administrador = "root";
    $pw = "";

    $base_de_datos = new PDO($datos_conexion, $administrador, $pw);
    $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("<p>Error con la base de datos: </p>" . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Consulta para verificar si hay un carrito activo para la empresa
    $consultaCarritoActivo = $base_de_datos->prepare("SELECT id_carrito
                                                        FROM carrito
                                                        WHERE id_empresa = :id_empresa
                                                        AND estado_carrito = 'activo'");


    $consultaCarritoActivo->bindParam(":id_empresa", $_SESSION['id_empresa'], PDO::PARAM_INT);
    $consultaCarritoActivo->execute();

    // Intentamos obtener un carrito activo
    $carritoActivo = $consultaCarritoActivo->fetch(PDO::FETCH_ASSOC);

    if (!$carritoActivo) {
        // Si no hay carrito activo, creamos uno nuevo
        $insertarCarrito = $base_de_datos->prepare("INSERT INTO carrito (id_empresa, estado_carrito)
                                                    VALUES (:id_empresa, 'activo')");
        $insertarCarrito->bindParam(":id_empresa", $_SESSION['id_empresa'], PDO::PARAM_INT);
        $insertarCarrito->execute();

        /*lastInsertId() es un método de PDO que devuelve el último
        ID generado automáticamente por una consulta INSERT en una
        base de datos que utiliza claves primarias autoincrementales*/
        $_SESSION['id_carrito'] = $base_de_datos->lastInsertId();
    } else {
        // Si ya existe un carrito activo, usamos su ID
        $_SESSION['id_carrito'] = $carritoActivo['id_carrito'];
    }

    $consultaComprobarProductoCarrito=$base_de_datos->prepare("SELECT id_producto 
                                        FROM detalle_carrito
                                        WHERE id_producto = :id_producto
                                        AND id_carrito = :id_carrito");

    $consultaComprobarProductoCarrito->bindParam(":id_producto", $_POST['id_producto'], PDO::PARAM_INT);
    $consultaComprobarProductoCarrito->bindParam(":id_carrito", $_SESSION['id_carrito'], PDO::PARAM_INT);


    $consultaComprobarProductoCarrito->execute();

    if($consultaComprobarProductoCarrito->rowCount() == 0){
         // Inserción del producto en el detalle del carrito
        $insertarProductos = $base_de_datos->prepare("INSERT INTO detalle_carrito (id_producto, id_carrito, cantidad_producto)
                                                    VALUES (:id_producto, :id_carrito, :cantidad_producto)");

        $insertarProductos->bindParam(":id_producto", $_POST['id_producto'], PDO::PARAM_INT);
        $insertarProductos->bindParam(":id_carrito", $_SESSION['id_carrito'], PDO::PARAM_INT);
        $insertarProductos->bindParam(":cantidad_producto", $_POST['cantidad'], PDO::PARAM_INT);
        $insertarProductos->execute();

    }else{
        $actualizarCantidad = $base_de_datos->prepare("UPDATE detalle_carrito 
                                                        SET cantidad_producto = cantidad_producto + :cantidad_producto 
                                                        WHERE id_carrito = :id_carrito
                                                        AND id_producto = :id_producto");

        $actualizarCantidad->bindParam(":id_carrito", $_SESSION['id_carrito'], PDO::PARAM_INT);
        $actualizarCantidad->bindParam(":id_producto", $_POST['id_producto'], PDO::PARAM_INT);
        $actualizarCantidad->execute();
    }
   
    header('Location: ../php/index.php');
}
?>
