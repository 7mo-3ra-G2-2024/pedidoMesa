<?php
	require 'conexion.php';
	$consulta=$conexion->prepare("SELECT * FROM pedido");// prepara la consulta SQL
	$consulta->execute();// ejecuta la consulta SQL
	$datos=$consulta->fetchAll(PDO::FETCH_ASSOC);// genera un diccionario con datos de PACIENTE 
	
	if (isset($datos[0]['id'])) {//SI LA BASE NO ESTA VACIA
		foreach ($datos as $elemento) {
			$id=$elemento['id'];
		}	
		$id++;
	}//SI LA BASE NO ESTA VACIA
	else {//SI LA BASE ESTA VACIA
		$id=0;
		foreach ($datos as $elemento) {//FOREACH para incrementar 'id'
			$id++;
		}//FOREACH para incrementar 'id'
	}//SI LA BASE ESTA VACIA
	
	$producto=filter_input(INPUT_GET,'ing_pla');
	$precio=filter_input(INPUT_GET, 'ing_pre');
	$nump=filter_input(INPUT_GET, 'ing_nump');
	$imagen=filter_input(INPUT_GET, 'ing_img');
	$dire=filter_input(INPUT_GET, 'dir');
	$mesa=filter_input(INPUT_GET,'mesa');

	//INSERT INTO `pedido` (`id`, `nump`, `plato`, `precio`) VALUES ('0', '3', 'ffrfd32', '3232');
    echo $producto." ". $precio." ".$id." ".$nump;

    $consulta=$conexion->prepare("INSERT INTO `pedido` (`id`, `nump`, `plato`, `precio`,`imagen`) VALUES (:i, :num, :pro, :pre, :img);");
	$consulta->bindParam(':pro',$producto);
    $consulta->bindParam(':pre',$precio);
	$consulta->bindParam(':num',$nump);
	$consulta->bindParam(':i',$id);
	$consulta->bindParam(':img',$imagen);

	if ($consulta->execute()) {
		echo json_encode('si');
		if ($dire==1) {
			header("Location:tomar_pedido.php?ubinump=".$nump."&mesa=".$mesa."");
		}
		else if ($dire==2) {
			header("Location:ver_pedido.php?ubinum=".$nump."");
		}
	}
	else{
		echo json_encode('no');
	}
	
	//echo $conexion->lastlnsertld()
?>