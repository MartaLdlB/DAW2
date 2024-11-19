<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa de Papelería</title>
    <link rel="stylesheet" href="../css/css_index.css">
</head>
<body>
    <header>
        <div class="contenedor">
            <div class="botonSalir"><button><a href="../php/logout.php">Cerrar sesión</a></button></div>
            <div><h1>Empresa de Papelería</h1></div>
            <div class="botonCarrito"><button><a href="../html/carrito.php">Ver carrito</a></button></div>
        </div>
    </header>

    <?php
    session_start();

    // Verificar que la sesión tenga la empresa definida
    if (!isset($_SESSION['id_empresa'])) {
        echo "<p>Error: Empresa no identificada. Inicia sesión.</p>";
        exit();
    }

    try {
        $datos_conexion = "mysql:dbname=mydb;host=127.0.0.1";
        $administrador = "root";
        $pw = "";

        $base_de_datos = new PDO($datos_conexion, $administrador, $pw);
    } catch (PDOException $e) {
        echo "<p>Error con la base de datos: </p>" . $e->getMessage();
        exit();
    }

    // Obtener el nombre de la empresa
    $consultaConocerNombreEmpresa = $base_de_datos->prepare(
        "SELECT razon_social FROM empresas WHERE id_empresa = :id_empresa"
    );
    $consultaConocerNombreEmpresa->bindParam(":id_empresa", $_SESSION['id_empresa'], PDO::PARAM_INT);
    $consultaConocerNombreEmpresa->execute();
    $nombreEmpresa = $consultaConocerNombreEmpresa->fetch(PDO::FETCH_ASSOC)['razon_social'] ?? 'Cliente';

    echo "<h2>Bienvenido, " . htmlspecialchars($nombreEmpresa) . "</h2>";

    // Función para mostrar productos
    function mostrarProductos($productos) {
        foreach ($productos as $producto) {
            echo "<div>";
            echo "<p>Nombre: " . htmlspecialchars($producto['nombre_producto']) . "</p>";
            echo "<p>Descripción: " . htmlspecialchars($producto['descripcion_producto']) . "</p>";
            echo "<p>Peso: " . htmlspecialchars($producto['peso_producto']) . " kg</p>";
            echo "<p>Tamaño: " . htmlspecialchars($producto['tamanio_producto']) . "</p>";
            echo "<p>Imagen: " . htmlspecialchars($producto['imagen_producto']) . "</p>";
            echo '<form action="carrito_insert.php" method="post">';
            echo '<input type="hidden" name="id_producto" value="' . htmlspecialchars($producto['id_producto']) . '">';
            echo '<label for="cantidad">Cantidad:</label>';
            echo '<input type="number" name="cantidad" id="cantidad" value="1" min="1">';
            echo '<input type="submit" value="Añadir al carrito">';
            echo '</form>';
            echo "</div>";
        }
    }

    // Consultas preparadas
    $consultaTodos = $base_de_datos->prepare("SELECT * FROM productos");
    $consultaFiltro = $base_de_datos->prepare("SELECT * FROM productos WHERE id_categorias = :categoria");

    // Manejo de filtros
    $categoria = $_POST['categoria'] ?? 1; // Por defecto, mostrar todos los productos
    $categoria = in_array($categoria, [1, 2, 3]) ? $categoria : 1;

    if ($categoria == 1) {
        echo "<h2>Todos los productos</h2>";
        $consultaTodos->execute();
        $productos = $consultaTodos->fetchAll(PDO::FETCH_ASSOC);
        mostrarProductos($productos);
    } else {
        $consultaFiltro->bindParam(":categoria", $categoria, PDO::PARAM_INT);
        $consultaFiltro->execute();
        $productos = $consultaFiltro->fetchAll(PDO::FETCH_ASSOC);
        echo $categoria == 2 ? "<h2>Artículos de papelería</h2>" : "<h2>Mobiliario de oficina</h2>";
        mostrarProductos($productos);
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="categoria">Selecciona una categoría:</label>
        <select name="categoria" id="categoria">
            <option value="1" <?php echo $categoria == 1 ? 'selected' : ''; ?>>Todo</option>
            <option value="2" <?php echo $categoria == 2 ? 'selected' : ''; ?>>Artículos de papelería</option>
            <option value="3" <?php echo $categoria == 3 ? 'selected' : ''; ?>>Mobiliario de oficina</option>
        </select>
        <button type="submit">Mostrar productos</button>
    </form>
</body>
</html>
