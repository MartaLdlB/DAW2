<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones CRUD</title>
    <style>
        p {
            color: red;
        }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <button type="submit" name="boton" value="insertar">Insertar</button>
        <button type="submit" name="boton" value="actualizar">Actualizar</button>
        <button type="submit" name="boton" value="eliminar">Eliminar</button>
    </form>

    <?php
    // Datos de conexión
    $datosConexion = "mysql:dbname=empresa;host=127.0.0.1";
    $administrador = "root";
    $pw = "";

    try {
        // Conexión a la base de datos
        $baseDeDatos = new PDO($datosConexion, $administrador, $pw);
     

        // Preparamos las consultas
        $consultaInsertar = $baseDeDatos->prepare("INSERT INTO usuarios (codigo, nombre, clave, rol) VALUES (:codigo, :nombre, :clave, :rol)");
        $consultaBorrar = $baseDeDatos->prepare("DELETE FROM usuarios WHERE codigo = :codigo");
        $consultaActualizar = $baseDeDatos->prepare("UPDATE usuarios SET clave = :clave WHERE codigo = :codigo");
        
        //Esta consulta servira para comprobar si el usuario que estamos borrando o actualizando existe
        $consultaComprobar = $baseDeDatos->prepare("SELECT nombre, clave FROM usuarios WHERE codigo = :codigo");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $opcionBoton = $_POST["boton"]; // Captura la acción del botón

            switch ($opcionBoton) {
                case "insertar":
                    // creamos los datos que vamos a insertar
                    $codigoInsertar = 2;
                    $nombreInsertar = "Marta";
                    $claveInsertar = "4321";
                    $rolInsertar = 1;

                    //Indicamos a que corresponde en cada caso
                    $consultaInsertar->bindParam(":codigo", $codigoInsertar, PDO::PARAM_INT);
                    $consultaInsertar->bindParam(":nombre", $nombreInsertar, PDO::PARAM_STR);
                    $consultaInsertar->bindParam(":clave", $claveInsertar, PDO::PARAM_STR);
                    $consultaInsertar->bindParam(":rol", $rolInsertar, PDO::PARAM_INT);

                    // Si la consulta se puede ejecutar envia un mensaje
                    if ($consultaInsertar->execute()) {
                        echo "<p>Registro insertado correctamente.</p>";
                    }else{
                        echo "<p>El registro no ha podido ser insertado correctamente.</p>";
                    }
                    break;

                case "actualizar":
                    $codigoActualizar = 2;
                    $claveActualizar = "9876";

                    // Verificamos si el usuario existe
                    $consultaComprobar->bindParam(":codigo", $codigoActualizar, PDO::PARAM_INT);
                    $consultaComprobar->execute();
                    $existe = ($consultaComprobar->rowCount() == 1);

                    
                    if ($existe) {
                        // Actualizamos si existe
                        $consultaActualizar->bindParam(":codigo", $codigoActualizar, PDO::PARAM_INT);
                        $consultaActualizar->bindParam(":clave", $claveActualizar, PDO::PARAM_STR);
                        //si existe ejecutamos la consulta de actualizar y en el caso de salir correcto envia un mensaje
                        if ($consultaActualizar->execute()) {
                            echo "<p>Registro actualizado correctamente.</p>";
                        }else{
                            echo "<p>El registro no se ha podido actualizar correctamente.</p>";
                        }
                    } else {
                        //si no existe muestra el mensaje
                        echo "<p>No se pudo actualizar porque el usuario no existe.</p>";
                    }
                    break;

                case "eliminar":
                    $codigoBorrar = 2;

                    // Verificamos si el usuario existe
                    $consultaComprobar->bindParam(":codigo", $codigoBorrar, PDO::PARAM_INT);
                    $consultaComprobar->execute();
                    $existe = ($consultaComprobar->rowCount() == 1);

                    if ($existe) {
                        // Eliminamos si existe
                        $consultaBorrar->bindParam(":codigo", $codigoBorrar, PDO::PARAM_INT);
                        //si existe ejecutamos la consulta de borrar y en el caso de salir correcto envia un mensaje
                        if ($consultaBorrar->execute()) {
                            echo "<p>Registro eliminado correctamente.</p>";
                        }else{
                            echo "<p>El registro no se ha podido borrar correctamente.</p>";
                        }
                    } else {
                        echo "<p>No se pudo eliminar porque el usuario no existe.</p>";
                    }
                    break;

                default:
                    echo "<p>Acción no reconocida.</p>";
            }
        }
    } catch (PDOException $e) {
        echo "<p>Error en la conexión: " . $e->getMessage() . "</p>";
    }
    ?>
</body>
</html>
