<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea 3_8 Controlador de una sesion</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

    <label for="usuario">Introduce tu nombre de usuario: </label><br>
    <input type="text" name="usuario"><br>
    <label for="pw">Introduce tu contraseña: </label> <br>
    <input type="password" name="pw"><br><br>
    <input type="submit" value="Enviar"><br><br>

    <a href="sesiones1_logout.php">Si desea no iniciar sesion pulse aqui</a>
    </form>

    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        session_start(); //crea una sesion y la variable global=0 si no existia o  la incrementa si ya existia.
            if(!isset($_SESSION['contador'])){
                $_SESSION['contador']=0;
            }else{
                $_SESSION['contador']++;
            }

        
            
        if($_POST["usuario"]==="marta" && $_POST["pw"]==="1234"){
            session_start();
            header("Location: bienvenido.html");
        }elseif(($_POST["usuario"]==="admin" && $_POST["pw"]==="1234")){
            header("Location: bienvenido.html");
        }else{
            
        }
    }



    ?>

</body>
</html>