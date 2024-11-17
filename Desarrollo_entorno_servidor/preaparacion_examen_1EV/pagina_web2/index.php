<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        p{
            color: red;
        }
    </style>
</head>
<body>

    <header>
        <h1>Materiales de oficina</h1>
    </header>

    
    <!--<h1>Formulario con html interno en php</h1>-->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="usuario">Nombre de usuario</label><br>
        <input type="text" name="usuario" value="<?php if(isset($usuario)) echo $usuario;?>"><br>
        <label for="pw">Introduce tu contraseña: </label><br>
        <input type="password" name="pw"><br><br>
        <input type="submit" value="Enviar">
    </form>
    <?php
    $error;
    if($_SERVER["REQUEST_METHOD"] == "POST"){

                if($_POST["usuario"] === "marta" && $_POST["pw"]==="1234"){
                    header("Location: bienvenido.html");
                }else{
                    $error=true;
                }
    }
        /* "isset" verifica que la variable ha sido creada y tiene
        un valor diferente de "nulo", fuera del parentesis, si existe
        y es "true" se ejecuta el if, si es "false" no se ejecuta. */
        if (isset($error)) {
            // Mensaje de error y aviso por pantalla incrustado en HTML
            echo "<br><p>¡Error! Verifica el usuario y la contraseña";
        
        }

        
     ?>

</body>
</html>
