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
        <div class="botonSalir"><button><a href="logout.php">Cerrar sesión</a></button></div>
        <div><h1>Empresa de papeleria</h1></div>
        <div class="botonCarrito"><button><a href="carrito.php">Ver carrito</a></button></div>
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
                foreach ($productos as $producto) {
                    echo "<div>".
                    "<p>Nombre:".($producto['nombre_producto'])."</p>".
                    "<p>".($producto['descripcion_producto'])."</p>".
                    "<p>".($producto['peso_producto'])."</p>".
                    "<p>".($producto['tamanio_producto'])."</p>".
                    "<p>".($producto['imagen_producto']);
                    echo '<form action="carrtito.php" method="post">';
                    echo '<label for="añadir">Añadir</label>';
                    echo '<input type="number" name="cantidad" id="cantidad" value="1">';
                    echo '<input type="submit" value="Añadir">';
                    echo '</form>';
                    echo"</div>";
                }
    }
        
       

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST['categoria'])){
            $categoria=$_POST['categoria'];
        }else{
            $categoria=1;
        }
   
     if ($categoria == 1) {
            echo "<h2>Todos los productos</h2>";
        } elseif ($categoria == 2) {
            echo "<h2>Artículos de papelería</h2>";
        } elseif ($categoria == 3) {
            echo "<h2>Mobiliario de oficina</h2>";
        }
        

    if($categoria==1 || $_SERVER["REQUEST_METHOD"] != "POST"){
        //creamos un array asociativo con los productos
        $consultaTodos->execute();
    $productos = $consultaTodos->fetchAll(PDO::FETCH_ASSOC);
    echo "<h2>Todos los productos</h2>";
        foreach ($productos as $producto) {
            echo "<div>".
            "<p>Nombre:".($producto['nombre_producto'])."</p>".
            "<p>".($producto['descripcion_producto'])."</p>".
            "<p>".($producto['peso_producto'])."</p>".
            "<p>".($producto['tamanio_producto'])."</p>".
            "<p>".($producto['imagen_producto']);
            echo '<form action="carrtito.php" method="post">';
            echo '<label for="añadir">Añadir</label>';
            echo '<input type="number" name="cantidad" id="cantidad" value="1">';
            echo '<input type="submit" value="Añadir">';
            echo '</form>';
            echo"</div>";
        }
       
    }elseif ($categoria==2 || $categoria==3) {
        
        $consultaFiltro->bindParam(":categoria",$categoria,PDO::PARAM_INT);
        $consultaFiltro->execute();
        $productos = $consultaFiltro->fetchAll(PDO::FETCH_ASSOC);
        foreach ($productos as $producto) {
            echo "<div>".
                "<p>Nombre:".($producto['nombre_producto'])."</p>".
                "<p>".($producto['descripcion_producto'])."</p>".
                "<p>".($producto['peso_producto'])."</p>".
                "<p>".($producto['tamanio_producto'])."</p>".
                "<p>".($producto['imagen_producto']);
                echo '<form action="carrtito.php" method="post">';
                echo '<label for="añadir">Añadir</label>';
                echo '<input type="number" name="cantidad" id="cantidad" value="1">';
                echo '<input type="submit" value="Añadir">';
                echo '</form>';
                echo"</div>";
            }
        }
    }

    ?>
    
</body>

</html>
