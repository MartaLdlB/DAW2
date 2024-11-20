<?php
session_start(); // Inicia la sesión

try {
    // Conexión a la base de datos
    $datos_conexion = "mysql:dbname=mydb;host=127.0.0.1";
    $administrador = "root";
    $pw = "";

    $base_de_datos = new PDO($datos_conexion, $administrador, $pw);
    
} catch (PDOException $e) {
    // Manejo de errores de conexión
    echo("Error al conectar con la base de datos: " . $e->getMessage());
}

// Inicializamos la variable de error
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recogemos los datos del formulario de forma segura
    $usuario =  $_POST['correo'];
    $contrasenia = $_POST['contrasenia']; 

    if ($usuario && $contrasenia) {
        // Preparamos la consulta
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
            header("Location: inicio.php");
            exit(); // Finaliza el script después de la redirección
        } else {
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
