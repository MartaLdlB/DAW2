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
    //iniciamos sesion para tener acceso a la variable global $_SESSION
    session_start();
    /*require_once se utiliza para incluir y utilizar un archivo solo una vez durante la ejecución de un script.
    -Si el archivo ya ha sido incluido anteriormente en el script, require_once no lo vuelve a incluir. */
    require_once "../php/conexion_bd.php";

    //Realizamos la conexion con la base de datos, donde recibe los datos de conexión desde un xml
    try {
        /*LLamamos a la clase ConectarBaseDeDatos donde dentro de su constructor indicamos
        los datos de donde se encuentra el xml*/
        $conexionBD = new ConectarBaseDeDatos();
        //El acceso a la base de datos, se almacena dentro de la variables $base_de_datos
        $base_de_datos = $conexionBD->getConexion();
    } catch (Exception $e) {
        echo "Error con la conexión a la base de datos: " . $e->getMessage();
    }

    /*en el caso de que haya un problema y no se haya introducido una sesion, no se almacenaria
    el id_empresa no se habría guardado en la variable global, por lo que mostraria este mensaje*/
    if (!isset($_SESSION['id_empresa'])) {
        echo("<p>Error: No se ha iniciado sesión correctamente.</p>");
    }
    /*en el caso de que si que exista id_empresa dentro de la variable $_SESSION, almacenamos
    su valor dentro de la variable con su mismo nombre, esto lo hacemos para cuando lo utilicemos mas
    adelante, sea mas sencillo acceder a este dato, aun que siempre, hasta que finalice la sesión
    quedará guardado dentro de $_SESSION*/
    $id_empresa = $_SESSION['id_empresa'];

    //En el caso de que la variable $_SESSION tenga almacenado el id_carrito, indica que ya hay un carrito
    if (isset($_SESSION['id_carrito'])) {
        //guardamos en una variable este dato para tener un acceso mas sencillo
        $id_carrito = $_SESSION['id_carrito'];

        /*verificamos si el carrito está activo, ya que los carritos tienen dos estados, activo o completado
        Como una empresa puede tener varios carritos pero solo uno activo, ya que una vez que finalizan el pedido, este 
        dato se actualiza*/
        $consultaCarritoActivo = $base_de_datos->prepare("SELECT id_carrito
                                                          FROM carrito
                                                          WHERE id_empresa = :id_empresa
                                                          AND estado_carrito = 'activo'");
        $consultaCarritoActivo->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $consultaCarritoActivo->execute();

        /*si al ejecutar la consulta, rowCount() no cuenta nada, indica que no tenemos ningún carrito definido,
        el carrito se define en el momento en el que el usuario que está dentro de la sesion empieza a añadir
        productos*/
        if ($consultaCarritoActivo->rowCount() == 0) {
            echo "<p>Carrito no definido</p>";
        } else {
            //en el caso de que si exista un carrito activo para la empresa, obtenemos los productos del carrito
            $consultaDatosProductos = $base_de_datos->prepare("SELECT dc.*, p.nombre_producto, p.precio_producto, 
                                                               p.descripcion_producto, p.tamanio_producto, p.peso_producto 
                                                               FROM detalle_carrito dc
                                                               INNER JOIN productos p ON dc.id_producto = p.id_producto
                                                               WHERE dc.id_carrito = :id_carrito");
            $consultaDatosProductos->bindParam(":id_carrito", $id_carrito, PDO::PARAM_INT);
            $consultaDatosProductos->execute();
            //y almacenamos la informaion en un array asociativo
            $productosCarrito = $consultaDatosProductos->fetchAll(PDO::FETCH_ASSOC);

            //mostramos los productos si existen dentro del carrito
            if (count($productosCarrito) > 0) {
                //los imprimimos dentro de una tabla
                echo "<table border='1'>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Peso</th>
                            <th>Tamaño</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                        </tr>";
                //por cada producto se va añadiendo una fila nueva, lo que permite esto es ver el carrito actualizado cada vez que
                //se incluye un producto nuevo
                // htmlspecialchars() se utiliza para convertir caracteres especiales en una cadena a sus equivalentes en entidades HTML,
                //esto evita errores de conversión
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
                echo "<p>No hay productos en el carrito</p>";
            }
        }
    } else {
        echo "<p>Error: No hay un carrito asociado a la sesión</p>";
    }
    ?>
    <!--Formulario que finaliza el carrito -->
    <form action="../php/factura.php" method="POST">
        <input type="submit" value="Finalizar carrito">
    </form>
</body>
</html>
