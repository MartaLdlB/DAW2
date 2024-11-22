<?php
//dentro de este script necesitamos 
require_once "conexion_bd.php";
require_once "enviar_email.php";

    try {

        $conexionBD = new ConectarBaseDeDatos();
        $base_de_datos = $conexionBD->getConexion();
    
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    

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
                            <td>" . number_format($producto['precio_producto'], 2) . "€</td>
                            <td>" . htmlspecialchars($producto['cantidad_producto']) . "</td>
                            <td>" . number_format($subtotal, 2) . "€</td>
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
        enviarEmail($correo_departamento, $facturaHTML);
        enviarEmail($correo_cuenta, $facturaHTML);

        // Actualizar la tabla pedidos
        $actualizarTablaPedidos = $base_de_datos->prepare("INSERT INTO pedidos (estado_de_envio, cuenta_de_pago, fecha_pedido, id_carrito)
                                                            VALUES ('Pendiente', 'Sin especificar', NOW(), :id_carrito)");

                                                        

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
