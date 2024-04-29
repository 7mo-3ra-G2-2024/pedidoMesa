<?php
	require 'conexion.php';
	$consulta=$conexion->prepare("SELECT * FROM listapedidos");// prepara la consulta SQL
	$consulta->execute();// ejecuta la consulta SQL
	$datos=$consulta->fetchAll(PDO::FETCH_ASSOC);// genera un diccionario con datos de PACIENTE 
	$consulta=$conexion->prepare("SELECT * FROM pedido");// prepara la consulta SQL
	$consulta->execute();// ejecuta la consulta SQL
	$datos2=$consulta->fetchAll(PDO::FETCH_ASSOC);// genera un diccionario con datos de PACIENTE 
	$ubi_nump=filter_input(INPUT_GET, 'nump');

	foreach ($datos as $elemento) {//FOREACH para buscar el nump de listapedidos
		if ($ubi_nump==$elemento['nump']) {//SI para buscar el numero de pedido
			foreach($datos2 as $pedido){//FOREACH para recorrer pedido
				if($pedido['nump']==$ubi_nump){//SI encuentra el nump elimina el plato
					$consulta=$conexion->prepare("DELETE FROM pedido WHERE id=:u");
    				$consulta->bindParam(":u",$pedido['id']);
					$consulta->execute();
				}//SI encuentra el nump elimina el plato
			}//FOREACH para recorrer pedido
			$ubi=$elemento['nump'];//LO GUARDA
		}//SI para buscar el numero de pedido
	}//FOREACH para buscar el nump de listapedidos

    echo $producto." ". $ubi;
	
	$consulta=$conexion->prepare("DELETE FROM listapedidos WHERE nump=:u");
    $consulta->bindParam(":u",$ubi);
    
	if ($consulta->execute()) {
		echo json_encode('si');
		header("Location:index.php");
	} 
	else{
		echo json_encode('no');
	}
	//echo $conexion->lastlnsertld()
?>