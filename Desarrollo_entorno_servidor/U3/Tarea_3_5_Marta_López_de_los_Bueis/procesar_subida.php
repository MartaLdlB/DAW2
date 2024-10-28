<?php
// Configuración
$tamañoMax = 2 * 1024 * 1024; // Tamaño máximo en bytes (2 MB)
$permitidos = ['image/jpeg', 'image/png', 'application/pdf']; // Tipos de archivos permitidos

// Verifica si se ha enviado el formulario de subida
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si hay errores en la subida
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $fileType = $_FILES['file']['type'];

        // Verifica el tamaño del archivo
        if ($fileSize > $tamañoMax) {
            echo "Error: El archivo excede el tamaño máximo permitido de 2 MB.";
        }
        // Verifica el tipo de archivo
        elseif (!in_array($fileType, $permitidos)) {
            echo "Error: Tipo de archivo no permitido. Solo se permiten JPEG, PNG y PDF.";
        } else {
            // Define la ruta de destino
            $uploadDir = '/archivos guardados';
            $destino = $uploadDir . basename($fileName);

            // Intenta mover el archivo al destino final
            if (move_uploaded_file($fileTmpPath, $destino)) {
                echo "Archivo subido correctamente.";
            } else {
                echo "Error: Hubo un problema al mover el archivo.";
            }
        }
    } else {
        echo "Error: Hubo un problema en la subida del archivo.";
    }
}
?>


