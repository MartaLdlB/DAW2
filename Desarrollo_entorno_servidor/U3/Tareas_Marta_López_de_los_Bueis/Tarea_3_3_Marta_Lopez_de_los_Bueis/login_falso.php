<?php


//Verifica si el formulario fue enviado usando el método POST
//Solo se ejecuta cuando los datos se envían con método POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    //en el caso de introducir correctamente los datos redirige al usuario a una página llamada bienvenido.html.
    if($_POST["usuario"] === "marta" && $_POST["pw"] === "1234"){
        header("Location: bienvenido.html");
    }else{
        //En el caso de ser incorrectos los datos introducidos, redirige al usuario a una pagina llamada error.html
        header("Location: error.html");
    }
}