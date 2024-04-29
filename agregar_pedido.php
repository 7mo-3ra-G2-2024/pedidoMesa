<?php
	require 'conexion.php';
	$consulta=$conexion->prepare("SELECT * FROM listapedidos");// prepara la consulta SQL
	$consulta->execute();// ejecuta la consulta SQL
	$datos=$consulta->fetchAll(PDO::FETCH_ASSOC);// genera un diccionario con datos de PACIENTE 
	if (isset($datos[0]['nump'])) {//SI LA BASE NO ESTA VACIA
		foreach ($datos as $elemento) {
			$nump=$elemento['nump'];
		}	
		$nump++;
	}//SI LA BASE NO ESTA VACIA
	else {//SI LA BASE ESTA VACIA
		$nump=1;
		foreach ($datos as $elemento) {//FOREACH para incrementar 'id'
			$nump++;
		}//FOREACH para incrementar 'id'
	}//SI LA BASE ESTA VACIA
	
	$mesa=filter_input(INPUT_GET,'ing_mesa');

    echo $mesa." ". $nump;

    $consulta=$conexion->prepare("INSERT INTO `listapedidos` (`nump`, `mesa`) VALUES (:num, :mes);");
	$consulta->bindParam(':mes',$mesa);
	$consulta->bindParam(':num',$nump);

	if ($consulta->execute()) {
		echo json_encode('si');
		header("Location:index.php");
	}
	else{
		echo json_encode('no');
	}
	
	//echo $conexion->lastlnsertld()
?>