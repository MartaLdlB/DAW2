<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="../css/css_carrito.css">
</head>
<body>
    <?php
    session_start();

    try {
        $datos_conexion = "mysql:dbname=mydb;host=127.0.0.1";
        $administrador = "root";
        $pw = "";

        $base_de_datos = new PDO($datos_conexion, $administrador, $pw);
        $base_de_datos->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "<p>Error con la base de datos: </p>" . $e->getMessage();
        exit();
    }

    if (!isset($_SESSION['id_empresa'])) {
        die("<p>Error: No se ha iniciado sesión correctamente.</p>");
    }

    $id_empresa = $_SESSION['id_empresa'];

    if (isset($_SESSION['id_carrito'])) {
        $id_carrito = $_SESSION['id_carrito'];

        // Verificar si el carrito está activo
        $consultaCarritoActivo = $base_de_datos->prepare("SELECT id_carrito
                                                          FROM carrito
                                                          WHERE id_empresa = :id_empresa
                                                          AND estado_carrito = 'activo'");
        $consultaCarritoActivo->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consultaCarritoActivo->execute();

        if ($consultaCarritoActivo->rowCount() == 0) {
            echo "<p>Carrito no definido.</p>";
        } else {
            // Obtener los productos del carrito
            $consultaDatosProductos = $base_de_datos->prepare("SELECT dc.*, p.nombre_producto, p.precio_producto, 
                                                               p.descripcion_producto, p.tamanio_producto, p.peso_producto 
                                                               FROM detalle_carrito dc
                                                               INNER JOIN productos p ON dc.id_producto = p.id_producto
                                                               WHERE dc.id_carrito = :id_carrito");
            $consultaDatosProductos->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
            $consultaDatosProductos->execute();
            $productosCarrito = $consultaDatosProductos->fetchAll(PDO::FETCH_ASSOC);

            // Mostrar los productos si existen
            if (count($productosCarrito) > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Peso</th>
                            <th>Tamaño</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                        </tr>";
                foreach ($productosCarrito as $producto) {
                    echo "<tr>
                            <td>" . htmlspecialchars($producto['nombre_producto']) . "</td>
                            <td>" . htmlspecialchars($producto['descripcion_producto']) . "</td>
                            <td>" . htmlspecialchars($producto['peso_producto']) . "</td>
                            <td>" . htmlspecialchars($producto['tamanio_producto']) . "</td>
                            <td>" . htmlspecialchars($producto['precio_producto']) . "</td>
                            <td>" . htmlspecialchars($producto['cantidad_producto']) . "</td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No hay productos en el carrito.</p>";
            }
        }
    } else {
        echo "<p>Error: No hay un carrito asociado a la sesión.</p>";
    }
    ?>

    <form action="../php/factura.php" method="POST">
        <input type="submit" value="Finalizar carrito">
    </form>
</body>
</html>
