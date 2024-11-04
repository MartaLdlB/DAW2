<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccion de idioma</title>
</head>
<body>

   

<?php
// PHP comienza aquí

// Idioma predeterminado en español
$idioma = "es";

// Si existe la cookie de idioma, actualiza $idioma con el valor almacenado en la cookie
if (isset($_COOKIE["idioma"])) {
    $idioma = $_COOKIE["idioma"];
}

// Verifica si el formulario fue enviado con método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //consigue el valor del idioma seleccionado en el formulario por el usuario, por defecto aparecera en español por que así definimos la variable
    if (isset($_POST['idioma'])) {
        $idioma = $_POST['idioma'];
        
        // Guarda el idioma en una cookie para futuras visitas
        setcookie("idioma", $idioma, time() + (86400 * 30)); // Expira en 30 días, por eso cuando se abra por segunda vez aparecerá el ultimo idioma guardado
        
        // Recarga la página para aplicar el idioma seleccionado
        header("Location: " . $_SERVER['PHP_SELF']);
    }
}

// Array asociativo con los textos en diferentes idiomas
$texto = [
    'es' => 'Durante mil años han caído las cenizas y nada florece...',
    'in' => 'For a thousand years ashes have fallen and nothing blooms...',
    'ja' => '千年の間、灰は降り、何も咲かない...'
];
?> 
<!-- Formulario para seleccionar el idioma con botones de radio y un botón de envío -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="es">Español</label>    
        <input type="radio" name="idioma" value="es" id="es">
        <br>
        <label for="in">Inglés</label>    
        <input type="radio" name="idioma" value="in" id="in">
        <br>
        <label for="ja">Japonés</label>    
        <input type="radio" name="idioma" value="ja" id="ja">
        <br>
        <button type="submit">Seleccionar idioma</button>
    </form>
    <br>
    
    <!-- Muestra el texto en el idioma seleccionado -->
    <p><?php echo $texto[$idioma]; ?></p>
</body>
</html>
