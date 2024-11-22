<?php
// Iniciamos sesión para usar $_SESSION
session_start();

require_once "conexion_bd.php";

    try {

        $conexionBD = new ConectarBaseDeDatos();
        $base_de_datos = $conexionBD->getConexion();
    
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //almacenamos las variables que tenemos en las variables globalores y que vamos a utilizar mas adelante
    $id_empresa = $_SESSION['id_empresa'];
    $id_producto = $_POST['id_producto'];
    $cantidad_producto = $_POST['cantidad'];

    //Con esta consulta comprobamos si hay un carrito para la empresa que esta haciendo el pedido, con el estado activo
    $consultaCarritoActivo = $base_de_datos->prepare("SELECT id_carrito
                                                        FROM carrito
                                                        WHERE id_empresa = :id_empresa
                                                        AND estado_carrito = 'activo'");

    //el id_empresa se almacena desde el inicio, en el momento en el que la persona inicia sesión
    $consultaCarritoActivo->bindParam(":id_empresa",$id_empresa, PDO::PARAM_INT);
    $consultaCarritoActivo->execute();
    //si al ejecutar la consulta no encuentra un carrito para una empresa con el estado activo
    if($consultaCarritoActivo->rowCount() == 0){
       //insertamos dentro de la base de datos un nuevo carrito con el estado activo, ya que es el que se va a usar
       $insertarCarrito = $base_de_datos->prepare("INSERT INTO carrito (id_empresa, estado_carrito)
                                                     VALUES (:id_empresa, 'activo')");
        $insertarCarrito->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
        $insertarCarrito->execute();


        /*lastInsertId() es un método de PDO que devuelve el último
        ID generado automáticamente por una consulta INSERT en una
        base de datos que utiliza claves primarias autoincrementales
        Por lo que guardamos la id_carrito en la variable sesion*/
        
        $_SESSION['id_carrito'] = $base_de_datos->lastInsertId();
       
       
        
    } else {
        //si existe un carrito usamos ese carrito, almacenandolo en un array asociativo
        $carrito = $consultaCarritoActivo->fetch(PDO::FETCH_ASSOC);
        //guardamos el id_carrito en $_SESSION del array asociativo que obtenemos de la consulta 
        //que comprueba la existencia de una carrito activo para esa empresa
        $_SESSION['id_carrito'] = $carrito['id_carrito'];

    }


        //Comprobamos si el producto ya está en el carrito
        $consultaComprobarProductoCarrito = $base_de_datos->prepare("SELECT id_producto 
                                                                    FROM detalle_carrito
                                                                    WHERE id_carrito = :id_carrito
                                                                    AND id_producto = :id_producto");
        //en esta ocasion hemos utilizado directamente $_SESSION para indicar que parametro es :id_carrito, asi se muestra que podemos ponerlo de varias formas
        $consultaComprobarProductoCarrito->bindParam(":id_carrito", $_SESSION['id_carrito'], PDO::PARAM_INT);
        $consultaComprobarProductoCarrito->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
        $consultaComprobarProductoCarrito->execute();

        //si en la consulta no obtenemos resultado
        if($consultaComprobarProductoCarrito->rowCount() == 0){
            //Incluimos el producto en detalle_carrito, que es el que almacena los datos de los productos
            $insertarProductos = $base_de_datos->prepare("INSERT INTO detalle_carrito (id_producto, id_carrito, cantidad_producto)
                                                        VALUES (:id_producto, :id_carrito, :cantidad_producto)");
            $insertarProductos->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
            $insertarProductos->bindParam(":id_carrito", $_SESSION['id_carrito'], PDO::PARAM_INT);
            $insertarProductos->bindParam(":cantidad_producto", $cantidad_producto, PDO::PARAM_INT);
            $insertarProductos->execute();

        }else{//si obtenemos un resultado
            //actualizamos la cantidad del producto, sumandole la nueva cantidad a la anterior
            $actualizarCantidad = $base_de_datos->prepare("UPDATE detalle_carrito 
                                                            SET cantidad_producto = cantidad_producto + :cantidad_producto 
                                                            WHERE id_carrito = :id_carrito
                                                            AND id_producto = :id_producto");
            $actualizarCantidad->bindParam(":cantidad_producto", $cantidad_producto, PDO::PARAM_INT);
            $actualizarCantidad->bindParam(":id_carrito", $_SESSION['id_carrito'], PDO::PARAM_INT);
            $actualizarCantidad->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
            $actualizarCantidad->execute();
        }
   

    }
    //esta pagina no se mostraría, segun se inserta o actualiza un producto actualiza la pagina principal para poder seguir
    //añadiendo productos al carrito
    header('Location: ../php/inicio.php');

?>