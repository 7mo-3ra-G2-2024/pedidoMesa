<?php 
    include 'navbar.php'; 
    require 'conexion.php';

    $consulta=$conexion->prepare("SELECT * FROM listapedidos");// prepara la consulta SQL
    $consulta->execute();// ejecuta la consulta SQL
    $datos=$consulta->fetchAll(PDO::FETCH_ASSOC);// genera un diccionario con datos de PACIENTE 

    $cont='<form action="agregar_pedido.php">
            <p>Seleccione la mesa a la cual va a hacer el pedido.</p>
            <select name="ing_mesa" required class="swal2-select">';

    for ($i = 1; $i < 43; $i++) {
        $cont.='<option value="mesa '.$i.'">mesa '.$i.'</option>';
    }
    $cont.='</select><p><button type="submit" class="buton-carrito-r">Crear Pedido</button></p></form>';


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Pedidos</title>
    <link rel="stylesheet" href="est.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function nuevoPedido() {
            Swal.fire({//MUESTRA UNA VENTANA EMERGENTE PARA ELEGIR INGREDIENTES
                title: "Nuevo Pedido",
                html: `<?php echo $cont; ?>`,
                allowOutsideClick: true,
                showConfirmButton: false,
                showCloseButton: true,
                footer: "Esta informacion es importante",
            });//MUESTRA UNA VENTANA EMERGENTE PARA ELEGIR INGREDIENTES
        }
        function borrarPedido() {
            Swal.fire({//MUESTRA UNA VENTANA EMERGENTE PARA ELEGIR INGREDIENTES
                title: "Borrar Pedido",
                html: `<?php echo $cont; ?>`,
                allowOutsideClick: true,
                showConfirmButton: false,
                showCloseButton: true,
                footer: "Esta informacion es importante",
            });//MUESTRA UNA VENTANA EMERGENTE PARA ELEGIR INGREDIENTES
        }

    </script>
</head>
<body>
<section>
    <button class="buton-carrito-r" style="margin-left: 43%;" onclick="nuevoPedido()">Nuevo Pedido</button>
    <h2 style="text-align: center;">PEDIDOS</h2>
    <div class="pedidos">
        <?php 

            if (isset($datos[0]['nump'])) {//SI La base tiene contenido
                foreach ($datos as $elemento) {//FORECH para mostrar los nump
                    echo "<a href='tomar_pedido.php?ubinump=".$elemento['nump']."&mesa=".$elemento['mesa']."'><div class='pedidos-contenido'>
                            <div class='pedidos-contenido-title' >
                                <h2>Pedido ".$elemento['nump']."</h2> 
                            </div>
                            <h4>".$elemento['mesa']."</h4>
                        </div></a>";
                }//FORECH para mostrar los nump 
            }//SI La base tiene contenido
            else{//SI La base esta VACIA
                echo "<h4>No se agendo ningun Pedido!</h4>";
            }//SI La base esta VACIA
            
         ?>
        
    </div>
</section>

</body>
</html>