<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html {
            background-color: #200049;
            background-image: url(https://cdn.pixabay.com/animation/2023/08/17/08/51/08-51-41-992_512.gif);
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%; /* Aseguramos que el html ocupe toda la altura */
        }

        body {
            display: flex; /* Usar Flexbox en el body */
            flex-direction: column; /* Alinear en columna */
            justify-content: center; /* Centrar verticalmente */
            align-items: center; /* Centrar horizontalmente */
            height: 100vh; /* Hacer que el body ocupe toda la altura de la ventana */
            margin: 0; /* Eliminar margen por defecto */
        }

        h1, p, a {
            color: white;
            text-align: center;
            background-color: cornflowerblue;
            width: fit-content; /* Ajustar el ancho al contenido */
            padding: 10px; /* Añadir un poco de espacio interno */
            border-radius: 5px; /* Bordes redondeados para un mejor aspecto */
            margin: 10px; /* Espacio entre los elementos */
        }

        a {
            font-size: 30px;
            text-decoration: none; /* Quitar el subrayado del enlace */
            transition: transform 0.3s, box-shadow 0.3s;
        }

        a:hover {
            text-decoration: underline; /* Subrayar al pasar el ratón */
            background-color: rgb(38, 91, 190);
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<?php
session_start();

// Verificamos si la sesión está activa
if (!isset($_SESSION['usuario'])) {
    // en el caso de no haber una sesión, redirigimos al formulario de login
    header("Location: form_en_uno_sesion.php");
    exit(); // Importante salir después de redirigir
}

// Mensaje de bienvenida al usuario
echo "<h1>¡Bienvenido " . htmlspecialchars($_SESSION['usuario']) . "!</h1>";

// Enlace para cerrar sesión
echo '<p><a href="sesiones1_logout.php">Cerrar sesión</a></p>';
?>

</body>
</html>
