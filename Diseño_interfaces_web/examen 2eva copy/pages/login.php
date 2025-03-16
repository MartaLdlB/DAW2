<?php
session_start();

// Almacén de usuarios en sesión (sin base de datos)
if (!isset($_SESSION['usuarios'])) {
    $_SESSION['usuarios'] = [];
}

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $tipo = $_POST['tipo'];

    if (empty($usuario) || empty($password)) {
        $mensaje = "Por favor, completa todos los campos.";
    } else {
        if ($tipo == 'registro') {
            if (isset($_SESSION['usuarios'][$usuario])) {
                $mensaje = "El usuario ya existe.";
            } else {
                $_SESSION['usuarios'][$usuario] = password_hash($password, PASSWORD_DEFAULT);
                $mensaje = "Registro exitoso. Ahora puedes iniciar sesión.";
            }
        } elseif ($tipo == 'login') {
            if (isset($_SESSION['usuarios'][$usuario]) && password_verify($password, $_SESSION['usuarios'][$usuario])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $usuario;
                header("Location: index.php");
                exit();
            } else {
                $mensaje = "Usuario o contraseña incorrectos.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Contador de Días</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Orbitron:wght@400;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../assets/css/estilos.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-card">
            <h2>Login</h2>
            <?php if (!empty($mensaje)) : ?>
                <div class="alert alert-info"><?php echo $mensaje; ?></div>
            <?php endif; ?>
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="usuario" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="tipo" value="login" class="btn btn-primary">Iniciar Sesión</button>
                <button type="submit" name="tipo" value="registro" class="btn btn-success">Registrarse</button>
            </form>
        </div>
    </div>
</body>
</html>
