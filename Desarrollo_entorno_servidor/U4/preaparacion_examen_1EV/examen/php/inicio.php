<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa de papeleria</title>
    <link rel="stylesheet" href="../css/css_index.css">
</head>
<body>
    <header>
        <div class="contenedor">
            
                <button><a href="../php/logout.php">Cerrar sesión</a></button>
            
            <div><h1>Empresa de papeleria</h1></div>
            
                <button><a href="../html/carrito.php">Ver carrito</a></button>
           
        </div>
    </header>
    <h2>Bienvenido</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="cambiar" value="1">
        <select name="categoria" id="categoria">
            <label for="categoria">Selecciona una categoria</label>
            <option value="1">Todo</option>
            <option value="2">Articulos de papeleria</option>
            <option value="3">Mobiliario de oficina</option>
        </select>
        <button type="submit">Mostrar productos</button>
    </form>
   

    <?php
    session_start();
    
    try{
         $datos_conexion="mysql:dbname=mydb;host=127.0.0.1";
    $administrador="root";
    $pw="";
        
    $base_de_datos=new PDO($datos_conexion,$administrador,$pw);

    /*Introducir datos de la conexion con la base de datos */

    }catch(PDOException $e){
        echo "<p>Error con la base de datos: </p>".$e->getMessage();
    }
   
    $consultaTodos=$base_de_datos->prepare("SELECT *
                                        FROM productos");

    $consultaFiltro=$base_de_datos->prepare("SELECT * 
                                            FROM productos
                                            WHERE id_categorias = :categoria");
    
    


    /*Desde el formulario enviamos un valor hidden con valor a 1 que se llama cambiar
    con isset($_POST["cambiar"]) comprobamos si este valor ya está almacenado en esa variable 
    llamada cambiar.
    Este valor no se envia hasta que no se pulsa el botón de enviar
    por lo que con este if, lo que hacemos es que si al iniciar la página no se pulsa el boton
    lo cual no guarda la variable, imprime todos los articulo de nuestra vase de datos
    en el momento en el que el usuario decide usar el filtro, el formulario envia este valor hidden
    por lo que cambia el estado de la variable cambiar y al recargar la pagina con $_SERVER["REQUEST_METHOD"]
    no llegaría a entrar en este if
    */
    if (!isset($_POST["cambiar"])) {
        $consultaTodos->execute();
        $productos = $consultaTodos->fetchAll(PDO::FETCH_ASSOC);
        echo "<h2>Todos los productos</h2>";
        mostrarProductos($productos);
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST['categoria'])){
            $categoria=$_POST['categoria'];
        }else{
            $categoria=1;
        }

        

    if($categoria==1 || $_SERVER["REQUEST_METHOD"] != "POST"){
        
        echo "<h2>Todos los productos</h2>";
        $consultaTodos->execute();
        //creamos un array asociativo con los productos
        $productos = $consultaTodos->fetchAll(PDO::FETCH_ASSOC);
        mostrarProductos($productos);
       
    }elseif ($categoria==2 || $categoria==3) {
        $consultaFiltro->bindParam(":categoria", $categoria, PDO::PARAM_INT);
        $consultaFiltro->execute();
        $productos = $consultaFiltro->fetchAll(PDO::FETCH_ASSOC);
        echo $categoria == 2 ? "<h2>Artículos de papelería</h2>" : "<h2>Mobiliario de oficina</h2>";
        mostrarProductos($productos);
        
        }
    }

    function mostrarProductos($productos) {
        echo "<div class='contenedor'>";
        foreach ($productos as $producto) {
            echo "<div>";
            echo "<p>Nombre: " .($producto['nombre_producto']) . "</p>";
            echo "<p>Descripción: " . ($producto['descripcion_producto']) . "</p>";
            echo "<p>Peso: " . ($producto['peso_producto']) . " kg</p>";
            echo "<p>Tamaño: " . ($producto['tamanio_producto']) . "</p>";
            echo "<p>Imagen: " . ($producto['imagen_producto']) . "</p>";
            echo '<form action="carrito_insert.php" method="post">';
            echo '<input type="hidden" name="id_producto" value="' . ($producto['id_producto']) . '">';
            echo '<label for="cantidad">Cantidad:</label>';
            echo '<input type="number" name="cantidad" id="cantidad" value="1" min="1">';
            echo '<input type="submit" value="Añadir al carrito">';
            echo '</form>';
            echo "</div>";
        }
         echo "</div>";
    }

    ?>
    
</body>

</html>