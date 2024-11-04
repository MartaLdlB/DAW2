<?php   

    $dividendo = 60;
    $divisor = 20;

    function calcularDivision($dividendo, $divisor){

        	try{
                if ($divisor == 0){
                    throw new Exception ("ERROR, Division por cero")
                }
            }catch(ExcepcionPorCero $e){
                echo($e->getMessage());
            }

            

    }

    class ExcepcionPorCero extends Exception {
        echo ("No se puede dividir entre cero");
    }

    
