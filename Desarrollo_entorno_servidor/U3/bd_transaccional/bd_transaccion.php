<?php


$datos_conexion = 'mysql:dbname=empresa;host=127.0.0.1';
$administrador = 'root';
$pw ='';
try{
    $bd = new PDO($datos_conexion,$administrador,$pw);
        echo "<p>Se ha realizado la conecxión con ".$datos_conexion.
        "<br> Administrador= ".$administrador." | pw= ".$pw. "</p>";

        //comenzar la transaccion
        $bd->beginTransaction();
        $ins = "Insert into usuarios(nombre, clave, rol) values('Marta', '0001', '1')";
        $resul=$bd->query($ins);
        //repetir la consulta y comprobar que falla por que el nombre es unique
        $resul=$bd->query($ins);
        if(!$resul){
            echo "<p>Error: ".print_r($bd->errorinfo());
            //hay que deshacer el primer cambio
            echo "<br>Haciendo rollback...";
            $bd->rollback();
            echo "<br>¡Transaccion anulada!";
            
        }else{
            //si hubiera ido bien
            $bd->commit();
        }


}catch(PDOExcepion $e){
    echo "Error con la base de datos".$e->getMessage();
}

