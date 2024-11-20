<?php

try {
    $datos_conexion = "mysql:dbname=mydb;host=127.0.0.1";
    $administrador = "root";
    $pw = "";

    $base_de_datos = new PDO($datos_conexion, $administrador, $pw);
} catch (PDOException $e) {
    die("<p>Error con la base de datos: </p>" . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();

    $id_carrito = $_SESSION['id_carrito'];
    $id_empresa = $_SESSION['id_empresa'];

    // Consultar productos en el carrito
    $consultaDatosProductos = $base_de_datos->prepare("SELECT dc.*, p.nombre_producto, p.precio_producto, 
                                                       p.descripcion_producto, p.tamanio_producto, p.peso_producto 
                                                       FROM detalle_carrito dc
                                                       INNER JOIN productos p ON dc.id_producto = p.id_producto
                                                       WHERE dc.id_carrito = :id_carrito");
    $consultaDatosProductos->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
    $consultaDatosProductos->execute();
    $productosCarrito = $consultaDatosProductos->fetchAll(PDO::FETCH_ASSOC);

    // Generar HTML de la factura
    $facturaHTML = "<h1>Factura</h1>";
    $facturaHTML .= "<p><strong>Carrito ID:</strong> $id_carrito</p>";
    $facturaHTML .= "<table border='1' cellpadding='10'>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Peso</th>
                            <th>Tamaño</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>";

    $totalFactura = 0;

    foreach ($productosCarrito as $producto) {
        $subtotal = $producto['precio_producto'] * $producto['cantidad_producto'];
        $totalFactura += $subtotal;

        $facturaHTML .= "<tr>
                            <td>" . htmlspecialchars($producto['nombre_producto']) . "</td>
                            <td>" . htmlspecialchars($producto['descripcion_producto']) . "</td>
                            <td>" . htmlspecialchars($producto['peso_producto']) . "</td>
                            <td>" . htmlspecialchars($producto['tamanio_producto']) . "</td>
                            <td>$" . number_format($producto['precio_producto'], 2) . "</td>
                            <td>" . htmlspecialchars($producto['cantidad_producto']) . "</td>
                            <td>$" . number_format($subtotal, 2) . "</td>
                        </tr>";
    }

    $facturaHTML .= "<tr>
                        <td colspan='6'><strong>Total</strong></td>
                        <td><strong>$" . number_format($totalFactura, 2) . "</strong></td>
                    </tr>
                    </table>";

    // Obtener correo del departamento
    $consultaCorreoDepartamento = $base_de_datos->prepare("SELECT correo_departamento
                                                           FROM empresas
                                                           WHERE id_empresa = :id_empresa");
    $consultaCorreoDepartamento->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
    $consultaCorreoDepartamento->execute();
    $correo_departamento = $consultaCorreoDepartamento->fetch(PDO::FETCH_COLUMN);

    // Obtener correo de la cuenta que realiza el pedido
    $consultaCorreoCuenta = $base_de_datos->prepare("SELECT correo
                                                     FROM credenciales
                                                     WHERE id_empresa = :id_empresa");
    $consultaCorreoCuenta->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
    $consultaCorreoCuenta->execute();
    $correo_cuenta = $consultaCorreoCuenta->fetch(PDO::FETCH_COLUMN);

    if ($correo_cuenta && $correo_departamento) {
        // enviar_email($correo_departamento, $facturaHTML);
        // enviar_email($correo_cuenta, $facturaHTML);

        // Actualizar la tabla pedidos
        $actualizarTablaPedidos = $base_de_datos->prepare("UPDATE pedidos 
                                                        SET estado_de_envio = 'pendiente',
                                                        cuenta_de_pago = 'sin especificar',
                                                        fecha_pedido = NOW(),
                                                        id_carrito = :id_carrito
                                                        WHERE id_carrito = :id_carrito");

        $actualizarTablaPedidos->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
        $actualizarTablaPedidos->execute();

        $actualizarTablaPedidos->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
        $actualizarTablaPedidos->execute();

        // Actualizar el estado del carrito a "completado"
        $cambiarEstadoCarrito = $base_de_datos->prepare("UPDATE carrito 
                                                         SET estado_carrito = 'completado'
                                                         WHERE id_carrito = :id_carrito");
        $cambiarEstadoCarrito->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
        $cambiarEstadoCarrito->execute();
    } else {
        echo "Error al confirmar el pedido.";
    }

    header("Location: inicio.php");
}
?>
