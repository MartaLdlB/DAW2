<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>
<body>
    <?php
    session_start();

    try {
        $datos_conexion = "mysql:dbname=mydb;host=127.0.0.1";
        $administrador = "root";
        $pw = "";

        $base_de_datos = new PDO($datos_conexion, $administrador, $pw);
    } catch (PDOException $e) {
        echo "<p>Error con la base de datos: </p>" . $e->getMessage();
        exit();
    }

    if (isset($_SESSION['id_carrito'])) {
        $id_carrito = $_SESSION['id_carrito'];

       /* $obtenerProductosCarrito = $base_de_datos->prepare("SELECT * 
                                                            FROM detalle_carrito 
                                                            WHERE id_carrito = :id_carrito");

        $obtenerProductosCarrito->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
        $obtenerProductosCarrito->execute();

      
        // Obtenemos un array asociativo con los productos en el carrito donde tenemos los id_productos
        $productosCarrito = $obtenerProductosCarrito->fetchAll(PDO::FETCH_ASSOC);

        //ahora necesitamos los datos de estos productos
          $datosProducto = $base_de_datos->prepare("SELECT *
                                                FROM productos
                                                WHERE id_producto = :id_producto");

        $datosProducto->bindParam("id_producto", $productosCarrito['id_producto'],PDO::PARAM_INT);

        $datosProducto->execute();
        */

        $consultaDatosProductos= $base_de_datos->prepare("
                                                    SELECT dc.*, p.nombre_producto, p.precio, p.descripcion_producto, p.tamanio_producto 
                                                    FROM detalle_carrito dc
                                                    INNER JOIN productos p ON dc.id_producto = p.id_producto
                                                    WHERE dc.id_carrito = :id_carrito");
         $consultaDatosProductos->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
         $consultaDatosProductos->execute();
         $productosCarrito = $consultaDatosProductos->fetchAll(PDO::FETCH_ASSOC);

        //contamos los elementos del array, en el caso de ser mayor a 0
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
                        <td>" . ($producto['nombre_producto']) . "</td>
                        <td>" . ($producto['descripcion_producto']) . "</td>
                        <td>" . ($producto['peso_producto']) . "</td>
                        <td>" . ($producto['tamanio_producto']) . "</td>
                        <td>" . ($producto['precio']) . "</td>
                        <td>" . ($producto['cantidad_producto']) . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay productos en el carrito.</p>";
        }
    } else {
        echo "<p>Carrito no definido.</p>";
    }
    ?>
</body>
</html>
