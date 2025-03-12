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
    <title>Login y Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 400px;
            width: 100%;
        }
        .card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card text-center">
            <h2 class="mb-3">Login / Registro</h2>
            <?php if (!empty($mensaje)) : ?>
                <div class="alert alert-info"><?php echo $mensaje; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" name="usuario" class="form-control" placeholder="Usuario" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                </div>
                <button type="submit" name="tipo" value="login" class="btn btn-primary w-100 mb-2">Iniciar Sesión</button>
                <button type="submit" name="tipo" value="registro" class="btn btn-success w-100">Registrarse</button>
            </form>
        </div>
    </div>
</body>
</html>
