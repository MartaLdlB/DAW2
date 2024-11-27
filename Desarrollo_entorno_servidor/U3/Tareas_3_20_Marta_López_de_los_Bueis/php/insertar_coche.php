<?php
require_once "consultas.php";


// Verifica si se ha enviado el formulario de subida con el metodo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $modelo = $_POST['modelo'];
    $fabricante = $_POST['fabricante'];
    $anio = $_POST['anio'];
    
        // Verifica si hay errores en la subida
        // `UPLOAD_ERR_OK` indica que la carga fue exitosa (código de error 0).
        if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {

            //Guarda el nombre temporal del archivo en el servidor en una variable.
            $fotoTmpPath = $_FILES['foto']['tmp_name'];
            //Guardamos el contenido de la foto en una variable
            $foto = file_get_contents($fotoTmpPath);
            
        }
        //insertamos el coche
        insertarCoche($modelo, $foto, $anio, $fabricante);
        //recargamos la pagina del formulario
        header('Location: ../vista/formulario.html');
}

        

?>


