<?php 
    include 'navbar.php'; 
    require 'conexion.php';

    $consulta=$conexion->prepare("SELECT * FROM pedido");// prepara la consulta SQL
    $consulta->execute();// ejecuta la consulta SQL
    $datos=$consulta->fetchAll(PDO::FETCH_ASSOC);// genera un diccionario con datos de PACIENTE 
    $nump=filter_input(INPUT_GET,'ubinum');
    $mesa=filter_input(INPUT_GET,'mesa');
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
	<link rel="stylesheet" href="est.css">
	<title>Pedidos</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let num=<?php echo $nump; ?>;
        function cancelar() {
    		Swal.fire({//MUESTRA UNA VENTANA EMERGENTE PARA ELEGIR INGREDIENTES
                title: "Seguro",
                text: "Seguro quieres cancelar el pedido?",
                icon: "warning",
                showDenyButton: true,
				confirmButtonText: "Realizar",
				denyButtonText: `Cancelar`,
                allowOutsideClick: true,
                showCloseButton: true,
                footer: "Esta informacion es importante",
            })//MUESTRA UNA VENTANA EMERGENTE PARA ELEGIR INGREDIENTES
            .then((result) => {//PARA SABER LA RESPUESTA DE Swal.fire
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed) {//SI DESAE CANCELAR
				    Swal.fire({
				    	title: "Se ha Cancelado el pedido!", 
				    	icon: "success",
				    	showConfirmButton: false,
				    	timer: 1000,
				    }).then((res)=>{
				    	if (res) {//UNA VEZ LO ACEPTE LO REDIRECCIONE A UNA PAGINA
				    		window.location.assign(`eliminar_pedido.php?nump=${num}`);
				    	}//UNA VEZ LO ACEPTE LO REDIRECCIONE A UNA PAGINA
				    });
				}//SI DESA CANCELAR
			});//PARA SABER LA RESPUESTA DE Swal.fire
    	}

        function realizar() {
            
    		Swal.fire({
				title: "Se Realizado el pedido!", 
				icon: "success",
				showConfirmButton: false,
				timer: 1000,
			}).then((res)=>{
				if (res) {//UNA VEZ LO ACEPTE LO REDIRECCIONE A UNA PAGINA
				    window.location.assign(`index.php`);
				}//UNA VEZ LO ACEPTE LO REDIRECCIONE A UNA PAGINA
			});
    	}
    </script>
</head>
<body>
	<!-- CARRITO -->
<section id="carrito" class="carrito">
    <div class="caja-pedido">
        <h2><svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="8" y="4" width="32" height="40" rx="2" fill="none" stroke="#333" stroke-width="4" stroke-linejoin="round"/><path d="M21 14H33" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 24H33" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 34H33" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15 16C16.1046 16 17 15.1046 17 14C17 12.8954 16.1046 12 15 12C13.8954 12 13 12.8954 13 14C13 15.1046 13.8954 16 15 16Z" fill="#333"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15 26C16.1046 26 17 25.1046 17 24C17 22.8954 16.1046 22 15 22C13.8954 22 13 22.8954 13 24C13 25.1046 13.8954 26 15 26Z" fill="#333"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15 36C16.1046 36 17 35.1046 17 34C17 32.8954 16.1046 32 15 32C13.8954 32 13 32.8954 13 34C13 35.1046 13.8954 36 15 36Z" fill="#333"/></svg>Pedido</h2>
        <p><b><?php echo $mesa; ?></b></p>
        <p>Cantidad Platos <b><?php echo $cant_pl; ?></b></p>
        <p>Total: $<b><?php echo $total; ?></b></p>
        <button class="buton-carrito-r" onclick="realizar()">Realizar Pedido</button>
        <button class="buton-carrito-c" onclick="cancelar()">Cancelar Pedido</button>
    </div>
</section>

<section class="menu-productos">
    <div class="productos-container">
    <?php 
        $al=[];
        foreach ($datos as $elemento) {//FOREACH 
            if ($nump==$elemento['nump']) {//SI para identificar el pedido
                $catpl=0;//PLATO REPETIDO
                foreach ($datos as $pl) {//FOREACH para buscar cantidad platos
                    if ($elemento['plato'] == $pl['plato'] && $nump == $pl['nump']) {//SI los platos coinciden sume
                        $catpl++;
                    }//SI los platos coinciden sume
                }//FOREACH para buscar cantidad platos
                //echo $elemento['plato']."  ".$elemento['id']." ".$catpl."<br>";
                array_push($al, ["plato" => $elemento['plato'], "cant" => $catpl, "img"=>$elemento['imagen'], "pre"=>$elemento['precio'], "nump"=>$elemento['nump']]);
            }//SI para identificar el pedido
        }//FOREACH
        //var_dump($al);echo "<p>";
        //var_dump(array_unique($al,SORT_REGULAR));
        $muestra= array_unique($al,SORT_REGULAR);//ELIMINA REPETIDOS
        foreach ($muestra as $date) {//FOREACH MUESTRA SIN LOS REPETIDOS
            $cont_agr="ing_pla=".$date['plato']."&ing_pre=".$date['pre']."&ing_img=".$date['img']."&ing_nump=".$date['nump']."&dir=2&mesa=".$mesa."";
            echo '<div class="producto">
                    <img src="'.$date['img'].'" width="150" height="100" >
                    <div class="producto-contenido">
                        <h3>'.$date['plato'].'</h3>
                        <p>$'.$date['pre'].'</p>
                    </div>
                    <div class="producto-editar">
                        <a href="eliminar_plato.php?ubi_nom='.$date['plato'].'&nump='.$date['nump'].'&mesa='.$mesa.'">-</a>
                        '.$date['cant'].' 
                        <a href="agregar_plato.php?'.$cont_agr.'">+</a>
                    </div>
                </div>';
        }//FOREACH MUESTRA SIN LOS REPETIDOS
     ?>
 </div>
</section>
</body>
</html>