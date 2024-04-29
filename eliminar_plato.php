<?php
	require 'conexion.php';
	$consulta=$conexion->prepare("SELECT * FROM pedido");// prepara la consulta SQL
	$consulta->execute();// ejecuta la consulta SQL
	$datos=$consulta->fetchAll(PDO::FETCH_ASSOC);// genera un diccionario con datos de PACIENTE 
	$producto=filter_input(INPUT_GET,'ubi_nom');
	$ubi_nump=filter_input(INPUT_GET, 'nump');
	$mesa=filter_input(INPUT_GET,'mesa');

	foreach ($datos as $elemento) {//FOREACH para incrementar 'id'
		if ($ubi_nump==$elemento['nump']) {//SI para buscar el numero de pedido
			if ($producto==$elemento['plato']) {//SI encuentra el plato a eliminar
				$ubi=$elemento['id'];//LO GUARDA
			}//SI encuentra el plato a eliminar
		}//SI para buscar el numero de pedido
	}//FOREACH para incrementar 'id'

    echo $producto." ". $ubi;
	
	$consulta=$conexion->prepare("DELETE FROM pedido WHERE id=:u");
    $consulta->bindParam(":u",$ubi);
    
	if ($consulta->execute()) {
		echo json_encode('si');
		header("Location:ver_pedido.php?ubinum=".$ubi_nump."&mesa=".$mesa."");
	} 
	else{
		echo json_encode('no');
	}
	
	
    
	//echo $conexion->lastlnsertld()
?>