<?php
//session_start(); // Inicia la sesión



/*require_once "conexion_bd.php";

    try {
        
        $conexionBD = new ConectarBaseDeDatos();
        $base_de_datos = $conexionBD->getConexion();
    
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
*/

// Inicializamos la variable de error
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recogemos los datos del formulario de forma segura
    $usuario =  $_POST['correo'];
    $contrasenia = $_POST['contrasenia']; 



    //comprobamos si el usuario existe con una funcion fuera de este script, almacenado en consultas.php, añadimos require_once consultas.php para poder usar las funciones que se almacenan alli

    if ($usuario && $contrasenia) {


    /*    // Preparamos la consulta
        $consulta = $base_de_datos->prepare("SELECT correo, contrasenia, id_empresa
                                            FROM credenciales
                                            WHERE correo = :correo AND contrasenia = :contrasenia");

        // Enlazamos los parámetros
        $consulta->bindParam(":correo", $usuario, PDO::PARAM_STR);
        $consulta->bindParam(":contrasenia", $contrasenia, PDO::PARAM_STR); 
        //si se ejecuta correctamente quiere decir que hay un usuario con estos parametros
        $consulta->execute();

        // Obtenemos los datos en un array asociativo
        $empresa = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($empresa) {
            //Almacenamos el id_empresa en la variable global para poder usarla en todo el proyecto
            $_SESSION['id_empresa'] = $empresa['id_empresa']; 
            // Redirigimos al usuario

    */
        $esUsuarioExistente = consultaLogin($usuario, $contrasenia);
        if($esUsuarioExistente==true){
            header("Location: inicio.php");
        }else {
            // Credenciales inválidas
            $error = true;
        }
    } else {
        $error = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../css/css_login.css">
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <label for="nombre">Introduce tu correo:</label><br>
        <input type="email" name="correo" id="correo"><br>
        <label for="contrasenia">Introduce tu contraseña:</label><br>
        <input type="password" name="contrasenia" id="contrasenia"><br><br>
        <input type="submit" value="Iniciar sesion">
    </form>

    <?php if ($error){
         echo "<p style='color: red;'>¡Error! Verifica el usuario y la contraseña.</p>";
    }
    ?>
</body>
</html>
