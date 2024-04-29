<?php 
    include 'navbar.php'; 
    require 'conexion.php';

    $consulta=$conexion->prepare("SELECT * FROM pedido");// prepara la consulta SQL
    $consulta->execute();// ejecuta la consulta SQL
    $datos=$consulta->fetchAll(PDO::FETCH_ASSOC);// genera un diccionario con datos de PACIENTE 
    $nump=1;
    $cant_pl=0;
    $total=0;
    foreach ($datos as $elemento) {//FOREACH para calcular el total
        if ($nump==$elemento['nump']) {
            $cant_pl++;
            $total=$total+$elemento['precio'];
        }
    }//FOREACH para calcular el total
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
	<title>Pedidos</title>
</head>
<body>
	
</body>
</html>