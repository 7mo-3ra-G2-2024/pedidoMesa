<?php
	$user="root";
	$psw="";
	$dbname="restaurante";
	$host="localhost";

	try{
		$dsn="mysql:host=localhost;dbname=$dbname";
		$conexion=new PDO($dsn,$user,$psw);
	} catch (PDOException $e){
		echo $e->getMessage();
	}

?>