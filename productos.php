<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos Disponibles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 style="text-align: center;"><svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 4V44" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 5V15C8 20 14 20 14 20C14 20 20 20 20 15V5" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M37 4L40 44" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M31 4L28 44" stroke="#333" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>  Platos Disponibles</h1>
    <div class="productos-container">    
        <?php
            $productos_json = file_get_contents("productos.json");
            $productos = json_decode($productos_json, true);
            
            foreach ($productos as $producto) {
                echo "<div class='producto'>";
                echo "<img src=".$producto['imagen']." width='150' height='100' >";
                echo "<div class='producto-contenido'>";
                echo "<h3>" . $producto['nombre'] . "</h3>";
                echo "<p>Precio: $" . $producto['precio'] . "</p>";
                echo "</div>";
                  
        ?>
        <svg width="24" height="24" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M39 32H13L8 12H44L39 32Z" fill="none"/><path d="M3 6H6.5L8 12M8 12L13 32H39L44 12H8Z" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="13" cy="39" r="3" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="39" cy="39" r="3" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M22 22H30" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/><path d="M26 26V18" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <?php
                echo "</div>";
            } 
        ?>
    </div>
</body>
</html>
