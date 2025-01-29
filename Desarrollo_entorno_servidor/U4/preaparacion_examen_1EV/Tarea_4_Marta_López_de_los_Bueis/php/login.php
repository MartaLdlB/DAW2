<?php
require_once "consultas.php";
// Inicializamos la variable de error
$error;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    // Recogemos los datos del formulario de forma segura
    $usuario =  $_POST['correo'];
    $contrasenia = $_POST['contrasenia']; 

    //comprobamos si el usuario existe con una funcion fuera de este script, almacenado en consultas.php, añadimos require_once consultas.php para poder usar las funciones que se almacenan alli
    
        //$esUsuarioExistente = consultaLogin($usuario, $contrasenia);
        if(consultaLogin($usuario, $contrasenia)){
            header("Location: index.php");
        }else {
            // Credenciales inválidas
            $error = true;
        }
    } else {
        $error = false;
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
