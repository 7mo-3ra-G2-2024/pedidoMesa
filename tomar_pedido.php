<?php 
    include 'navbar.php'; 
    require 'conexion.php';

    $consulta=$conexion->prepare("SELECT * FROM pedido");// prepara la consulta SQL
    $consulta->execute();// ejecuta la consulta SQL
    $datos=$consulta->fetchAll(PDO::FETCH_ASSOC);// genera un diccionario con datos de PACIENTE 
    $num=filter_input(INPUT_GET,'ubinump');
    $mesa=filter_input(INPUT_GET,'mesa');
    //var_dump($num);
    $cant_pl=0;
    $total=0;
    foreach ($datos as $elemento) {//FOREACH para calcular el total
        if ($num==$elemento['nump']) {
            $cant_pl++;
            $total=$total+$elemento['precio'];
        } 
    }//FOREACH para calcular el total
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Pedidos</title>
    <link rel="stylesheet" href="est.css">
</head>
<body>

<!-- CARRITO -->
<section id="carrito" class="carrito">
    <div class="caja-pedido">
        <h2><svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="8" y="4" width="32" height="40" rx="2" fill="none" stroke="#333" stroke-width="4" stroke-linejoin="round"/><path d="M21 14H33" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 24H33" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 34H33" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15 16C16.1046 16 17 15.1046 17 14C17 12.8954 16.1046 12 15 12C13.8954 12 13 12.8954 13 14C13 15.1046 13.8954 16 15 16Z" fill="#333"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15 26C16.1046 26 17 25.1046 17 24C17 22.8954 16.1046 22 15 22C13.8954 22 13 22.8954 13 24C13 25.1046 13.8954 26 15 26Z" fill="#333"/><path fill-rule="evenodd" clip-rule="evenodd" d="M15 36C16.1046 36 17 35.1046 17 34C17 32.8954 16.1046 32 15 32C13.8954 32 13 32.8954 13 34C13 35.1046 13.8954 36 15 36Z" fill="#333"/></svg>Pedido</h2>
        <p><b><?php echo $mesa; ?></b></p>
        <p>Cantidad Platos <b><?php echo $cant_pl; ?></b></p>
        <p>Total: <b>$<?php echo $total; ?></b></p>
        <a href="ver_pedido.php?ubinum=<?php echo $num?>&mesa=<?php echo $mesa?>"><button class="buton-carrito-v">Ver Pedido</button></a>
    </div>
</section>

<!-- PLATOS -->
<section class="menu-productos">
    <h1 style="text-align: center;"><svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 4V44" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 5V15C8 20 14 20 14 20C14 20 20 20 20 15V5" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M37 4L40 44" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M31 4L28 44" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>  Platos Disponibles</h1>
    <div class="productos-container">

        <?php
            $productos_json = file_get_contents("productos.json");
            $productos = json_decode($productos_json, true);
            
            foreach ($productos as $producto) {
                echo "<form class='producto' action='agregar_plato.php'>";
                echo "<img src=".$producto['imagen']." width='150' height='100' >";
                echo "<div class='producto-contenido'>";
                echo "<h3>" . $producto['nombre'] . "</h3>";
                echo "<p>Precio: $" . $producto['precio'] . "</p>";
                echo "</div>";
                echo "<input type='hidden' name='ing_nump' value='".$num."'>";
                echo "<input type='hidden' name='ing_pla' value='".$producto['nombre']."'>";
                echo "<input type='hidden' name='ing_pre' value='".$producto['precio']."'>";
                echo "<input type='hidden' name='ing_img' value='".$producto['imagen']."'>";
                echo "<input type='hidden' name='mesa' value='".$mesa."'>";
                echo "<input type='hidden' name='dir' value='1'>";
                echo "<button class='buton-producto' type='submit'>";  
        ?>
        <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M39 32H13L8 12H44L39 32Z" fill="none"/><path d="M3 6H6.5L8 12M8 12L13 32H39L44 12H8Z" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="13" cy="39" r="3" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="39" cy="39" r="3" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M22 22H30" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M26 26V18" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <?php
                echo "</button>"; 
                echo "</form>";
            } 
        ?>
    </div>

</section>
</body>
</html>