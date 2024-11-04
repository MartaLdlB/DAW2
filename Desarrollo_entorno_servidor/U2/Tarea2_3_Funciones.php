<?php
    function factorial(){
        $factorial=5;
        $solucion=1;
        do{
            $solucion=$solucion*$factorial;
            $factorial--;
        }while($factorial>1);

    echo ($solucion);

    }
        