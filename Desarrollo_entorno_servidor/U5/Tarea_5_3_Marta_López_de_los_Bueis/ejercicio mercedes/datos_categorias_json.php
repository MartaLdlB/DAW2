<?php
	$categoria1 = array("idCategoria" => 1, "nombre" => "Ropa");
	$categoria2 = array("idCategoria" => 2, "nombre" => "Cubiertos");
	$categoria3 = array("idCategoria" => 3, "nombre" => "Vajilla");
	$categoria4 = array("idCategoria" => 4, "nombre" => "Critalería");
	$categoria5 = array("idCategoria" => 5, "nombre" => "Fruta");
	$categoria6 = array("idCategoria" => 6, "nombre" => "Verdura");
	$categoria7 = array("idCategoria" => 7, "nombre" => "Ave");
	$array = array($categoria1, $categoria2, $categoria2, $categoria3, 
	    $categoria4, $categoria5, $categoria6, $categoria7);
	$datos = json_encode($array);	
	echo $datos;
?>