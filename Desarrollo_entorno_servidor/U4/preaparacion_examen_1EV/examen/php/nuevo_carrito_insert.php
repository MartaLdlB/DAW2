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

    $consultaCarritoActivo = $base_de_datos->prepare("SELECT id_carrito
                                                        FROM carrito
                                                        WHERE id_empresa = :id_empresa
                                                        AND estado_carrito = 'activo'");

    $consultaCarritoActivo->bindParam(":id_empresa", $_SESSION['id_empresa'], PDO::PARAM_INT);

    //si al ejecutar la consulta no encuentra un carrito para una empresa con el 
    //estado activo
    if(!$consultaCarritoActivo->execute()){
        
        $insertarCarrito = $base_de_datos->prepare("INSERT INTO carrito (id_empresa, estado_carrito)
                                                    VALUES (:id_empresa, 'activo')");

        $insertarCarrito->bindParam(":id_empresa", $_SESSION['id_empresa'], PDO::PARAM_INT);
        $insertarCarrito->execute();

         /*lastInsertId() es un método de PDO que devuelve el último
        ID generado automáticamente por una consulta INSERT en una
        base de datos que utiliza claves primarias autoincrementales
        Por lo que guardamos la id_carrito en la variable sesion*/
        $_SESSION['id_carrito'] = $base_de_datos->lastInsertId();

    } else {

        //si existe un carrito activo para el id_empresa
        //Comprobamos si ese carrito tiene productos
        $consultaComprobarProductoCarrito=$base_de_datos->prepare("SELECT id_producto 
                                                                    FROM detalle_carrito
                                                                    WHERE id_carrito = :id_carrito");

        //indicamos el
        //$consultaComprobarProductoCarrito->bindParam(":id_producto", $_POST['id_producto'], PDO::PARAM_INT);
        $consultaComprobarProductoCarrito->bindParam(":id_carrito", $_SESSION['id_carrito'], PDO::PARAM_INT);


        $consultaComprobarProductoCarrito->execute();

        $tieneProductos = ($consultaComprobarProductoCarrito->rowCount() >= 1);

        if(!$tieneProductos){
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
   

    }
    header('Location: ../php/inicio.php');
}
?>