<?php

require_once "consultas.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibimos los datos del producto
    $id_producto = $_POST['id_producto'];
    $cantidad_producto = $_POST['cantidad'];

    // Comprobamos si ya existe un carrito activo para la empresa
    $carritoActivo = consultaCarritoActivo();

    if (!$carritoActivo) {
        // Si no existe un carrito activo, lo creamos
        insertarCarritoActivo();
        // Recuperamos el carrito recién creado desde la sesión
        $carritoActivo = consultaCarritoActivo();
    }

    // Obtenemos el ID del carrito activo
    $_SESSION['id_carrito'] = $carritoActivo['id_carrito'];

    // Comprobamos si el producto ya existe en el carrito
    if (comprobarProductoCarrito($id_producto, $id_carrito)) {
        // Si ya existe, actualizamos la cantidad del producto
        actualizarCantidad($id_producto, $cantidad_producto);
    } else {
        // Si no existe, lo insertamos como un nuevo producto en el carrito
        insertarProductos($id_producto, $cantidad_producto);
    }

    // Redirigimos al inicio después de la operación
    header('Location: ../php/index.php');
}

?>
