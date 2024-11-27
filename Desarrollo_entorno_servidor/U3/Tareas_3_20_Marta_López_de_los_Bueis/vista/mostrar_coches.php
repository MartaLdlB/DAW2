<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coches</title>
</head>
<body>
    <?php
        require_once "../php/consultas.php";

        $tablaCoches = obtenerTablaCoches();

        if (count($tablaCoches) > 0) {
            //Imprimimos los coches dentro de una tabla
            echo "<table border='1'>
                    <tr>
                        <th>Modelo</th>
                        <th>Fabricante</th>
                        <th>Año</th>
                        <th>Foto</th>
                    </tr>";
            foreach ($tablaCoches as $coche) {
                echo "<tr>
                        <td>" . htmlspecialchars($coche['modelo']) . "</td>
                        <td>" . htmlspecialchars($coche['nombre_fabricante']) . "</td>
                        <td>" . htmlspecialchars($coche['anio']) . "</td>
                        <td><img src='data:image/jpeg;base64," . base64_encode($coche['foto']) . "' alt='Imagen del coche' width='300' height='300' /></td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No hay coches registrados en la base de datos.</p>";
        }
    ?>
    <a href="formulario.html">Volver al formulario</a>
</body>
</html>
