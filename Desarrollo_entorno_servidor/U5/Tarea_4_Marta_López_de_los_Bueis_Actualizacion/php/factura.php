<?php
//dentro de este script necesitamos 
//require_once "conexion_bd.php";
//require_once "enviar_email.php";
require_once "consultas.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $productosCarrito=obtenerDatosCarritoFactura();

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

    $correo_departamento = obtenerCorreoDepartamento();

    // Obtener correo de la cuenta que realiza el pedido
    $correo_cuenta = obtenerCorreoCuenta();

    if ($correo_cuenta && $correo_departamento) {
       // enviarEmail($correo_departamento, $facturaHTML);
       // enviarEmail($correo_cuenta, $facturaHTML);

        // Actualizar la tabla pedidos
        actualizarTablaPedidos($id_carrito);
   
        // Actualizar el estado del carrito a "completado"
        actualizarTablaCarrito($id_carrito);

        
    } else {
        echo "Error al confirmar el pedido.";
    }

    header("Location: index.php");
}
?>
