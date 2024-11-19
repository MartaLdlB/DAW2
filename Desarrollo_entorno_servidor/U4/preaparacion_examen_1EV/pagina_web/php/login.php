 
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
    </head>
    <body>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        <label for="usuario">Nombre de usuario</label><br>
        <input type="text" name="usuario" value="<?php if(isset($usuario)) echo $usuario;?>"><br>
        <label for="pw">Introduce tu contraseña: </label><br>
        <input type="password" name="pw"><br><br>
        <input type="submit" value="Enviar">

        </form>

        <p>Si aun no tienes cuenta, <a href="registro.php">pulsa aqui</a></p>
        

    
    <?php
     session_start(); //crea una sesion 

    $datos_conexion="mysql:dbname=empresa;host=127.0.0.1";
    $administrador="root";
    $pw="";
        
    $datosValidos; //boolean que nos indica si los datos introducidos por el usuario son correctos dentro de la base de datos
    
    //conexion con la base de datos
    $base_de_datos= new PDO($datos_conexion,$administrador,$pw);

    $consulta=$base_de_datos->prepare("SELECT nombre, clave 
                                        FROM usuarios
                                        WHERE nombre = :nombre 
                                        AND clave = :clave");
    //variable no inicializada para usarla con "isset()" para detectar si hay un error o no
    $error;
    if($_SERVER["REQUEST_METHOD"]=="POST"){ 

        
            //guardamos en una variable los datos del usuario que recibimos en el login
            $usr=$_POST['usuario'];
            $password=$_POST["pw"];
            

             /*":nombre" y :clave: Es un marcador de posición con nombre 
            que se utiliza en consultas SQL preparadas. 
            Este marcador será reemplazado con el valor de la variable 
            $usr o $password cuando la consulta se ejecute. */
            $consulta -> bindParam(":nombre", $usr, PDO::PARAM_STR); //PDO::PARAM_STR se usa para indicar que un parámetro de una consulta SQL debe tratarse como una cadena de texto (string).
           
            $consulta -> bindParam(":clave", $password, PDO::PARAM_STR);

            $consulta->execute();

            //en el momento en el que encuentre 1 igual al los datos de entrada del usuario,
            //lo marca como TRUE, en el caso de no encontrar nada lo marca como FALSE, que seria que no se encuentra en la base de datos
            $datosValidos = ($consulta->rowCount() == 1) ? true : false;

            if($datosValidos==true){
                header("Location: sesiones1_login.php");
            }else{
                $error=true;
            }

            if (isset($error)) {
                // Mensaje de error y aviso por pantalla incrustado en HTML
                echo "<br><p>¡Error! Verifica el usuario y la contraseña";
            
            }
    }
    ?>
    </body>
    </html>