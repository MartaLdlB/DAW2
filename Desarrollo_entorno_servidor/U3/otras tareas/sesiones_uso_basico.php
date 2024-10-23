<?php

session_start(); //crea una sesion y la variable global=0 si no existia o  la incrementa si ya existia.
if(!isset($_SESSION['contador'])){
    $_SESSION['contador']=0;
}else{
    $_SESSION['contador']++;
}

echo "Hola ".$_SESSION['contador'];
echo "<br><a href='sesiones_uso_basico2.php'>Siguiente</a>";