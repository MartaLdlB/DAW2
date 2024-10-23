<?php

    $direccion_subida="/U3/archivos guardados/"; //en esta direccion es donde se va a guardar el archivo que subimos

    $fichero_subido = $direccion_subida . basename($_FILES ['fichero_subido']['name']);

    if(move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $direccion_subida)){

        	echo "El archivo se ha subido correctamente";

    }else{

        	echo "No se ha podido subir correctamente";

    }