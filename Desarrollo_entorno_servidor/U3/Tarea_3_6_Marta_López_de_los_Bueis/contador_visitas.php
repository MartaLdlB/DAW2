<?php


$contador =1;

if(isset($_COOKIE["visitas"])){

    $contador=$_COOKIE["visitas"] + 1; //Cuando llamas al nombre de la cookie te da el valor 

}

//Al iniciar la pagina por primera vez, lo que hace es que la crea
setcookie("visitas", 
    $contador, //Valor de la cookie
    time()+3600*24, //tiempo en el que expira
    "./", //expecifica la ruta del servidor
    "", 
    false, //indica si solamente se puede transmitir por HTTPS
    true); //indica que solamente se puede usar por HTTP y no por script (JavaScript)


echo "El valor de la cookie es--> ". $contador; 