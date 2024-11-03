<?php
// Configuración
$tamañoMax = 2 * 1024 * 1024; // Tamaño máximo en bytes (2 MB)
$permitidos = ['image/jpeg', 'image/png', 'application/pdf']; // Tipos de archivos permitidos

// Verifica si se ha enviado el formulario de subida
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica si hay errores en la subida
        // `UPLOAD_ERR_OK` indica que la carga fue exitosa (código de error 0).
        if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {

            // Guarda el nombre temporal del archivo en el servidor en una variable.
            // Este es el archivo en la ubicación temporal y se utiliza para moverlo luego a la ubicación final.
            $fileTmpPath = $_FILES['file']['tmp_name'];

            // Guarda el nombre original del archivo que el usuario subió.
            // Este nombre puede contener caracteres especiales, así que se recomienda procesarlo.
            $fileName = $_FILES['file']['name'];

            // Obtiene el tamaño del archivo en bytes.
            // Esto es útil para verificar si el tamaño cumple con las restricciones permitidas.
            $fileSize = $_FILES['file']['size'];

            // Obtiene el tipo MIME del archivo, como 'image/jpeg' o 'application/pdf'.
            // El tipo MIME puede ayudar a validar el tipo de archivo, aunque no siempre es confiable.
            $fileType = $_FILES['file']['type'];
        }

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

?>


