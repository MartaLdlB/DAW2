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
        <h1>Empresa de papeleria</h1>
    </header>
    <h2>Bienvenido</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
    
    
    $datos_conexion="mysql:dbname=mydb;host=127.0.0.1";
    $administrador="root";
    $pw="";
        
    $base_de_datos=new PDO($datos_conexion,$administrador,$pw);

    /*Introducir datos de la conexion con la base de datos */

   $consultaTodos=$base_de_datos->prepare("SELECT *
                                       FROM productos");

    $consultaFiltro=$base_de_datos->prepare("SELECT * 
                                            FROM productos
                                            WHERE id_categorias = :categoria");
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $categoria=$_POST['categoria'];
     if ($categoria == 1) {
            echo "<h2>Todos los productos</h2>";
        } elseif ($categoria == 2) {
            echo "<h2>Artículos de papelería</h2>";
        } elseif ($categoria == 3) {
            echo "<h2>Mobiliario de oficina</h2>";
        }
        

    if($categoria==1){
        //creamos un array asociativo con los productos
        $consultaTodos->execute();
        $productos = $consultaTodos->fetchAll(PDO::FETCH_ASSOC);
        foreach ($productos as $producto) {
            echo "<div>".
                "Nombre:".($producto['nombre_producto'])."<br>".
                ($producto['descripcion_producto'])."<br>".
                ($producto['peso_producto'])."<br>".
                ($producto['tamanio_producto'])."<br>".
                ($producto['imagen_producto']).
                "</div>";
        }
    }elseif ($categoria==2 || $categoria==3) {
        
        $consultaFiltro->bindParam(":categoria",$categoria,PDO::PARAM_INT);
        $consultaFiltro->execute();
        $productos = $consultaFiltro->fetchAll(PDO::FETCH_ASSOC);
        foreach ($productos as $producto) {
            echo "<div>".
                "Nombre:".($producto['nombre_producto']).
                ($producto['descripcion_producto']).
                ($producto['peso_producto']).
                ($producto['tamanio_producto']).
                ($producto['imagen_producto']).
                "</div>";
        }
    }
    }

    ?>
</body>

</html>
