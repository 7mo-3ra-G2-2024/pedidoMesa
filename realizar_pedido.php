<?php
	require 'conexion.php';
	
	$producto=filter_input(INPUT_POST,'plato');
	$precio=filter_input(INPUT_POST, 'precio');
	$i=filter_input(INPUT_POST, 'id');
	$n=filter_input(INPUT_POST, 'nump');

	//INSERT INTO `pedido` (`id`, `nump`, `plato`, `precio`) VALUES ('0', '3', 'ffrfd32', '3232');

    $consulta=$conexion->prepare("INSERT INTO `pedido` (`id`, `nump`, `plato`, `precio`) VALUES (:id, :num, :pro, :pre);");
	$consulta->bindParam(':pro',$producto);
    $consulta->bindParam(':pre',$precio);
	$consulta->bindParam(':num',$n);
	$consulta->bindParam(':id',$i);

	if ($consulta->execute()) {
		header("Location:index.php");
	}
	else{
		echo json_encode('no');
	}
	//echo $conexion->lastlnsertld()
?>